@extends('layouts.app')

@section('template_title')
    Payment
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ $title }}
                            </span>
                            @if (Auth::user()->role == 'ADMINISTRATOR')
                                <div class="float-end">
                                    <a href="{{ route('payments.create') }}" class="btn btn-primary btn-sm float-end"  data-placement="left">
                                    {{ __('Create New') }}
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="row mt-4 ms-1 me-1">
                        <div class="container overflow-hidden text-center">
                            <div class="row gy-3">
                                <div class="col-2">
                                    <a href="/payments/filter/pending_payments">
                                        <div class="p-3 text-start text-white rounded-3 bg-primary"><h4>💸 <b>{{$pendingPayments}}</b> Pending Payments </h4></div>
                                    </a>
                                </div>
                                <div class="col-2">
                                    <a href="/payments/filter/payments_paid">
                                        <div class="p-3 text-start text-white rounded-3 bg-success"><h4>💵 <b>{{$paymentsPaid}}</b> Payments Paid</h4></div>
                                    </a>
                                </div>
                                <div class="col-3">
                                    <a href="/payments/filter/pending_remunerations">
                                        <div class="p-3 text-start text-white rounded-3 bg-primary"><h4>💸 <b>{{$pendingRemunerations}}</b> Pending Remunerations</h4></div>
                                    </a>
                                </div>
                                <div class="col-3">
                                    <a href="/payments/filter/remunerations_paid">
                                        <div class="p-3 text-start text-white rounded-3 bg-success"><h4>💵 <b>{{$remunerationsPaid}}</b> Remunerations Paid</h4></div>
                                    </a>
                                </div>
                                <div class="col-2">
                                    <a href="/payments">
                                        <div class="p-3 text-start text-white rounded-3 bg-secondary"><h4>💰 <b>{{$paymentsAll}}</b> All</h4></div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>#</th>

										<th>Expiration Date</th>
										<th>Payment Date</th>
										<th>Amount</th>
										<th>Teacher Remuneration</th>
                                        <th>Teacher Remuneration Payment Date</th>
										<th>Student</th>
                                        <th>Subject</th>
                                        @if (Auth::user()->role == 'ADMINISTRATOR')
                                        <th>Actions</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($payments as $payment)
                                        <tr>
                                            <td>{{ ++$i }}</td>

											<td>{{ $payment->expiration_date }}</td>
											<td>
                                                @if ($payment->payment_date)
                                                    <span class="badge text-bg-success">PAID ({{$payment->payment_date}})</span>
                                                @else
                                                    <span class="badge text-bg-primary">PENDING</span>
                                                @endif
                                            </td>
											<td>$ {{ @money($payment->amount) }}</td>
											<td>$ {{ @money($payment->teacher_remuneration) }}</td>
                                            <td>
                                                @if ($payment->teacher_remuneration_payment_date)
                                                    <span class="badge text-bg-success">PAID ({{ $payment->teacher_remuneration_payment_date }})</span>
                                                @else
                                                    <span class="badge text-bg-primary">PENDING</span>
                                                @endif
                                            </td>
											<td>{{ $payment->course->user->name }}</td>
                                            <td><b>{{ $payment->course->subject->name }}</b> <small class="text-muted">by {{$payment->course->subject->user->name}} <i>({{$payment->course->subject->start_date}} | {{$payment->course->subject->finish_date}})</i></small></td>
                                            @if (Auth::user()->role == 'ADMINISTRATOR')
                                            <td>
                                                <a class="btn btn-sm btn-success" href="{{ route('payments.edit',$payment->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
                                                @if (!$payment->payment_date)
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="remove({{$payment->id}})"><i class="fa fa-fw fa-trash"></i> Delete</button>
                                                @endif
                                            </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $payments->links() !!}
            </div>
        </div>
    </div>
@endsection

@section('scripts')

    @include('payment/inc/scripts')

@endsection
