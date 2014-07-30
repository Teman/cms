<?php namespace Teman\Cms;

use Illuminate\Support\ServiceProvider;
use Laracasts\Validation\FormValidationException;

class CmsServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{

        $this->package('teman/cms');

        /**
         * Include routes and filters
         */
        include __DIR__ . '/../../routes.php';
        include __DIR__ . '/../../filters.php';

        /*
         * Include helpers
         */
        include __DIR__ . '/helpers.php';

        //make Auth use our own User model
        $this->app['config']->set('auth.model', '\Teman\Cms\Models\Entrust\User');

        $this->app['config']->set('entrust::role', '\Teman\Cms\Models\Entrust\Role');
        $this->app['config']->set('entrust::permission', '\Teman\Cms\Models\Entrust\Permission');

        //register artisan commands
        $this->commands('Teman\Cms\Commands\CmsInstall');

	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{

        //register service providers we depend on
        $this->app->register('Laracasts\Validation\ValidationServiceProvider');
        $this->app->register('Zizaco\Entrust\EntrustServiceProvider');
        $this->app->register('Polyglot\PolyglotServiceProvider');

        //alias facades
        $this->app->booting(function()
        {
            $loader = \Illuminate\Foundation\AliasLoader::getInstance();
            $loader->alias('Entrust', 'Zizaco\Entrust\EntrustFacade');
        });

        //exception handlers
        $this->registerExceptions();
	}


    /**
     * Register Exceptions on the app.
     *
     * @return void
     */
    private function registerExceptions()
    {

        $this->app->error( function( FormValidationException $exception )
        {

            return $this->app['redirect']->back()->withInput()->withErrors($exception->getErrors());
        } );
    }


	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array(
        );
	}

}
