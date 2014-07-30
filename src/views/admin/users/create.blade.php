@extends('cms::template.layout')


@section('content')

    <h1>Create new user</h1>


    {{ Form::open(['route' => 'admin.users.store']) }}

        @include('cms::admin.users.partials.userform')

    {{ Form::close() }}

@stop