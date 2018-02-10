<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHttpErrorsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('http_errors', function(Blueprint $table)
		{
			$table->increments('id');

			$table->string('path');

			$table->integer('hits')->default(0);

			$table->timestamp('last_hit');

			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('http_errors');
	}

}
