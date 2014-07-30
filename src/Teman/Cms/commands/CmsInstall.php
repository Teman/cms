<?php namespace Teman\Cms\Commands;

use Teman\Cms\Models\Entrust\Permission;
use Teman\Cms\Models\Entrust\Role;
use Teman\Cms\Models\Entrust\User;
use Illuminate\Console\Command;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;

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
	protected $description = 'Install teman.CMS';

    protected $entered_email;
    protected $entered_password;

    protected $role_super_admin;
    protected $role_admin;

    protected $permission_cms_access;

	/**
	 * Create a new command instance.
	 *
	 * @return void
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

        if ( $this->isCmsInstalled() ){
            $this->comment('CMS already installed');
            return;
        }

        $this->intro();

        $this->migrateDatabase();
        $this->publishAssets();
        $this->publishConfigs();

        $this->askUserData();

        $validator = Validator::make([
                'email' => $this->entered_email,
                'password' => $this->entered_password
            ], [
                'email' => 'required|email',
                'password' => 'required|min:6'
            ]);


        while ( $validator->fails() ){

            foreach( $validator->messages()->all() as $message ){
                $this->comment($message);
            }

            $this->line('');

            $this->askUserData();
        }

        $this->createRolesAndPermissions();
        $this->createUser();

        $this->markInstalled();

        $this->done();

	}



    private function intro(){

        $this->info('Installing teman.CMS');
        $this->info('------------------');
        $this->info('');


    }

    private function migrateDatabase(){

        $this->info('Migrating database');
        $this->call('migrate:publish', array('package' => 'teman/cms'));

        $this->call('migrate');


    }


    private function publishAssets(){

        $this->info('Publishing CMS assets');
        $this->call('asset:publish', array('package' => 'teman/cms'));

    }


    private function publishConfigs(){

        $this->info('Publishing Polyglot config');
        $this->call('config:publish', array('package' => 'anahkiasen/polyglot'));

        $this->info('Publishing cms config');
        $this->call('config:publish', array('package' => 'teman/cms'));
    }


    private function askUserData(){

        $this->info('Create admin user');
        $this->entered_email = $this->ask('Admin email/login:');
        $this->entered_password = $this->secret('Admin password:');

    }



    private function createUser(){

        //create user
        $user = User::create( [
                'email' => $this->entered_email,
                'password' => $this->entered_password
            ] );

        //attach role to user
        $user->attachRole($this->role_super_admin->id);

        $this->info('User created');

    }


    private function createRolesAndPermissions(){
        //create roles
        $this->role_super_admin = Role::create(['name' => 'Super admin']);
        $this->role_admin = Role::create(['name' => 'Admin']);

        //create permission
        $this->permission_cms_access = Permission::create(['name' => 'access_cms', 'display_name' => 'Access CMS']);

        //attach permission to role
        $this->permission_cms_access->roles()->attach( $this->role_super_admin );
        $this->permission_cms_access->roles()->attach( $this->role_admin );

    }


    private function isCmsInstalled(){

        try{
            $installed = \Teman\Cms\Models\Cmsinstall::where('installed', 1)->count();
        } catch( QueryException $e ){
            $installed = 0;
        }


        return $installed ? true : false;

    }


    private function markInstalled(){

        \Teman\Cms\Models\Cmsinstall::create(['installed' => true]);
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
