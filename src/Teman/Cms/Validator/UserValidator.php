<?php namespace Teman\Cms\Validator;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;
use Illuminate\Validation\Validator;
use Teman\Cms\Models\Entrust\User;

class UserValidator extends Validator{


    //check that password matches current user's
    public function validateHashmatch($attribute, $value, $parameters){
        return (Hash::check($value, Auth::user()->password));
    }

    //check that password is different rom current user's password
    public function validateUsedbefore($attribute, $value, $parameters){
        if(!Input::get('email')){
            $user = Auth::user();
        }elseif(Input::get('email')){
            $user = User::where('email', Input::get('email'))->first();
        }

        if($user){
            $previous = $user->oldPasswords();
        }else {
            $previous = false; //no user found
        }

        if($previous){
            foreach($previous as $hash){
                if(Hash::check($value, $hash)){
                    //already used
                    return false;
                }
            }
        }

        return true;
    }
} 