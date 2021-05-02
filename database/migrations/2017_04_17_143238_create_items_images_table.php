<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateItemsImagesTable extends Migration {

	public function up()
	{
		Schema::create('items_images', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();

			$table->string('photo')->nullable();
			$table->integer('item_id');
		
		});
	}

	public function down()
	{
		Schema::drop('items_images');
	}
}