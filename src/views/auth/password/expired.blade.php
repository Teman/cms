@extends('cms::template.layout')

@section('content')

<h1>{{ Lang::get('cms::change.expired') }}</h1>

<div class="col-md-4">
<p>{{ trans('cms::auth.loggedin_as', ['name'=>$username]) }}</p>

@if(Config::get('cms::auth.password_validation') == 'strict')
    <p>{{ trans('cms::confirm.strict_guidelines') }}</p>
@endif
<p>{{ trans('cms::change.different') }}</p>

{{ Form::open(['route' => 'cms.noauth.password_expired.save']) }}
{{ Form::hidden('email', Auth::user()->email) }}

    <div class="form-group">
        {{ Form::label('password', Lang::get('cms::auth.lbl_password')) }}
        {{ Form::password('password', ['autocomplete'=>'off', 'class'=>'form-control']) }}
        {{ $errors->first('password', '<span class="help-block">:message</span>') }}
    </div>

    <div class="form-group">
        {{ Form::label('password_confirmation', Lang::get('cms::auth.lbl_password_conf')) }}
        {{ Form::password('password_confirmation', ['autocomplete'=>'off', 'class'=>'form-control']) }}
        {{ $errors->first('password_confirmation', '<span class="help-block">:message</span>') }}
    </div>

    <div class="form-group">
        {{ Form::submit(Lang::get('cms::change.submit'), ['class'=>'btn btn-primary form-control']) }}
    </div>

    {{ Form::close() }}
</div>
@stop