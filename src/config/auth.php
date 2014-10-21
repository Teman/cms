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

);