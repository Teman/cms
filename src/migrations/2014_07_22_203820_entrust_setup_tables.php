<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Teman\Cms\Models\Entrust\Permission;
use Teman\Cms\Models\Entrust\Role;


class EntrustSetupTables extends Migration {

    /**
     * Run the migrations.
     *
     * @return  void
     */

    protected $role_super_admin;
    protected $role_admin;
    protected $role_user;

    protected $permission_cms_access;
    protected $permission_manage_users;



    public function up()
    {
        // Creates the roles table
        Schema::create('roles', function($table)
        {
            $table->increments('id')->unsigned();
            $table->string('name')->unique();
            $table->timestamps();
        });

        // Creates the assigned_roles (Many-to-Many relation) table
        Schema::create('assigned_roles', function($table)
        {
            $table->increments('id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('role_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('roles');
        });

        // Creates the permissions table
        Schema::create('permissions', function($table)
        {
            $table->increments('id')->unsigned();
            $table->string('name')->unique();
            $table->string('display_name');
            $table->timestamps();
        });

        // Creates the permission_role (Many-to-Many relation) table
        Schema::create('permission_role', function($table)
        {
            $table->increments('id')->unsigned();
            $table->integer('permission_id')->unsigned();
            $table->integer('role_id')->unsigned();
            $table->foreign('permission_id')->references('id')->on('permissions'); // assumes a users table
            $table->foreign('role_id')->references('id')->on('roles');
        });


        //create roles
        $this->role_super_admin = Role::create(['name' => 'Super admin']);
        $this->role_admin = Role::create(['name' => 'Admin']);
        $this->role_user = Role::create(['name'=>'User']);



        //create permission
        $this->permission_cms_access = Permission::create(['name' => 'access_cms', 'display_name' => 'Access CMS']);
        $this->permission_manage_users = Permission::create(['name'=> 'manage_users','display_name' => 'Manage Users']);


        //attach permission to role
        $this->permission_cms_access->roles()->attach( $this->role_super_admin );
        $this->permission_cms_access->roles()->attach( $this->role_admin );
        $this->permission_manage_users->roles()->attach( $this->role_user );

    }

    /**
     * Reverse the migrations.
     *
     * @return  void
     */
    public function down()
    {
        Schema::table('assigned_roles', function(Blueprint $table) {
            $table->dropForeign('assigned_roles_user_id_foreign');
            $table->dropForeign('assigned_roles_role_id_foreign');
        });

        Schema::table('permission_role', function(Blueprint $table) {
            $table->dropForeign('permission_role_permission_id_foreign');
            $table->dropForeign('permission_role_role_id_foreign');
        });

        Schema::drop('assigned_roles');
        Schema::drop('permission_role');
        Schema::drop('roles');
        Schema::drop('permissions');
    }

}
