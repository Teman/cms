<?php namespace Teman\Cms\Libraries;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Config;
use Laracasts\Validation\FormValidationException;
use Laracasts\Flash\Flash;
use Teman\Cms\Models\Entrust\User;

class Authentication {

    /**
     * Set invalid login flash message and keep track of failed attempts
     * @param bool $email
     */
    public static function failedLogin($email=false){
        if(!$email){ $email = Input::get('email'); }

        $max_attempts = Config::get('cms::auth.lockout_after_attempts');
        Flash::error(trans('cms::auth.invalid'));
        if($max_attempts > 0) {
            $user = User::where('email', $email)->first();
            if($user and ($user->login_attempts+1) >= $max_attempts){
                Flash::error(trans('cms::auth.maxattempts'));
            }

            //save last failed attempt
            $user->login_attempts++;
            $user->last_login_attempt = Carbon::now();
            $user->save();
        }
    }

    /**
     * Check that max login attempts ahsn't been reached
     * @param bool $email
     * @return bool
     */
    public static function maxLoginAttemptNotReached($email=false){
        if(!$email){ $email = Input::get('email'); }

        $max_attempts = Config::get('cms::auth.lockout_after_attempts');
        if($max_attempts > 0) {
            $user = User::where('email', $email)->first();
            if($user and $user->login_attempts >= $max_attempts){
                Flash::error(trans('cms::auth.maxattempts'));
                return false;
            }
        }
        return true;
    }

    private static function succesfullLogin($user){
        Flash::success(trans('cms::auth.welcome'));

        if(Config::get('cms::auth.lockout_after_attempts')){
            //save last failed attempt
            $user->login_attempts = 0;
            $user->last_login_attempt = Carbon::now();
            $user->save();
        }
    }

    /**
     * Process login
     * @param $loginForm
     * @return mixed
     */
    public static function doLogin($loginForm){
        $loginForm->validate($input = Input::only('email', 'password'));

        if (static::maxLoginAttemptNotReached() and Auth::attempt($input)) {
            static::succesfullLogin(Auth::user());
            if($redirect = Input::get("redirect")){
                Redirect::to($redirect);
            }else{
                //Default redirect
                return  Redirect::intended(route(Config::get('cms::auth.login_route')));
            }
        }
        //set the flash message
        static::failedLogin();
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