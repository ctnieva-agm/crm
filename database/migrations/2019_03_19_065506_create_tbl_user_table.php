<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_user', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('name', 55);
			$table->string('email', 55);
			$table->string('company', 55);
			$table->string('position', 55);
			$table->string('contact_number', 20);
			$table->dateTime('date_registered');
			$table->string('username', 55);
			$table->string('password', 55);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tbl_user');
	}

}
