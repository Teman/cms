@extends('cms::template.layout')

@section('content')

<h1>{{ Lang::get('cms::change.title') }}</h1>

<div class="col-md-4">
<p>{{ trans('cms::auth.loggedin_as', ['name'=>$username]) }}</p>

@if(Config::get('cms::auth.password_validation') == 'strict')
    <p>{{ trans('cms::confirm.strict_guidelines') }}</p>
@endif

{{ Form::open(['route' => 'cms.auth.change_password.save']) }}
{{ Form::hidden('email', Auth::user()->email) }}

    <div class="form-group">
        {{ Form::label('current_password', Lang::get('cms::auth.lbl_password_current')) }}
        {{ Form::password('current_password', ['class'=>'form-control']) }}
        {{ $errors->first('current_password', '<span class="help-block">:message</span>') }}
    </div>

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
        {{ Form::submit(Lang::get('cms::change.submit'), ['class'=>'btn btn-primary form-control']) }}
    </div>

    {{ Form::close() }}
</div>
@stop