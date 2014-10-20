<?php namespace Teman\Cms\Commands;

use Teman\Cms\Models\Entrust\Permission;
use Teman\Cms\Models\Entrust\Role;
use Teman\Cms\Models\Entrust\User;

use Illuminate\Console\Command;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

use Illuminate\Support\Facades\Config;

class CmsInstall extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'cms:install';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Install teman CMS';

    protected $entered_email;
    protected $entered_password;


    /**
     * Create a new command instance.
     *
     * @return \Teman\Cms\Commands\CmsInstall
     */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
        $tbl_prefix = Config::get('cms::table_prefix');
        Config::set('entrust::roles_table', $tbl_prefix.'roles');
        Config::set('entrust::assigned_roles_table', $tbl_prefix.'assigned_roles');
        Config::set('entrust::role', '\Teman\Cms\Models\Entrust\Role');

        $this->intro();
        $this->publishConfigs();
        $this->migrateDatabase();
        $this->publishAssets();
        $this->publishViews();
        $this->askUserData();

        $validator = $this->validate($this->entered_email,$this->entered_password);


        while ( $validator->fails() ){

            foreach( $validator->messages()->all() as $message ){
                $this->comment($message);
            }

            $this->line('');

            $this->askUserData();
            $validator = $this->validate($this->entered_email,$this->entered_password);
        }


        $this->createUser();

        $this->done();
        

	}

    private function validate($entered_email, $entered_password)
    {
        $validator = Validator::make([
            'email' => $entered_email,
            'password' => $entered_password
        ], [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        return $validator;
    }

    private function intro(){

        $this->info('Installing teman CMS');
        $this->info('------------------');
        $this->info('');


    }

    private function migrateDatabase(){
        $this->info('Publishing migrations for packages');
        $this->call('migrate:publish', array('package' => 'barryvdh/laravel-translation-manager'));
        $this->call('migrate:publish', array('package' => 'teman/cms'));

        $this->info('Migrating database');
        $this->call('migrate');

    }

    private function publishAssets(){

        $this->info('Publishing CMS assets');
        $this->call('asset:publish', array('package' => 'teman/cms'));

    }

    private function publishConfigs(){

        $this->info('Publishing Polyglot config');
        $this->call('config:publish', array('package' => 'anahkiasen/polyglot'));

        // since this is not in the tagged release we can't do this (yet)
        // $this->info('Publishing translation config');
        // $this->call('config:publish', array('package' => 'barryvdh/laravel-translation-manager'));

        $this->info('Publishing cms config');
        $this->call('config:publish', array('package' => 'teman/cms'));
    }

    private function publishViews(){
        $this->info('Publishing Translator views');
        $this->call('view:publish', array('package' => 'barryvdh/laravel-translation-manager'));

        // override the translation view template with our cms-friendly version
        $this->info('overwriting translations view to match cms interface and custom tweaks');
        File::copy(
            'vendor/teman/cms/src/Teman/Cms/viewTemplate/translations.override.txt',
            'app/views/packages/barryvdh/laravel-translation-manager/index.blade.php'
        );
    }


    private function askUserData(){

        $this->info('Create admin user');
        $this->entered_email = $this->ask('Admin email/login:');
        $this->entered_password = $this->secret('Admin password:');

    }

    private function createUser(){

        //create user
        $user = new User;
        $user->email = $this->entered_email;
        $user->password = $this->entered_password;
        $user->save();

        //attach role to user
        $role_super_admin = Role::where('name', 'Super admin')->first();
        $user->attachRole( $role_super_admin->id );
        $this->info('User created');

    }

    private function done(){
        $this->info('');
        $this->info('Install done, have fun!');
    }


	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(
			//array('example', InputArgument::REQUIRED, 'An example argument.'),
		);
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array(
			//array('example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null),
		);
	}

}
