<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateItemOfferTable extends Migration {

	public function up()
	{
		Schema::create('item_offer', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('item_id');
			$table->integer('offer_id');
			$table->decimal('price');

		});
	}

	public function down()
	{
		Schema::drop('item_offer');
	}
}