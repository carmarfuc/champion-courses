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

                             <div class="float-end">
                                @if(!$all)<a href="/courses" class="btn btn-secondary btn-sm">Show all records</a> @endif
                                <a href="{{ route('courses.create') }}" class="btn btn-primary btn-sm"  data-placement="left">
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

										<th>Student</th>
										<th>Subject</th>
                                        <th>Final Score</th>

                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($courses as $course)
                                        <tr>
                                            <td>{{ ++$i }}</td>

                                            <td>
                                                <a href="/courses/filter/student/{{$course->student_id}}">
                                                    {{ $course->user->name }}</td>
                                                </a>
											<td>
                                                <a href="/courses/filter/subject/{{$course->subject_id}}">
                                                    <b>{{ $course->subject->name }}</b>
                                                    <small class="text-muted"> by {{$course->subject->user->name}} <i>({{$course->subject->start_date}} | {{$course->subject->finish_date}})</i></small>
                                                </a>
                                            </td>
											<td>{{ $course->final_score }}</td>

                                            <td>
                                                <a class="btn btn-sm btn-success" href="{{ route('courses.edit',$course->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="remove({{$course->id}})"><i class="fa fa-fw fa-trash"></i> Delete</button>
                                            </td>
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
