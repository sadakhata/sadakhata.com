<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCacheTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('cache_table', function($table)
		{
			$table->increments("id");
			$table->string('userid', 100);
			$table->longText('basic');
			$table->longText('dhusor');
			$table->longText('shobdopata');
			$table->longText('shuvro');
			$table->longText('status');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
		Schema::drop('cache_table');
	}

}
