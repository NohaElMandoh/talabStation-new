<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRunnersReviewsTable extends Migration {

	public function up()
	{
		Schema::create('runners_reviews', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->text('note')->nullable();
			$table->enum('rate', array('1', '2', '3', '4', '5'));
			$table->integer('runner_id');
			$table->integer('client_id');
			$table->integer('order_id');
		});
	}

	public function down()
	{
		Schema::drop('runners_reviews');
	}
}