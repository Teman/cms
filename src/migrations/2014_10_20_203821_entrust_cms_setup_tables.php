<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Config;

use Teman\Cms\Models\Entrust\Permission;
use Teman\Cms\Models\Entrust\Role;

class EntrustCmsSetupTables extends Migration {

    /**
     * Run the migrations.
     *
     * @return  void
     */

    protected $role_super_admin;
    protected $role_admin;
    protected $role_user;
    protected $table_prefix;

    protected $permission_cms_access;
    protected $permission_manage_users;

    function __construct()
    {
        $this->table_prefix = Config::get('cms::table_prefix');
    }

    public function up()
    {
        // Creates the roles table
        Schema::create($this->table_prefix.'roles', function($table)
        {
            $table->increments('id')->unsigned();
            $table->string('name')->unique();
            $table->timestamps();
        });

        // Creates the assigned_roles (Many-to-Many relation) table
        Schema::create($this->table_prefix.'assigned_roles', function($table)
        {
            $table->increments('id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('role_id')->unsigned();
            $table->foreign('user_id')->references('id')->on($this->table_prefix.'users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on($this->table_prefix.'roles');
        });

        // Creates the permissions table
        Schema::create($this->table_prefix.'permissions', function($table)
        {
            $table->increments('id')->unsigned();
            $table->string('name')->unique();
            $table->string('display_name');
            $table->timestamps();
        });

        // Creates the permission_role (Many-to-Many relation) table
        Schema::create($this->table_prefix.'permission_role', function($table)
        {
            $table->increments('id')->unsigned();
            $table->integer('permission_id')->unsigned();
            $table->integer('role_id')->unsigned();
            $table->foreign('permission_id')->references('id')->on($this->table_prefix.'permissions'); // assumes a users table
            $table->foreign('role_id')->references('id')->on($this->table_prefix.'roles');
        });

        //use cms namespaced models for migration
        Config::set('entrust::roles_table', $this->table_prefix.'roles');
        Config::set('entrust::role', '\Teman\Cms\Models\Entrust\Role');
        Config::set('entrust::permission_role_table', $this->table_prefix.'permission_role');

        //create roles
        $this->role_super_admin = Role::create(['name' => 'Super admin']);
        $this->role_admin = Role::create(['name' => 'Admin']);
        $this->role_user = Role::create(['name'=>'User']);
        $this->role_translator = Role::create(['name'=>'Translator']);

        //create permission
        $this->permission_cms_access = Permission::create(['name' => 'access_cms', 'display_name' => 'Access CMS']);
        $this->permission_manage_users = Permission::create(['name'=> 'manage_users','display_name' => 'Manage Users']);
        $this->permission_manage_translations = Permission::create(['name'=> 'manage_translations','display_name' => 'Manage Translations']);

        //attach permission to role
        $this->permission_cms_access->roles()->attach( $this->role_super_admin );
        $this->permission_cms_access->roles()->attach( $this->role_admin );
        $this->permission_manage_users->roles()->attach( $this->role_user );
        $this->permission_manage_translations->roles()->attach( $this->role_translator );

    }

    /**
     * Reverse the migrations.
     *
     * @return  void
     */
    public function down()
    {
        Schema::table($this->table_prefix.'assigned_roles', function(Blueprint $table) {
            $table->dropForeign($this->table_prefix.'assigned_roles_user_id_foreign');
            $table->dropForeign($this->table_prefix.'assigned_roles_role_id_foreign');
        });

        Schema::table('permission_role', function(Blueprint $table) {
            $table->dropForeign($this->table_prefix.'permission_role_permission_id_foreign');
            $table->dropForeign($this->table_prefix.'permission_role_role_id_foreign');
        });

        Schema::drop($this->table_prefix.'assigned_roles');
        Schema::drop($this->table_prefix.'permission_role');
        Schema::drop($this->table_prefix.'roles');
        Schema::drop($this->table_prefix.'permissions');
    }

}
