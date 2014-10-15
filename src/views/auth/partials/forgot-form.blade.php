{{ Form::open( ['route' => 'cms.noauth.forgot.process'] ) }}
  <div class="form-group forgot-password-form">
      {{ Form::text('email', null, ['class' => 'form-control', 'placeholder'=>'E-mail address','autofocus'=>true]) }}
      {{ Form::submit(Lang::get('cms::auth.reset'), ['class'=>'btn btn-default']) }}
      {{ $errors->first('email', '<span class="help-block">:message</span>') }}
  </div>
{{ Form::close() }}