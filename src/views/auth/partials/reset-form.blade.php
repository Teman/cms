{{ Form::open(['route' => 'cms.noauth.forgot.reset']) }}
    {{ Form::hidden('token', $token) }}

    <div class="form-group">
        {{ Form::label('email', Lang::get('cms::auth.lbl_email')) }}
        {{ Form::email('email', null, ['class'=>'form-control']) }}
        {{ $errors->first('email', '<span class="help-block">:message</span>') }}
    </div>

    <div class="form-group">
        {{ Form::label('password', Lang::get('cms::auth.lbl_password')) }}
        {{ Form::password('password', ['class'=>'form-control']) }}
        {{ $errors->first('password', '<span class="help-block">:message</span>') }}
    </div>

    <div class="form-group">
        {{ Form::label('password_confirmation', Lang::get('cms::auth.lbl_password')) }}
        {{ Form::password('password_confirmation', ['class'=>'form-control']) }}
        {{ $errors->first('password_confirmation', '<span class="help-block">:message</span>') }}
    </div>

    <div class="form-group">
        {{ Form::submit(Lang::get('cms::auth.submit'), ['class'=>'btn btn-primary form-control']) }}
    </div>
{{ Form::close() }}