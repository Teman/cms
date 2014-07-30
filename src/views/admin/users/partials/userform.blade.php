<div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
    {{ Form::label('email', 'Email') }}
    {{ Form::text('email', null, ['class' => 'form-control']) }}
    {{ $errors->first('email', '<span class="help-block">:message</span>') }}
</div>

<div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
    {{ Form::label('password', '') }}
    {{ Form::password('password', ['class' => 'form-control']) }}
    {{ $errors->first('password', '<span class="help-block">:message</span>') }}
</div>

<div class="form-group {{ $errors->has('role_id') ? 'has-error' : '' }}">
    {{ Form::label('role_id', 'Role') }}
    {{ Form::select('role_id', $roles->lists('name', 'id'), (isset($user) ? $user->roles[0]->id : null), ['class' => 'form-control']) }}
    {{ $errors->first('role_id', '<span class="help-block">:message</span>') }}
</div>

<div class="form-group">
    {{ Form::submit(isset($edit) ? 'Update user' : 'Add user', ['class' => 'btn btn-primary']) }}
</div>