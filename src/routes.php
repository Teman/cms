<?php

/*
 * Set menu items
 */
View::share('adminMenuItems', Config::get('cms::adminMenuItems'));



/*
 * Auth routes
 */
Route::get('/cms/login', array( 'as' => 'cms.login', 'uses' => 'Teman\Cms\Controllers\AuthController@create'))->before('guest');
Route::post('/cms/login', array( 'as' => 'cms.login', 'uses' => 'Teman\Cms\Controllers\AuthController@store'))->before('guest');
Route::get('/cms/logout', array( 'as' => 'cms.logout', 'uses' => 'Teman\Cms\Controllers\AuthController@destroy'));


/*
 * General admin route
 */
Route::get('/admin', array('as' => 'admin', 'uses' => 'Teman\Cms\Controllers\AdminController@index'));


/*
 * User management routes
 */
Route::resource('/admin/users', 'Teman\Cms\Controllers\UsersController');
