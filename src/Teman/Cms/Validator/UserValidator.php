<?php namespace Teman\Cms\Validator;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Config;
use Illuminate\Validation\Validator;

class UserValidator extends Validator{


    //check that password matches current user's
    public function validateHashmatch($attribute, $value, $parameters){
        return (Hash::check($value, Auth::user()->password));
    }

    //check that password is different rom current user's password
    public function validateUsedbefore($attribute, $value, $parameters){
        $previous = Auth::user()->oldPasswords();
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