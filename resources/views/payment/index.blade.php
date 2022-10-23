@extends('layouts.app')

@section('template_title')
    Payment
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-8 offset-sm-2">
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
                                        <th>No</th>

										<th>Expiration Date</th>
										<th>Payment Date</th>
										<th>Status</th>
										<th>Amount</th>
										<th>Teacher Remuneration</th>
										<th>Course Id</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($payments as $payment)
                                        <tr>
                                            <td>{{ ++$i }}</td>

											<td>{{ $payment->expiration_date }}</td>
											<td>{{ $payment->payment_date }}</td>
											<td>{{ $payment->status }}</td>
											<td>{{ $payment->amount }}</td>
											<td>{{ $payment->teacher_remuneration }}</td>
											<td>{{ $payment->course_id }}</td>

                                            <td>
                                                <form action="{{ route('payments.destroy',$payment->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('payments.show',$payment->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('payments.edit',$payment->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> Delete</button>
                                                </form>
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
