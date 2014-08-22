<?php namespace Teman\Cms\Libraries;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Config;
use Laracasts\Validation\FormValidationException;
use Laracasts\Flash\Flash;

class Authentication {

    /**
     * Process login
     * @param $loginForm
     * @return mixed
     */
    public static function doLogin($loginForm){
        $loginForm->validate($input = Input::only('email', 'password'));

        if (Auth::attempt($input)) {
            return Redirect::intended(route(Config::get('cms::auth.login_route')));
        }


        Flash::error('Invalid credentials');
        return Redirect::back()->withInput();
    }


    /**
     * Perform logout
     * @return mixed
     */
    public static function logout(){
        Auth::logout();
        return Redirect::to('/');
    }
} 