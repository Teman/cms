@extends('cms::template.layout_noauth')

@section('content')


<h1>Reset your password</h1>

{{ Form::open( ['route' => 'forgot.password.process'] ) }}
    <div class="form-group">
        <div class="input-append input-group">
            {{ Form::text('email', null, ['class' => 'form-control', 'placeholder'=>'E-mail address']) }}

            <span class="input-group-btn">
                <input class="btn btn-default" type="submit" value="Reset">
            </span>
        </div>
        {{ $errors->first('email', '<span class="help-block">:message</span>') }}
    </div>

{{ Form::close() }}

@stop