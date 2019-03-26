<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblGroupMembersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_group_members', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('group_id');
			$table->integer('contact_id');
			$table->dateTime('date_joined');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tbl_group_members');
	}

}
