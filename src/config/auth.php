<?php

return array(
    /**
     * Auth related views
     */
    'login_view'        => 'cms::auth.login',
    'forgot_view'       => 'cms::auth.forgot.forgot_password',
    'reset_view'       => 'cms::auth.forgot.reset_password',

    /**
     * Default routes
     */
    //redirect after password change
    'success_route'     => 'cms.noauth.login',
    //fallback for "intended" route
    'login_route'       => 'admin',

    //User model has username?
    'has_username'      => true,

    /**
     * Extra security
     */
    //new users can set their own password
    'can_set_password' => false,

    'password_validation' => 'basic', //basic or strict
    'password_validation_basic' => 'min:6',
    'password_validation_strict' => 'min:8|max:24|different:email|case_diff|numbers|letters|symbols',

    //username validation rules
    'user_validation' => 'email',

    //number of days until expiry, 0= never expire
    'password_valid' => 0,

    //confirmation email new account
    'confirm_mail_tpl' => 'cms::emails.confirm',
    'from_name' => 'Teman CMS',
    'from_email' => 'no-reply@temancms.app',

    //show password change in nav
    'show_pass_change' => false,
);