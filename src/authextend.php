<?php namespace Teman\Cms\Libraries;

use Illuminate\Support\ServiceProvider;

use Illuminate\Auth\Guard as AuthGuard;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\App;

use Illuminate\Hashing\BcryptHasher;
use Illuminate\Auth\EloquentUserProvider;


class CmsUserGuard extends AuthGuard
{
    public function getName()
    {
        return 'cms_login_'.md5(get_class($this));
    }

    public function getRecallerName()
    {
        return 'cms_remember_'.md5(get_class($this));
    }
}

Auth::extend('cms.user', function(){
    return new CmsUserGuard(new EloquentUserProvider(new BcryptHasher, 'Teman\Cms\Models\Entrust\User'), App::make('session.store'));
});