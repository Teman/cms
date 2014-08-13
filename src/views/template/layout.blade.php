<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ $cmsTitle }}</title>

        <link href="{{ asset('packages/teman/cms/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('packages/teman/cms/css/bootstrap-theme.min.css') }}" rel="stylesheet">

        <link href="{{ asset('packages/teman/cms/css/dashboard.css') }}" rel="stylesheet">
        <link href="{{ asset('packages/teman/cms/css/style.css') }}" rel="stylesheet">

    </head>

    <body>

        @if ( ! Auth::guest() )
            @include('cms::template.partials.navbar')
        @endif

        <div class="container-fluid">


            <div class="row row-offcanvas row-offcanvas-left">

            @include('cms::template.partials.sidebar')

                <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

                    @section('btn-offcanvas')
                        <p class="pull-left visible-xs btn-toggle-offcanvas">
                            <button class="btn btn-link navbar-toggle" data-toggle="offcanvas">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </p>
                    @show

                    @if (Session::has('flash_message'))
                        <div class="alert alert-info" role="alert">{{ Session::get('flash_message') }}</div>
                    @endif

                    @yield('content')

                </div>

            </div>



        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="{{ asset('packages/teman/cms/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('packages/teman/cms/js/script.js') }}"></script>

    </body>

</html>
