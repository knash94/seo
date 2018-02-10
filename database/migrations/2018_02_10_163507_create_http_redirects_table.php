<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHttpRedirectsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('http_redirects', function(Blueprint $table)
		{
			$table->increments('id');

			$table->integer('http_error_id')->unsigned()->nullable();

			$table->string('path');

			$table->string('redirect_url');

			$table->timestamps();

			$table->foreign('http_error_id')->references('id')->on('http_errors')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('http_redirects');
	}

}
