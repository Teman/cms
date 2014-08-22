<?php

return array(
    /**
     * Auth related views
     */
    'login_view'        => 'cms::auth.login',
    'forgot_view'       => 'cms::auth.forgot.forgot_password',

    /**
     * Default routes
     */
    //redirect after password change
    'success_route'     => 'cms.login',
    //fallback for "intended" route
    'login_route'       => 'admin'


);