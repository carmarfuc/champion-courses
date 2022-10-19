@extends('layouts.app')

@section('template_title')
    {{ $payment->name ?? 'Show Payment' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Payment</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('payments.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Expiration Date:</strong>
                            {{ $payment->expiration_date }}
                        </div>
                        <div class="form-group">
                            <strong>Payment Date:</strong>
                            {{ $payment->payment_date }}
                        </div>
                        <div class="form-group">
                            <strong>Status:</strong>
                            {{ $payment->status }}
                        </div>
                        <div class="form-group">
                            <strong>Amount:</strong>
                            {{ $payment->amount }}
                        </div>
                        <div class="form-group">
                            <strong>Teacher Remuneration:</strong>
                            {{ $payment->teacher_remuneration }}
                        </div>
                        <div class="form-group">
                            <strong>Course Id:</strong>
                            {{ $payment->course_id }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
