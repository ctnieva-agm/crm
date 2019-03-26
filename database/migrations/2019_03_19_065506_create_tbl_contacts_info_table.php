<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblContactsInfoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_contacts_info', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('user_id')->index('user_id');
			$table->date('birthday');
			$table->enum('gender', array('male','female','none'))->nullable();
			$table->string('nationality', 55);
			$table->string('address', 55);
			$table->string('company_name', 55);
			$table->string('company_address', 55);
			$table->string('position', 55);
			$table->text('notes', 65535);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tbl_contacts_info');
	}

}
