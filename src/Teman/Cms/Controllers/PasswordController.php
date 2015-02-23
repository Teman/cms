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
 * ForgotController Class
 *
 * Implements actions regarding user password resetting
 */
class PasswordController extends BaseController
{


    function __construct()
    {
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
        ]);

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

            Validator::extend('hashmatch', function($attribute, $value, $parameters)
            {
                return Hash::check($value, Auth::user()->password);
            });

            $messages = ['hashmatch'=>trans('cms::auth.hasmatch')];

            $validator = Validator::make($input, [
                'current_password' => 'required|hashmatch',
                'password' => $password_validation,
            ], $messages);

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
}
