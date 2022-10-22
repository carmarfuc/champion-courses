<div class="box box-info padding-1">
    <div class="box-body">

        <div class="form-group mt-3">
            {{ Form::label('course_id') }}
            {{ Form::select('course_id', $courses, $payment->course_id, ['class' => 'form-control' . ($errors->has('course_id') ? ' is-invalid' : ''), 'placeholder' => 'Course Id']) }}
            {!! $errors->first('course_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group mt-3">
            {{ Form::label('expiration_date') }}
            {{ Form::date('expiration_date', $payment->expiration_date, ['class' => 'form-control' . ($errors->has('expiration_date') ? ' is-invalid' : ''), 'placeholder' => 'Expiration Date']) }}
            {!! $errors->first('expiration_date', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group mt-3">
            {{ Form::label('payment_date') }}
            {{ Form::date('payment_date', $payment->payment_date, ['class' => 'form-control' . ($errors->has('payment_date') ? ' is-invalid' : ''), 'placeholder' => 'Payment Date']) }}
            {!! $errors->first('payment_date', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group mt-3">
            {{ Form::label('status') }}
            {{ Form::select('status', $payment->status, ['class' => 'form-control' . ($errors->has('status') ? ' is-invalid' : ''), 'placeholder' => 'Status']) }}
            {!! $errors->first('status', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group mt-3">
            {{ Form::label('amount') }}
            {{ Form::text('amount', $payment->amount, ['class' => 'form-control' . ($errors->has('amount') ? ' is-invalid' : ''), 'placeholder' => 'Amount']) }}
            {!! $errors->first('amount', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group mt-3">
            {{ Form::label('teacher_remuneration') }}
            {{ Form::text('teacher_remuneration', $payment->teacher_remuneration, ['class' => 'form-control' . ($errors->has('teacher_remuneration') ? ' is-invalid' : ''), 'placeholder' => 'Teacher Remuneration']) }}
            {!! $errors->first('teacher_remuneration', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer  mt-4">
        <div class="row">
            <div class="col-md-4">
                <a href="{{ route('payments.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>
