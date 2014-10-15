{{ Form::open( ['route' => 'cms.noauth.forgot.process'] ) }}
<div class="form-group forgot-password-form">
    <div class="input-append input-group">
        {{ Form::text('email', null, ['class' => 'form-control', 'placeholder'=>'E-mail address']) }}

            <span class="input-group-btn">
                {{ Form::submit(Lang::get('cms::auth.reset'), ['class'=>'btn btn-default']) }}
            </span>
    </div>
    {{ $errors->first('email', '<span class="help-block">:message</span>') }}
</div>
{{ Form::close() }}