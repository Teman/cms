<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ route('admin') }}">{{ $cms_title }}</a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <li><a target="_blank" href="{{ url('/') }}">Site</a></li>

                @if(Config::get('cms::auth.show_pass_change'))
                    <li><a href="{{ route('cms.auth.change_password') }}">{{ trans('cms::auth.change_password') }}</a></li>
                @endif

                <li><a href="{{ route('cms.noauth.logout') }}">{{ trans('cms::auth.logout') }}</a></li>
            </ul>
        </div>
    </div>
</div>