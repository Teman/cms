@extends('cms::template.layout_noauth')

@section('content')

<h1>Reset your password</h1>

@include('cms::auth.partials.reset-form')

@stop