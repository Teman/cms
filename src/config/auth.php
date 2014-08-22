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
    'success_route'     => 'cms.login',
    //fallback for "intended" route
    'login_route'       => 'admin',

    //Use the cms User Model
    //If set to false User model must extend Teman\Cms\Models\Entrust\User
    'use_cms_model'     => true

);