<div class="col-sm-3 col-md-2 sidebar" role="navigation">

    <ul class="nav nav-sidebar">
        @if ( isset( $adminMenuItems ) )
            @foreach($adminMenuItems as $menuItem)
                <li class="{{ set_active_route($menuItem['route']) }}"><a href="{{ route($menuItem['route']) }}">{{ $menuItem['title'] }}</a></li>
            @endforeach
        @endif
    </ul>


    <h4>Users</h4>
    <ul class="nav nav-sidebar">
        <li class="{{ set_active_route('admin.users.index') }}"><a href="{{ route('admin.users.index') }}">Users</a></li>
    </ul>

</div>
