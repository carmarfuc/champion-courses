<div class="box box-info padding-1 ">
    <div class="box-body">

        <div class="form-group">
            {{ Form::label('name') }}
            {{ Form::text('name', str_replace('_', ' ', $setting->name), ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Name', 'autofocus']) }}
            {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}

        </div>
        <div class="form-group mt-3">
            {{ Form::label('value') }}
            {{ Form::text('value', $setting->value, ['class' => 'form-control' . ($errors->has('value') ? ' is-invalid' : ''), 'placeholder' => 'Value']) }}
            {!! $errors->first('value', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>

    <div class="box-footer  mt-4">
        <div class="row">
            <div class="col-md-4">
                <a href="{{ route('settings.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>
