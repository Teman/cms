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

        @if ( ! Auth::guest() )
            @include('cms::template.partials.navbar')
        @endif

        <div class="container">

            @if (Session::has('flash_message'))
                <div class="alert alert-info" role="alert">{{ Session::get('flash_message') }}</div>
            @endif

            @yield('content')
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="{{ asset('packages/teman/cms/js/bootstrap.min.js') }}"></script>

    </body>

</html>
