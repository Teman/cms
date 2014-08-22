<?php namespace Teman\Cms\Forms;

use Laracasts\Validation\FormValidator;

class ForgotForm extends FormValidator{

    protected $rules = [
        "email" => "required|email"
    ];

}