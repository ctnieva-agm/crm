<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblEmailTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_email', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('email_id');
			$table->string('member_vip_number', 19);
			$table->string('full_name', 55);
			$table->string('email', 100);
			$table->string('system_id', 20);
			$table->string('phone_number', 100);
			$table->dateTime('date_registered');
			$table->string('status', 11);
			$table->string('sponsored_by');
			$table->dateTime('date_sync');
			$table->string('update_vip_number', 55);
			$table->date('save_activation_date');
			$table->string('source', 200);
			$table->enum('subscription', array('pending','subscribed','unsubscribed'));
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tbl_email');
	}

}
