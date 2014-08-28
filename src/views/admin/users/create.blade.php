@extends('cms::template.layout')


@section('content')
<div class="col-md-6">
    <h1>Create new user</h1>


    {{ Form::open(['route' => 'admin.users.store']) }}

        @include('cms::admin.users.partials.userform')

    {{ Form::close() }}
</div>
@stop