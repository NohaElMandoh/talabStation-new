<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateItemOrderTable extends Migration {

	public function up()
	{
		Schema::create('item_order', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			// $table->integer('item_id');
			$table->morphs('item'); //notifiable  App\item | App\offer
			$table->integer('order_id');
			$table->decimal('price');
			$table->integer('quantity');
			$table->string('note')->nullable();
			$table->string('merchant_state')->default('pending');//pending  rejected accepted deliverd-to-runner

		});
	}

	public function down()
	{
		Schema::drop('item_order');
	}
}