<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblLeadsRemarkTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_leads_remark', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('leads_id');
			$table->string('title', 100);
			$table->text('description', 65535);
			$table->enum('status', array('To be done','Doing','Done'))->default('To be done');
			$table->dateTime('to_be_done');
			$table->dateTime('doing');
			$table->dateTime('done');
			$table->enum('trash', array('no','yes'))->default('no');
			$table->dateTime('trash_date');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tbl_leads_remark');
	}

}
