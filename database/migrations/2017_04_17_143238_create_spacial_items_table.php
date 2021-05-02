<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSpacialItemsTable extends Migration {

	public function up()
	{
		Schema::create('spacial_items', function(Blueprint $table) {
			
			$table->increments('id');
			$table->timestamps();
			$table->string('name');
			$table->integer('quantity');
			$table->text('note')->nullable();
			$table->decimal('price')->default(0.00);
			$table->integer('client_id');
			$table->integer('merchant_id');


		});
	}

	public function down()
	{
		Schema::drop('spacial_items');
	}
}