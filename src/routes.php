<?php

/*
 * Set menu items
 */
View::share('adminMenuItems', Config::get('cms::adminMenuItems'));

/*
 * Set CMS title
 */
View::share('cmsTitle', Config::get('cms::cmsTitle'));


/*
 * Auth routes
 */
Route::get('/cms/login', array( 'as' => 'cms.login', 'uses' => 'Teman\Cms\Controllers\AuthController@create'))->before('guest');
Route::post('/cms/login', array( 'as' => 'cms.login', 'uses' => 'Teman\Cms\Controllers\AuthController@store'))->before('guest');
Route::get('/cms/logout', array( 'as' => 'cms.logout', 'uses' => 'Teman\Cms\Controllers\AuthController@destroy'));


/*
 * Forgot password routes
 */
Route::get('/cms/forgot_password', ['as'=> 'forgot.password.form', 'uses'=>'Teman\Cms\Controllers\ForgotController@forgotPassword']);
Route::post('/cms/forgot_password', ['as'=>'forgot.password.process', 'uses'=>'Teman\Cms\Controllers\ForgotController@doForgotPassword']);
Route::get('/cms/confirm/{code}', ['as'=>'forgot.confirm', 'uses'=>'Teman\Cms\Controllers\ForgotController@confirm']);
Route::get('/cms/reset_password/{token}', ['as'=>'forgot.resettoken', 'uses'=>'Teman\Cms\Controllers\ForgotController@resetPassword']);
Route::post('/cms/reset_password', ['as'=>'forgot.reset', 'uses'=>'Teman\Cms\Controllers\ForgotController@doResetPassword']);



/*
 * General admin route
 */
Route::get('/admin', array('as' => 'admin', 'uses' => 'Teman\Cms\Controllers\AdminController@index'));


/*
 * User management routes
 */
Route::resource('/admin/users', 'Teman\Cms\Controllers\UsersController');
