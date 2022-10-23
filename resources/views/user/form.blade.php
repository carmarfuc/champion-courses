<div class="box box-info padding-1">
    <div class="box-body">

        <div class="form-group">
            {{ Form::label('name') }}
            {{ Form::text('name', $user->name, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Name']) }}
            {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group mt-3">
            {{ Form::label('email') }}
            {{ Form::text('email', $user->email, ['class' => 'form-control' . ($errors->has('email') ? ' is-invalid' : ''), 'placeholder' => 'Email']) }}
            {!! $errors->first('email', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group mt-3">
            {{ Form::label('role') }}
            {{ Form::select('role', ['ADMINISTRATOR' => 'ADMINISTRATOR', 'TEACHER' => 'TEACHER', 'STUDENT' => 'STUDENT'], $user->role, ['value' => old('role'), 'class' => 'form-control' . ($errors->has('role') ? ' is-invalid' : ''), 'placeholder' => 'Select a role']) }}
            {!! $errors->first('role', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        @if($user->id)
            <button class="btn btn-primary mt-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapseResetPassword" aria-expanded="false" onclick="$('#password').val('');$('#password_confirm').val('');" >
                Reset password
            </button>
            <div class="collapse mt-2" id="collapseResetPassword">
            <div class="card card-body">
        @endif

        <div class="form-group mt-3">
            {{ Form::label('password') }}
            {{ Form::password('password', ['class' => 'form-control' . ($errors->has('password') ? ' is-invalid' : ''), 'placeholder' => 'Password', 'autocomplete' => 'off']) }}
            {!! $errors->first('password', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group mt-3">
            {{ Form::label('password_confirm') }}
            {{ Form::password('password_confirm', ['class' => 'form-control', 'placeholder' => 'Password Confirm']) }}
        </div>

        @if($user->id)
            </div>
        </div>
        @endif

    </div>
    <div class="box-footer mt-4 float-end">
        <div class="row">
            <div>
                <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>
