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
        <li class="{{ set_active_route('admin.users.index') }} ">
            <a href="{{ route('admin.users.index') }}" class="clearfix listItem">
                <i class="fa fa-user"></i>
                <div>
                    Users
                </div>
               </a>
        </li>

    </ul>

    <h4>richtextbox editor test</h4>
    <ul class="nav nav-sidebar">
        <li class="{{ set_active_route('admin.textbox.index') }} ">
            <a href="{{ route('admin.textbox.index') }}" class="clearfix listItem">
                <i class="fa fa-file-text"></i>
                <div>
                   rich text editor
                </div>
            </a>
        </li>

    </ul>

</div>
