@extends('cms::template.layout_noauth')

@section('content')

<h1>{{ Lang::get('cms::confirm.title') }}</h1>

@if(Config::get('cms::auth.password_validation') == 'strict')
    <p>{{ trans('cms::confirm.strict_guidelines') }}</p>
@endif

{{ Form::open(['route' => 'cms.noauth.password.store']) }}
    {{ Form::hidden('token', $token) }}
    {{ Form::hidden('id', $id) }}
    {{ Form::hidden('email', $username) }}


    <div class="form-group">
        {{ Form::label('password', Lang::get('cms::auth.lbl_password')) }}
        {{ Form::password('password', ['class'=>'form-control']) }}
        {{ $errors->first('password', '<span class="help-block">:message</span>') }}
    </div>

    <div class="form-group">
        {{ Form::label('password_confirmation', Lang::get('cms::auth.lbl_password_conf')) }}
        {{ Form::password('password_confirmation', ['class'=>'form-control']) }}
        {{ $errors->first('password_confirmation', '<span class="help-block">:message</span>') }}
    </div>

    <div class="form-group">
        {{ Form::submit(Lang::get('cms::confirm.submit'), ['class'=>'btn btn-primary form-control']) }}
    </div>

    {{ Form::close() }}

@stop