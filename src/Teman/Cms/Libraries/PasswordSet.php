<?php namespace Teman\Cms\Libraries;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Config;
use Laracasts\Validation\FormValidationException;
use Laracasts\Flash\Flash;
use Teman\Cms\Models\Entrust\User;

class PasswordSet
{

    static function setPasswordAndSendMail(User $user){
        //Set random temp password
        $user->password = sha1(time().'temp');
        $user->password_set = 0; //user needs to set password
        $user->password_token = static::createToken($user->email);

        //send mail..
        $data['username'] = $user->username;
        $data['token'] = $user->password_token;

        Mail::send(Config::get('cms::auth.confirm_mail_tpl'), $data, function($message) use($user)
        {
            $message->from(Config::get('cms::auth.from_email'), Config::get('cms::auth.from_name'));
            $message->to($user->email)->subject(trans('cms::confirm.subject'));
        });
        return $user;
    }

    static function createToken($email){
        return substr(strtolower(sha1($email.time())), 0, 50);
    }
}
