<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePasswordHistoryTable extends Migration {

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
        Schema::create($this->table_prefix.'password_history', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on($this->table_prefix.'users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->string('password');
            $table->timestamps();
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop($this->table_prefix.'password_history');
	}

}
