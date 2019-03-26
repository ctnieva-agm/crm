<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblPofEmailInfoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_pof_email_info', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('pof_email_id')->index('pof_email_id');
			$table->string('member_num', 55);
			$table->string('name');
			$table->string('cpa_num', 55);
			$table->timestamp('date_reg')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->string('address');
			$table->string('city');
			$table->string('landline', 55);
			$table->string('mobile', 55);
			$table->string('company');
			$table->string('position', 55);
			$table->string('source', 100);
			$table->enum('status', array('active','trashed'));
			$table->enum('membership_type', array('online','professional','certified'));
			$table->string('temporary_id', 100);
			$table->string('vip_code', 100);
			$table->enum('email_status', array('confirmed','unconfirmed'));
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tbl_pof_email_info');
	}

}
