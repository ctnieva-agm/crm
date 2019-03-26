<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblVipNumbersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_vip_numbers', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('type')->comment('0-Promaker (Personal);1-Promaker (Corporate);2-Unlibooks;3-Promaker(Student)');
			$table->enum('system', array('UMD','USV','UNP','CFC','UED','SURECPA','PTW','NAS','PAYROLL','PROMAKER','SURECPA(Student)','UDT'));
			$table->string('vip_number', 19);
			$table->enum('subtype', array('primary','secondary'));
			$table->enum('subsystem', array('UMD','USV','UNP','UED','CFC','UDT'));
			$table->string('vip_type', 55);
			$table->string('discount', 3);
			$table->enum('terms', array('cash','credit_card','partial'))->default('credit_card');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tbl_vip_numbers');
	}

}
