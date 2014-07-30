<?php

Route::filter('admin', function()
{
    if (Auth::guest())
    {
        if (Request::ajax())
        {
            return Response::make('Unauthorized', 401);
        }
        else
        {
            return Redirect::guest( URL::route('cms.login') );
        }
    }

    if ( ! Auth::user()->can('access_cms') ){

        return Redirect::guest( URL::route('cms.login') );
    }
});

Route::when('admin', 'admin');
Route::when('admin/*', 'admin');