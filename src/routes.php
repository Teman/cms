<?php

/*
 * Set menu items
 */
View::share('adminMenuItems', Config::get('cms::adminMenuItems'));

/*
 * Set CMS title
 */
View::share('cms_title', Config::get('cms::title'));


/*
 * Auth routes
 */
Route::get('/admin/auth/login', array( 'as' => 'cms.noauth.login', 'uses' => 'Teman\Cms\Controllers\AuthController@create'))->before('guest');
Route::post('/admin/auth/login', array( 'as' => 'cms.noauth.login', 'uses' => 'Teman\Cms\Controllers\AuthController@store'))->before('guest');
Route::get('/admin/auth/logout', array( 'as' => 'cms.noauth.logout', 'uses' => 'Teman\Cms\Controllers\AuthController@destroy'));

/*
 * Forgot password routes
 */
Route::get('/admin/auth/forgot_password', ['as'=> 'cms.noauth.forgot.form', 'uses'=>'Teman\Cms\Controllers\ForgotController@forgotPassword']);
Route::post('/admin/auth/forgot_password', ['as'=>'cms.noauth.forgot.process', 'uses'=>'Teman\Cms\Controllers\ForgotController@postRemind']);
Route::get('/admin/auth/confirm/{code}', ['as'=>'cms.noauth.forgot.confirm', 'uses'=>'Teman\Cms\Controllers\ForgotController@confirm']);
Route::get('/admin/auth/password/reset/{token}', ['as'=>'cms.noauth.forgot.token', 'uses'=>'Teman\Cms\Controllers\ForgotController@getReset']);
Route::post('/admin/auth/reset_password', ['as'=>'cms.noauth.forgot.reset', 'uses'=>'Teman\Cms\Controllers\ForgotController@postReset']);

/*
 * General admin route
 */
Route::get('/admin', array('as' => 'admin', 'uses' => 'Teman\Cms\Controllers\AdminController@index'));

/*
 * User management routes
 */
Route::resource('/admin/users', 'Teman\Cms\Controllers\UsersController');

/*
 * Translations management
 */
Route::controller('/admin/translations', 'Barryvdh\TranslationManager\Controller');