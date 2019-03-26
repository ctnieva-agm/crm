<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblPofEmailTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_pof_email', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('email_id');
			$table->string('email', 100);
			$table->enum('subscription_status', array('subscribed','unsubscribed','pending'));
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tbl_pof_email');
	}

}
