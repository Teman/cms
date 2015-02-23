<?php namespace Teman\Cms\Forms;

use Illuminate\Support\Facades\Config;
use Laracasts\Validation\FormValidator;
use Laracasts\Validation\FactoryInterface as ValidatorFactory;

class ResetPasswordForm extends FormValidator{


    protected $rules = [
        "email" => "required|email",
        "token" => "required",
        "password" => "required|confirmed|min:6",
    ];

    /**
     * @param ValidatorFactory $validator
     */
    function __construct(ValidatorFactory $validator)
    {
        $this->validator = $validator;

        //load strict or basic vlidation from config
        $this->rules['password'] = "required|confirmed|".Config::get('cms::auth.password_validation_'.Config::get('cms::auth.password_validation'));
    }
}