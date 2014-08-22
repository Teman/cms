<?php namespace Teman\Cms\Forms;

use Laracasts\Validation\FormValidator;

class ResetPasswordForm extends FormValidator{

    protected $rules = [
        "email" => "required|email",
        "token" => "required",
        "password" => "required|confirmed|min:6",
    ];

}