@extends('cms::template.layout_noauth')

@section('content')

{{ Form::open( ['route' => 'cms.noauth.login'] ) }}
    <h2>Login</h2>

    {{ Form::text('email', null, ['class' => 'form-control', 'placeholder'=>'Email address', 'required'=>true,'autofocus']) }}
    {{ $errors->first('email', '<span class="error">:message</span>') }}

    {{ Form::password('password', ['class' => 'form-control', 'autocomplete'=>'off', 'placeholder'=>'Password','required'=>true]) }}
    {{ $errors->first('password', '<span class="error">:message</span>') }}

    {{ Form::submit('Log in', ['class' => 'btn btn-lg btn-primary btn-block']) }}

    {{ link_to_route('cms.noauth.forgot.form', 'Forgot your password?') }}

{{ Form::close() }}

@stop