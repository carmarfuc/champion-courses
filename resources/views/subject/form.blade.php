<div class="box box-info padding-1">
    <div class="box-body">

        <div class="form-group">
            {{ Form::label('name') }}
            {{ Form::text('name', $subject->name, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Name']) }}
            {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('slug') }}
            {{ Form::text('slug', $subject->slug, ['class' => 'form-control' . ($errors->has('slug') ? ' is-invalid' : ''), 'placeholder' => 'Slug']) }}
            {!! $errors->first('slug', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('description') }}
            {{ Form::textarea('description', $subject->description, ['class' => 'form-control' . ($errors->has('description') ? ' is-invalid' : ''), 'placeholder' => 'Description']) }}
            {!! $errors->first('description', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('monthly_price') }}
            {{ Form::text('monthly_price', $subject->monthly_price, ['class' => 'form-control' . ($errors->has('monthly_price') ? ' is-invalid' : ''), 'placeholder' => 'Monthly Price']) }}
            {!! $errors->first('monthly_price', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('start_date') }}
            {{ Form::date('start_date', $subject->start_date, ['class' => 'form-control' . ($errors->has('start_date') ? ' is-invalid' : ''), 'placeholder' => 'Start Date']) }}
            {!! $errors->first('start_date', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('finish_date') }}
            {{ Form::date('finish_date', $subject->finish_date, ['class' => 'form-control' . ($errors->has('finish_date') ? ' is-invalid' : ''), 'placeholder' => 'Finish Date']) }}
            {!! $errors->first('finish_date', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('active') }}
            {{ Form::checkbox('active', $subject->active, ['class' => 'form-control' . ($errors->has('active') ? ' is-invalid' : '')]) }}
            {!! $errors->first('active', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <div class="form-group">
            {{ Form::label('teacher') }}
            {{ Form::select('teacher_id', $teachers, $subject->teacher_id, ['class' => 'form-control' . ($errors->has('teacher_id') ? ' is-invalid' : ''), 'placeholder' => 'Select a teacher']) }}
            {!! $errors->first('teacher_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>
