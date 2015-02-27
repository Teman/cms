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

Route::get('/admin/auth/set_password/{token}', ['as'=> 'cms.noauth.password.form', 'uses'=>'Teman\Cms\Controllers\PasswordController@create']);
Route::post('/admin/auth/set_password', ['as'=> 'cms.noauth.password.store', 'uses'=>'Teman\Cms\Controllers\PasswordController@store']);

Route::get('/admin/auth/expired', ['as'=> 'cms.noauth.password_expired.form', 'uses'=>'Teman\Cms\Controllers\PasswordController@expired']);
Route::post('/admin/auth/set_expired', ['as'=> 'cms.noauth.password_expired.save', 'uses'=>'Teman\Cms\Controllers\PasswordController@save_expired']);

Route::get('/admin/auth/change_password', ['as'=> 'cms.auth.change_password', 'uses'=>'Teman\Cms\Controllers\PasswordController@change']);
Route::post('/admin/auth/change_password', ['as'=> 'cms.auth.change_password.save', 'uses'=>'Teman\Cms\Controllers\PasswordController@save_password']);


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
Route::get('/admin/translations/download', [ 'as' => 'translation.download', 'uses' => 'Teman\Cms\Controllers\ExportTranslationsController@index']);
Route::controller('/admin/translations', 'Barryvdh\TranslationManager\Controller', ['getIndex'=>'admin.languages.interface']);
