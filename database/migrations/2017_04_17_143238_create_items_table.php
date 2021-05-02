<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateItemsTable extends Migration {

	public function up()
	{
		Schema::create('items', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();

			$table->string('name');
			$table->text('description');
			$table->decimal('price');
			$table->decimal('discount')->nullable();
			$table->string('photo')->nullable();
			$table->integer('merchant_id');
			$table->integer('category_id')->nullable();
			$table->integer('unit_id')->nullable();
			$table->boolean('disabled')->default(0);
		});
	}

	public function down()
	{
		Schema::drop('items');
	}
}