@extends('layouts.app')

@section('template_title')
    Course
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-8 offset-sm-2">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                <b>#{{$count}}</b> {{ $title }}
                            </span>
                            @if($subjectsCount > 0)
                                @if (in_array(Auth::user()->role, ['ADMINISTRATOR', 'STUDENT']))
                                    <div class="float-end">
                                        @if(!$all)<a href="/courses" class="btn btn-secondary btn-sm">Show all records</a> @endif
                                        <a href="{{ route('courses.create') }}" class="btn btn-primary btn-sm"  data-placement="left">
                                            {{ __('Create New') }}
                                        </a>
                                    </div>
                                @endif
                            @endif
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

										<th>Student</th>
										<th>Subject</th>
                                        <th>Final Score</th>

                                        @if (in_array(Auth::user()->role, ['ADMINISTRATOR', 'TEACHER']))
                                            <th>Actions</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($courses as $course)
                                        <tr>
                                            <td>{{ ++$i }}</td>

                                            <td>
                                                <a title="View courses for this student" class="fw-bolder" href="/courses/filter/student/{{$course->student_id}}">
                                                    {{ $course->user->name }}</td>
                                                </a>
											<td>
                                                <a title="View students taking this course" class="fw-bolder" href="/courses/filter/subject/{{$course->subject_id}}">
                                                    <b>{{ $course->subject->name }}</b>
                                                    <small class="text-muted"> by {{$course->subject->user->name}} <i>({{$course->subject->start_date}} | {{$course->subject->finish_date}})</i></small>
                                                </a>
                                            </td>
											<td>{{ $course->final_score }}</td>

                                            @if (in_array(Auth::user()->role, ['ADMINISTRATOR', 'TEACHER']))
                                                <td>
                                                    <a class="btn btn-sm btn-success" href="{{ route('courses.edit',$course->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
                                                    @endif
                                                    @if (Auth::user()->role == 'ADMINISTRATOR')
                                                        <button type="submit" class="btn btn-danger btn-sm" onclick="remove({{$course->id}})"><i class="fa fa-fw fa-trash"></i> Delete</button>
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $courses->links() !!}
            </div>
        </div>
    </div>
@endsection

@section('scripts')

    @include('course/inc/scripts')

@endsection
