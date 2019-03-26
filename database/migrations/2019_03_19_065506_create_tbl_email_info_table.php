<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblEmailInfoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_email_info', function(Blueprint $table)
		{
			$table->integer('id')->primary();
			$table->integer('email_id')->index('email_id');
			$table->string('full_name', 55);
			$table->string('firstname', 100);
			$table->string('midname', 100);
			$table->string('lastname', 100);
			$table->string('phone_number', 100);
			$table->string('tel_no', 100);
			$table->string('address', 50);
			$table->string('civilStatus', 20);
			$table->integer('age');
			$table->string('gender', 11);
			$table->date('birth');
			$table->string('system_id', 20);
			$table->string('source', 200);
			$table->dateTime('date_registered');
			$table->dateTime('date_updated')->default('0000-00-00 00:00:00');
			$table->string('status', 11);
			$table->string('position', 50);
			$table->string('company', 100);
			$table->string('school', 250);
			$table->string('password', 20);
			$table->string('username', 20);
			$table->enum('crm_sync', array('sync','unsync'))->default('unsync');
			$table->string('system_name', 100);
			$table->string('table_name', 100);
			$table->enum('contacts_status', array('SYNC','UNSYNC'));
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tbl_email_info');
	}

}
