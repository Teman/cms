<?php


use Carbon\Carbon;
use Illuminate\Support\Facades\Request;

Route::filter('admin', /**
     *
     */
    function()
{

    $user = Auth::user();
    View::share("currentUser", $user);

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

        if ( ! $user->can('access_cms') ){
            return Redirect::guest( URL::route('cms.noauth.login') );
        }

        //does user need to change password?
        if($days = Config::get('cms::auth.password_valid')){
            if($user->expires){
                if($user->isExpired()){
                    return Redirect::to(route('cms.noauth.password_expired.form'));
                }
            }else{
                //no expiry date set
                $user->setPasswordExpiry()->save();
            }
        }

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
        $this->app['config']->set('auth.reminder.email', 'cms::emails.passwordreset');
    }
});


Route::filter('permission', function($route, $request, $param){
    $permissions = explode(';', $param);

    //user must have all permissions
    $user = Auth::user();
    if($user){
        $has_permission = true;
        //user must have all permissions
        foreach($permissions as $perm) {
            if (!$user->can($perm)){
                $has_permission = false;
            }
        }
    }else{
        $has_permission = false;
    }

    if(!$has_permission) {
        if(Request::ajax()){
            return App::abort(403, 'Access denied');
        }else {
            Flash::error(trans('cms::auth.permission_denied'));
            return Redirect::to(route('admin'));
        }
    }
});