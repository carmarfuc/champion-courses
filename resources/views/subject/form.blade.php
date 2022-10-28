@if ($message = Session::get('error'))
    <div class="alert alert-danger">
        <p>{{ $message }}</p>
    </div>
@endif
<div class="box box-info padding-1">
    <div class="box-body">

        <div class="form-group">
            @if (Auth::user()->role == 'ADMINISTRATOR')
                {{ Form::label('name') }}
                {{ Form::text('name', $subject->name, ['value' => old('name'), 'class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Name']) }}
                {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
                {!! $errors->first('slug', '<div class="invalid-feedback">:message</div>') !!}
                <div id="nameHelp" class="form-text">This field generates a unique "slug" that is stored in the database.</div>
            @else
                <b>Name:</b> {{$subject->name}}
            @endif
        </div>
        </div>
        <div class="form-group mt-3">
            @if (Auth::user()->role == 'ADMINISTRATOR')
                {{ Form::label('description') }}
                {{ Form::textarea('description', $subject->description, ['value' => old('description'), 'class' => 'form-control' . ($errors->has('description') ? ' is-invalid' : ''), 'placeholder' => 'Description']) }}
                {!! $errors->first('description', '<div class="invalid-feedback">:message</div>') !!}
            @else
                <b>Description:</b> {{$subject->description}}
            @endif
        </div>
        <div class="form-group mt-3">
            @if (Auth::user()->role == 'ADMINISTRATOR')
                {{ Form::label('monthly_price') }}
                {{ Form::text('monthly_price', $subject->monthly_price, ['value' => old('monthly_price'), 'class' => 'form-control' . ($errors->has('monthly_price') ? ' is-invalid' : ''), 'placeholder' => 'Monthly Price']) }}
                {!! $errors->first('monthly_price', '<div class="invalid-feedback">:message</div>') !!}
            @else
                <b>Monthly Price:</b> $ {{ @money($subject->monthly_price) }}
            @endif
        </div>
        <div class="form-group mt-3">
            @if (Auth::user()->role == 'ADMINISTRATOR')
                {{ Form::label('start_date') }}
                {{ Form::date('start_date', $subject->start_date, ['max' => date('Y-m-d',strtotime('+ 1 year', strtotime(date('Y-m-d')))), 'min'=>date('Y-m-d'), 'value' => old('start_date'), 'class' => 'form-control' . ($errors->has('start_date') ? ' is-invalid' : ''), 'placeholder' => 'Start Date']) }}
                {!! $errors->first('start_date', '<div class="invalid-feedback">:message</div>') !!}
                {!! $errors->first('maxCourses', '<div class="invalid-feedback">:message</div>') !!}
            @else
                <b>Start Date:</b> {{$subject->start_date}}
            @endif
        </div>
        <div class="form-group mt-3">
            @if (Auth::user()->role == 'ADMINISTRATOR')
                {{ Form::label('finish_date') }}
                {{ Form::date('finish_date', $subject->finish_date, ['max' => date('Y-m-d',strtotime('+ 1 year', strtotime(date('Y-m-d')))), 'min'=>date('Y-m-d'), 'value' => old('finish_date'), 'class' => 'form-control' . ($errors->has('finish_date') ? ' is-invalid' : ''), 'placeholder' => 'Finish Date']) }}
                {!! $errors->first('finish_date', '<div class="invalid-feedback">:message</div>') !!}
            @else
                <b>Finish Date:</b> {{$subject->finish_date}}
            @endif
        </div>
        <div class="form-group mt-3">
            {{ Form::label('status') }}
            {{ Form::select('status', ['INACTIVE' => 'INACTIVE', 'ACTIVE' => 'ACTIVE'], $subject->status, ['value' => old('status'), 'class' => 'form-control' . ($errors->has('status') ? ' is-invalid' : '')]) }}
            {!! $errors->first('status', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <div class="form-group mt-3">
            @if (Auth::user()->role == 'ADMINISTRATOR')
                {{ Form::label('teacher') }}
                {{ Form::select('teacher_id', $teachers, $subject->teacher_id, ['value' => old('teacher_id'), 'class' => 'form-control' . ($errors->has('teacher_id') ? ' is-invalid' : ''), 'placeholder' => 'Select a teacher']) }}
                {!! $errors->first('teacher_id', '<div class="invalid-feedback">:message</div>') !!}
            @else
                <b>Teacher:</b> {{$subject->user->name}}
            @endif
        </div>

    </div>
    <div class="box-footer mt-4 float-end">
        <div class="row">
            <div>
                <a href="{{ route('subjects.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>

