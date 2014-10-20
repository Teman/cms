<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

use Illuminate\Support\Facades\Config;

class CreateCmsUsersTable extends Migration {

	protected $table_prefix;

	function __construct(){
		$this->table_prefix = Config::get('cms::table_prefix');
	}

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// Create users
		Schema::create($this->table_prefix.'users', function(Blueprint $table)
		{
			$table->increments('id');

			$table->string('email')->unique();
			$table->string('username')->unique();
			$table->string('password');
			
			$table->string('confirmation_code');
      $table->boolean('confirmed')->default(false);
      $table->string('remember_token');

			$table->timestamps();
		});

		// Creates password reminders table
    Schema::create($this->table_prefix.'password_reminders', function ($table) {

        $table->string('email');
        $table->string('token');
        
        $table->timestamp('created_at');
    });
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop($this->table_prefix.'users');
		Schema::drop($this->table_prefix.'password_reminders');
	}

}
