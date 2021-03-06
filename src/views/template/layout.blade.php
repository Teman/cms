<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{{ $page_title or $cms_title }}}</title>

        <link href="{{ asset('packages/teman/cms/css/vendor/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('packages/teman/cms/css/vendor/bootstrap-theme.min.css') }}" rel="stylesheet">
        <link href="{{ asset('packages/teman/cms/css/vendor/font-awesome.css') }}" rel="stylesheet">

        <link href="{{ asset('packages/teman/cms/css/cms.css') }}" rel="stylesheet">
        
        @yield('links')

    </head>

    <body>

        @include('cms::template.partials.navbar')

        <div class="container-fluid">

            <div class="row">
                @include('cms::template.partials.sidebar')

                <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

                    <p class="visible-xs btn-toggle-offcanvas">
                        <button class="btn btn-link navbar-toggle" data-toggle="offcanvas">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </p>

                    <div id="messages" class="row">
                        <div class="col-md-5">
                            @if (Session::has('flash_message'))
                                <div class="alert alert-info fade in" role="alert">
                                    {{ Session::get('flash_message') }}
                                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                </div>
                            @else
                                @include('flash::message')
                            @endif
                        </div>
                    </div>

                    @yield('content')

                </div>

            </div>

        </div>

        <script src="{{ asset('packages/teman/cms/js/vendor/jquery.1.11.1.min.js') }}"></script>
        <script src="{{ asset('packages/teman/cms/js/vendor/bootstrap.min.js') }}"></script>
        <script src="{{ asset('packages/teman/cms/js/vendor/tinymce/tinymce.min.js') }}"></script>

        <script src="{{ asset('packages/teman/cms/js/cms.js') }}"></script>
        @yield('scripts')

    </body>

</html>
