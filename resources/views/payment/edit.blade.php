@extends('layouts.app')

@section('template_title')
    Update Payment
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-sm-8 offset-sm-2">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Update Payment</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('payments.update', $payment->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('payment.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
