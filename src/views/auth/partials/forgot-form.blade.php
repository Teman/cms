{{ Form::open( ['route' => 'forgot.password.process'] ) }}
<div class="form-group forgot-password-form">
    <div class="input-append input-group">
        {{ Form::text('email', null, ['class' => 'form-control', 'placeholder'=>'E-mail address']) }}

            <span class="input-group-btn">
                {{ Form::submit("Reset", ['class'=>'btn btn-defaul']) }}
            </span>
    </div>
    {{ $errors->first('email', '<span class="help-block">:message</span>') }}
</div>
{{ Form::close() }}