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
                            <a class="btn btn-secondary" href="{{ route('subjects.index') }}"> Back</a>
                            <a class="btn btn-success" href="{{ route('subjects.edit',$subject->id) }}"> Edit</a>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="form-group">
                            <strong>Name:</strong>
                            {{ $subject->name }}
                        </div>
                        <div class="form-group mt-3">
                            <strong>Slug:</strong>
                            {{ $subject->slug }}
                        </div>
                        <div class="form-group mt-3">
                            <strong>Description:</strong>
                            {{ $subject->description }}
                        </div>
                        <div class="form-group mt-3">
                            <strong>Monthly Price:</strong>
                            {{ $subject->monthly_price }}
                        </div>
                        <div class="form-group mt-3">
                            <strong>Start Date:</strong>
                            {{ $subject->start_date }}
                        </div>
                        <div class="form-group mt-3">
                            <strong>Finish Date:</strong>
                            {{ $subject->finish_date }}
                        </div>
                        <div class="form-group mt-3">
                            <strong>Status:</strong>
                            <span class="badge {{($subject->status == 'inactive') ? 'text-bg-danger' : 'text-bg-success'}}">
                                {{ strtoupper($subject->status) }}
                            </span>
                        </div>
                        <div class="form-group mt-3">
                            <strong>Teacher:</strong>
                            {{$subject->user->name}}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
