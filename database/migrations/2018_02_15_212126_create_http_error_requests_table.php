<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHttpErrorRequestsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('http_error_requests', function(Blueprint $table)
		{
			$table->increments('id');

			$table->integer('http_error_id')->unsigned();

			$table->string('user_agent');

			$table->string('ip_address');

			$table->string('previous_url')->nullable();

			$table->timestamps();

			$table->foreign('http_error_id')
                ->references('id')
                ->on('http_errors')
                ->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('http_error_requests');
	}

}
