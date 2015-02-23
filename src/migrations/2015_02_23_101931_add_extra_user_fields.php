<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Config;

class AddExtraUserFields extends Migration {

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
            $table->boolean('password_set')->default(true);
            $table->dateTime('expires')->nullable();
            $table->text('password_token')->nullable();
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
            $table->dropColumn('password_set');
            $table->dropColumn('expires');
            $table->dropColumn('password_token');
        });
	}

}
