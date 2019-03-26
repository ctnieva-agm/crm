<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblLeadsListTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_leads_list', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('sales_id');
			$table->string('client_name', 100);
			$table->string('company_name', 100);
			$table->string('source', 100);
			$table->dateTime('entry_date');
			$table->integer('product_id');
			$table->text('add_ons', 65535);
			$table->string('deal_amount', 100);
			$table->enum('stage', array('initial_contact','qualifying_lead','proposal','negotiating','won','delivery','lost'))->default('initial_contact');
			$table->dateTime('expected_close_date');
			$table->dateTime('actual_close_date');
			$table->string('closed_amount', 100);
			$table->string('customer_type', 100);
			$table->text('potential_competitor', 65535);
			$table->text('lose_notes', 65535);
			$table->text('extra_notes', 65535);
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
		Schema::drop('tbl_leads_list');
	}

}
