<?php

Route::filter('admin', function()
{   
    if (substr(Route::currentRouteName(), 0, 10) != 'cms.noauth') {
        
        if (Auth::guest())
        {
            if (Request::ajax())
            {
                return Response::make('Unauthorized', 401);
            }
            else
            {
                return Redirect::guest( URL::route('cms.noauth.login') );
            }
        }

        if ( ! Auth::user()->can('access_cms') ){
            return Redirect::guest( URL::route('cms.noauth.login') );
        }

        View::share("currentUser", Auth::user());
    }
});

Route::when('admin', 'admin');
Route::when('admin/*', 'admin');

App::before(function($request){
    if ($request->is('admin*'))
    {        
        $tbl_prefix = $this->app['config']->get('cms::table_prefix');
        $this->app['config']->set('entrust::roles_table', $tbl_prefix.'roles');
        $this->app['config']->set('entrust::permissions_table', $tbl_prefix.'permissions');
        $this->app['config']->set('entrust::permission_role_table', $tbl_prefix.'permission_role');
        $this->app['config']->set('entrust::assigned_roles_table', $tbl_prefix.'assigned_roles');

        $this->app['config']->set('entrust::role', '\Teman\Cms\Models\Entrust\Role');
        $this->app['config']->set('entrust::permission', '\Teman\Cms\Models\Entrust\Permission');
        
        $this->app['config']->set('auth.model', '\Teman\Cms\Models\Entrust\User');
        $this->app['config']->set('auth.driver', 'cms.user');
    }
});