@extends('cms::template.layout_noauth')

@section('content')


<h1>Reset your password</h1>

{{ Form::open( ['route' => 'forgot.password.process'] ) }}
    <div class="form-group">
        <div class="input-append input-group">
            {{ Form::text('email', null, ['class' => 'form-control', 'placeholder'=>Lang::get('confide::confide.e_mail')]) }}

            <span class="input-group-btn">
                <input class="btn btn-default" type="submit" value="{{{ Lang::get('confide::confide.forgot.submit') }}}">
            </span>
        </div>
    </div>

    @if (Session::get('error'))
    <div class="alert alert-error alert-danger">{{{ Session::get('error') }}}</div>
    @endif

    @if (Session::get('notice'))
    <div class="alert">{{{ Session::get('notice') }}}</div>
    @endif
</form>

@stop