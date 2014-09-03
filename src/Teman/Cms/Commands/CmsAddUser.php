<?php namespace Teman\Cms\Commands;

use Teman\Cms\Models\Entrust\Permission;
use Teman\Cms\Models\Entrust\Role;
use Teman\Cms\Models\Entrust\User;
use Illuminate\Console\Command;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;

class CmsAddUser extends Command {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'cms:adduser';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add a CMS user';

    protected $entered_email;
    protected $entered_password;

    protected $role_super_admin;
    protected $role_admin;

    protected $permission_cms_access;

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
        $this->intro();

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

        $this->createRolesAndPermissions();
        $this->createUser();




        $this->done();

    }
    private function intro(){

        $this->info('Creating a new User');
        $this->info('------------------');
        $this->info('');


    }
    private function done(){
        $this->info('');
        $this->info('User Created ! Have fun');
    }
    private function validate($enterd_email, $enterd_password)
    {
        $validator = Validator::make([
            'email' => $enterd_email,
            'password' => $enterd_password
        ], [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        return $validator;
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
