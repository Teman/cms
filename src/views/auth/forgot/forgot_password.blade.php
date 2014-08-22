@extends('cms::template.layout_noauth')

@section('content')


<h1>{{ Lang::get('cms::auth.forgot_password') }}</h1>

@include('cms::auth.partials.forgot-form')

@stop