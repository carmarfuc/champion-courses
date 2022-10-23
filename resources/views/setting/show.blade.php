@extends('layouts.app')

@section('template_title')
    {{ $setting->name ?? 'Show Setting' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-sm-8 offset-sm-2">
                <div class="card">
                    <div class="card-header">
                        <div class="float-start">
                            <span class="card-title">Show Setting</span>
                        </div>
                        <div class="float-end">
                            <a class="btn btn-primary" href="{{ route('settings.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="form-group">
                            <strong>Name:</strong>
                            {{ $setting->name }}
                        </div>
                        <div class="form-group">
                            <strong>Slug:</strong>
                            {{ $setting->slug }}
                        </div>
                        <div class="form-group">
                            <strong>Value:</strong>
                            {{ $setting->value }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
