<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $cmsTitle }}</title>

    <link href="{{ asset('packages/teman/cms/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('packages/teman/cms/css/bootstrap-theme.min.css') }}" rel="stylesheet">

    <link href="{{ asset('packages/teman/cms/css/style.css') }}" rel="stylesheet">

</head>

<body>

<div class="container-fluid">


    <div class="row">

        <div class="col-sm-4 col-sm-offset-4">
            @include('flash::message')

            @yield('content')

        </div>

    </div>



</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="{{ asset('packages/teman/cms/js/bootstrap.min.js') }}"></script>

</body>

</html>