<div class="box box-info padding-1 ">
    <div class="box-body">
        <div class="form-group">
            {{ Form::label('name') }}
            {{ Form::text('name', $setting->name, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Name', 'autofocus']) }}
            {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
            <p class="help-block">This field generates a "slug" that must be unique.</p>

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
                <a href="{{ route('settings.index') }}" class="btn btn-default">Cancel</a>
                <button type="submit" class="btn btn-primary">Create</button>
            </div>
            <div class="col-md-8">
            {!! $errors->first('slug', '<div class="alert alert-danger" role="alert">:message</div>') !!}

            </div>
        </div>
    </div>
</div>
