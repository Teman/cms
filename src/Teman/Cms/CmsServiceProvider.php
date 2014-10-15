<?php namespace Teman\Cms;

use Illuminate\Support\ServiceProvider;
use Laracasts\Validation\FormValidationException;
use Laracasts\Flash\Flash;
use Teman\Cms\Commands\CmsInstall;

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
        $this->app->register('Laracasts\Flash\FlashServiceProvider');
        $this->app->register('Way\Generators\GeneratorsServiceProvider');
        $this->app->register('Mews\Purifier\PurifierServiceProvider');
        $this->app->register('Barryvdh\TranslationManager\ManagerServiceProvider');
        //alias facades
        $this->app->booting(function()
        {
            $loader = \Illuminate\Foundation\AliasLoader::getInstance();
            $loader->alias('Entrust', 'Zizaco\Entrust\EntrustFacade');
            $loader->alias('Confide', 'Zizaco\Confide\Facade');
            $loader->alias('Flash', 'Laracasts\Flash\Flash');
            $loader->alias('Authentication', 'Teman\Cms\Authentication');
            $loader->alias('Purifier', 'Mews\Purifier\Facades\Purifier');
            $loader->alias('BaseController', 'Teman\Cms\Controllers\BaseController');
        });

        //register artisan commands
        $this->app->bind('command.cms.install', 'Teman\Cms\Commands\CmsInstall');
        $this->app->bind('command.cms.adduser', 'Teman\Cms\Commands\CmsAddUser');
        $this->app->bind('command.cms.packageCreator','Teman\Cms\Commands\PackageGeneratorCommand');

        $this->commands(['command.cms.install', 'command.cms.adduser', 'command.cms.packageCreator']);

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
		return [];
	}

}
