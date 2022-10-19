@extends('layouts.app')

@section('template_title')
    {{ $course->name ?? 'Show Course' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Course</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('courses.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Final Score:</strong>
                            {{ $course->final_score }}
                        </div>
                        <div class="form-group">
                            <strong>Subject Id:</strong>
                            {{ $course->subject_id }}
                        </div>
                        <div class="form-group">
                            <strong>Student Id:</strong>
                            {{ $course->student_id }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
