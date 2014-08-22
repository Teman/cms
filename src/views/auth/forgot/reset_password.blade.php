@extends('cms::template.layout_noauth')

@section('content')

<h1>{{ Lang::get('cms::auth.reset_password') }}</h1>

@include('cms::auth.partials.reset-form')

@stop