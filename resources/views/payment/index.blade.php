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
                                {{ __('Payment') }}
                            </span>

                             <div class="float-end">
                                <a href="{{ route('payments.create') }}" class="btn btn-primary btn-sm float-end"  data-placement="left">
                                  {{ __('Create New') }}
                                </a>
                              </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

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

                                        <th>Actions</th>
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
                                                    <span class="badge text-bg-success">CHARGED ({{ $payment->teacher_remuneration_payment_date }})</span>
                                                @else
                                                    <span class="badge text-bg-primary">PENDING</span>
                                                @endif
                                            </td>
											<td>{{ $payment->course->user->name }}</td>
                                            <td><b>{{ $payment->course->subject->name }}</b> <small class="text-muted">by {{$payment->course->subject->user->name}} <i>({{$payment->course->subject->start_date}} | {{$payment->course->subject->finish_date}})</i></small></td>

                                            <td>
                                                <a class="btn btn-sm btn-success" href="{{ route('payments.edit',$payment->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="remove({{$payment->id}})"><i class="fa fa-fw fa-trash"></i> Delete</button>
                                            </td>
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
