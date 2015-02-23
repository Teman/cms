<div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
    {{ Form::label('email', 'Email') }}
    {{ Form::text('email', null, ['autocomplete'=>'off', 'class' => 'form-control']) }}
    {{ $errors->first('email', '<span class="help-block">:message</span>') }}
</div>

<div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
    {{ Form::label('password', '') }}
    {{ Form::password('password', ['autocomplete'=>'off', 'class' => 'form-control']) }}
    {{ $errors->first('password', '<span class="help-block">:message</span>') }}
</div>

<div class="form-group {{ $errors->has('role_id') ? 'has-error' : '' }}">
    {{ Form::label('role_id', 'Role') }}
    {{ Form::select('role_id', $roles->lists('name', 'id'), (isset($user) ? $user->roles[0]->id : null), ['class' => 'form-control']) }}
    {{ $errors->first('role_id', '<span class="help-block">:message</span>') }}
</div>

@if(!isset($edit) and Config::get('cms::auth.can_set_password'))
    <div class="form-group">
        {{ Form::checkbox('set_password', 1) }}
        {{ Form::label('set_password', 'User has to set their own password') }}
    </div>
@endif

<div class="form-group">
    {{ Form::submit(isset($edit) ? 'Update user' : 'Add user', ['class' => 'btn btn-primary']) }}
</div>