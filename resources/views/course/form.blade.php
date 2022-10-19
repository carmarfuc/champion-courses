<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('final_score') }}
            {{ Form::text('final_score', $course->final_score, ['class' => 'form-control' . ($errors->has('final_score') ? ' is-invalid' : ''), 'placeholder' => 'Final Score']) }}
            {!! $errors->first('final_score', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('subject_id') }}
            {{ Form::text('subject_id', $course->subject_id, ['class' => 'form-control' . ($errors->has('subject_id') ? ' is-invalid' : ''), 'placeholder' => 'Subject Id']) }}
            {!! $errors->first('subject_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('student_id') }}
            {{ Form::text('student_id', $course->student_id, ['class' => 'form-control' . ($errors->has('student_id') ? ' is-invalid' : ''), 'placeholder' => 'Student Id']) }}
            {!! $errors->first('student_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>