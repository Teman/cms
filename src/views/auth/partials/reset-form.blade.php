{{ Form::open(['route' => 'forgot.reset']) }}
{{ Form::hidden('token', $token) }}

<div class="form-group">
    {{ Form::label('email', 'Email:') }}
    {{ Form::email('email', null, ['class'=>'form-control']) }}
    {{ $errors->first('email', '<span class="help-block">:message</span>') }}
</div>

<div class="form-group">
    {{ Form::label('password', 'Password:') }}
    {{ Form::password('password', ['class'=>'form-control']) }}
    {{ $errors->first('password', '<span class="help-block">:message</span>') }}
</div>

<div class="form-group">
    {{ Form::label('password_confirmation', 'Password Confirmation:') }}
    {{ Form::password('password_confirmation', ['class'=>'form-control']) }}
    {{ $errors->first('password_confirmation', '<span class="help-block">:message</span>') }}
</div>

<div class="form-group">
    {{ Form::submit('Submit', ['class'=>'btn btn-primary form-control']) }}
</div>


{{ Form::close() }}