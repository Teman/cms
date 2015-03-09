<?php namespace Teman\Cms\Controllers;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Teman\Cms\Libraries\PasswordSet;
use Laracasts\Validation\FormValidationException;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Password;
use Laracasts\Flash\Flash;
use Teman\Cms\Models\Entrust\User;

/**
 * PasswordController Class
 *
 * Allow users to change their password
 */
class PasswordController extends BaseController
{

    public $messages;

    function __construct()
    {
        $this->messages = ['hashmatch'=>trans('cms::auth.hasmatch'),
                           'usedbefore'=>trans('cms::auth.mustbedifferent', ['x'=>Config::get('cms::auth.password_different')])];

    }

    public function create($token){
        $user = User::where('password_token', $token)->where('password_set', false)->first();
        if($user){
            $data['id'] = $user->id;
            $data['token'] = $token;
            $data['username'] = $user->username;
            return View::make('cms::auth.password.set', $data);
        }else{
            Flash::error(trans('cms::confirm.invalid_token'));
            return Redirect::to(route('admin'));
        }
    }

    public function store(){

        $input = Input::all();
        $password_validation = 'required|confirmed|' . Config::get('cms::auth.password_validation_' . Config::get('cms::auth.password_validation'));

        $validator = Validator::make($input, [
            'token' => 'required',
            'password' => $password_validation,
        ], $this->messages);

        $token = Input::get('token');
        $id = Input::get('id');
        $user = User::where('id', $id)->where('password_token', $token)->where('password_set', false)->first();

        if($user){
            if ( $validator->fails() ){
                throw new FormValidationException('Validation failed', $validator->errors());
            }

            $user->password = Input::get('password');
            $user->password_set = true;
            $user->save();

            Flash::success(trans('cms::confirm.success'));
        }else{
            Flash::error(trans('cms::confirm.invalid_token'));
        }
        return Redirect::to(route('admin'));
    }

    public function change(){
        $user = Auth::user();
        if($user) {
            return View::make('cms::auth.password.change')->withUsername($user->username);
        }else{
            return Redirect::to(route('admin'));
        }
    }

    public function save_password(){
        $user = Auth::user();
        if($user) {
            $input = Input::all();
            $password_validation = 'required|confirmed|' . Config::get('cms::auth.password_validation_' . Config::get('cms::auth.password_validation'));

            $validator = Validator::make($input, [
                'current_password' => 'required|hashmatch',
                'password' => $password_validation,
            ], $this->messages);

            if ($validator->fails()) {
                throw new FormValidationException('Validation failed', $validator->errors());
            }

            //Save password
            $user->password = Input::get('password');
            $user->save();
            Flash::success(trans('cms::change.success'));
            return Redirect::back();
        }

        return Redirect::to(route('admin'));
    }

    public function expired(){
        $user = Auth::user();
        if($user){ // and $user->isExpired()) {
            return View::make('cms::auth.password.expired')->withUsername($user->username);
        }else{
            return Redirect::to(route('admin'));
        }
    }

    public function save_expired(){
        $user = Auth::user();
        if($user) {
            $input = Input::all();
            $password_validation = 'required|confirmed|usedbefore|' . Config::get('cms::auth.password_validation_' . Config::get('cms::auth.password_validation'));

            $validator = Validator::make($input, [
                'password' => $password_validation,
            ], $this->messages);

            if ($validator->fails()) {
                throw new FormValidationException('Validation failed', $validator->errors());
            }

            //Save password
            $user->password = Input::get('password');
            $user->save();
            Flash::success(trans('cms::change.success'));
        }

        return Redirect::to(route('admin'));
    }
}
