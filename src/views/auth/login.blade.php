@extends('cms::template.layout_noauth')

@section('content')
            <h1>Login</h1>

            {{ Form::open( ['route' => 'cms.login'] ) }}

                <div class="form-group">
                    {{ Form::label('email', 'Email') }}
                    {{ Form::text('email', null, ['class' => 'form-control']) }}
                    {{ $errors->first('email', '<span class="error">:message</span>') }}
                </div>

                <div class="form-group">
                    {{ Form::label('password', 'Password') }}
                    {{ Form::password('password', ['class' => 'form-control']) }}
                    {{ $errors->first('password', '<span class="error">:message</span>') }}
                </div>

                <div class="form-group">
                    {{ Form::submit('Log in', ['class' => 'btn btn-primary']) }}
                </div>

                <div class="form-group">
                    {{ link_to_route('forgot.password.form', 'Forgot your password?') }}
                </div>

            {{ Form::close() }}

@stop