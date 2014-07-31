<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ route('admin') }}">{{ $cmsTitle }}</a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="{{ set_active_route('admin', false) }}"><a href="{{ route('admin') }}">Home</a></li>

                @if ( isset( $adminMenuItems ) )
                    @foreach($adminMenuItems as $menuItem)
                        <li class="{{ set_active_route($menuItem['route']) }}"><a href="{{ route($menuItem['route']) }}">{{ $menuItem['title'] }}</a></li>
                    @endforeach
                @endif

                <li class="{{ set_active_route('admin.users.index') }}"><a href="{{ route('admin.users.index') }}">Users</a></li>

            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="{{ route('cms.logout') }}">Logout</a></li>
            </ul>
        </div>
    </div>
</div>