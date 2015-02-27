<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLoginattemptFields extends Migration {

    function __construct()
    {
        $this->table_prefix = Config::get('cms::table_prefix');
    }
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::table($this->table_prefix.'users', function(Blueprint $table)
        {
            $table->integer('login_attempts')->nullable()->default(0);
            $table->dateTime('last_login_attempt')->nullable();
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::table($this->table_prefix.'users', function(Blueprint $table)
        {
            $table->dropColumn('login_attempts');
            $table->dropColumn('last_login_attempt');
        });
	}

}
