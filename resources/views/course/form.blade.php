@if ($message = Session::get('error'))
    <div class="alert alert-danger">
        <p>{{ $message }}</p>
    </div>
@endif
<div class="box box-info padding-1">
    <div class="box-body">

        <div class="form-group">
            @if (Auth::user()->role == 'ADMINISTRATOR')
                {{ Form::label('subject') }}
                {{ Form::select('subject_id', $subjects, $course->subject_id, ['value' => old('subject_id'), 'class' => 'form-control' . ($errors->has('subject_id') ? ' is-invalid' : ''), 'placeholder' => 'Select a Subject']) }}
                {!! $errors->first('subject_id', '<div class="invalid-feedback">:message</div>') !!}
            @elseif (Auth::user()->role == 'TEACHER')
                <b>Course:</b> {{ $course->subject->name }}
                <small class="text-muted"> by {{$course->subject->user->name}} <i>({{$course->subject->start_date}} | {{$course->subject->finish_date}})</i></small>
            @endif
        </div>
        <div class="form-group mt-3">
            @if (Auth::user()->role == 'ADMINISTRATOR')
                {{ Form::label('student') }}
                {{ Form::select('student_id', $students, $course->student_id, ['value' => old('student_id'), 'class' => 'form-control' . ($errors->has('student_id') ? ' is-invalid' : ''), 'placeholder' => 'Select a Student']) }}
                {!! $errors->first('student_id', '<div class="invalid-feedback">:message</div>') !!}
            @elseif (in_array(Auth::user()->role, ['TEACHER', 'STUDENT']))
                <b>Student:</b> {{ $course->user->name }}
            @endif
        </div>
        @if(!empty($course->id))
        <div class="form-group mt-3">
            {{ Form::label('final_score') }}
            {{ Form::text('final_score', $course->final_score, ['value' => old('final_score'), 'class' => 'form-control' . ($errors->has('final_score') ? ' is-invalid' : ''), 'placeholder' => 'Final Score']) }}
            {!! $errors->first('final_score', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        @endif
    </div>
    <div class="box-footer mt-4 float-end">
        <div class="row">
            <div>
                <a href="{{ route('courses.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>
