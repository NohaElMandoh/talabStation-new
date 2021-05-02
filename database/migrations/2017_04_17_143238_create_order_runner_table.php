<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrderRunnerTable extends Migration {

	public function up()
	{
		Schema::create('order_runner', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('runner_id');
			$table->integer('order_id');
			$table->string('state');
			$table->string('photo')->nullable();

		});
	}

	public function down()
	{
		Schema::drop('order_runner');
	}
}