@extends('layouts.app')

@section('template_title')
    {{ $subject->name ?? 'Show Subject' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Subject</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('subjects.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Name:</strong>
                            {{ $subject->name }}
                        </div>
                        <div class="form-group">
                            <strong>Slug:</strong>
                            {{ $subject->slug }}
                        </div>
                        <div class="form-group">
                            <strong>Description:</strong>
                            {{ $subject->description }}
                        </div>
                        <div class="form-group">
                            <strong>Monthly Price:</strong>
                            {{ $subject->monthly_price }}
                        </div>
                        <div class="form-group">
                            <strong>Start Date:</strong>
                            {{ $subject->start_date }}
                        </div>
                        <div class="form-group">
                            <strong>Finish Date:</strong>
                            {{ $subject->finish_date }}
                        </div>
                        <div class="form-group">
                            <strong>Active:</strong>
                            {{ $subject->active }}
                        </div>
                        <div class="form-group">
                            <strong>Teacher Id:</strong>
                            {{ $subject->teacher_id }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
