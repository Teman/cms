@extends('cms::template.layout')


@section('content')

<h1>Edit user</h1>


{{ Form::model($user, ['method' => 'PATCH', 'route' => ['admin.users.update', $user->id]]) }}

    @include('cms::admin.users.partials.userform', ['edit' => true])

{{ Form::close() }}

@stop