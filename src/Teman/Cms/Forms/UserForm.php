<?php namespace Teman\Cms\Forms;

use Laracasts\Validation\FormValidator;

class UserForm extends FormValidator{

    protected $rules = [
        "email" => 'required|email',
        "password" => 'required|min:6',
        "role_id" => 'required|integer'
    ];

}