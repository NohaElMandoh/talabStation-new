<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRegionsTable extends Migration {

	public function up()
	{
		Schema::create('regions', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name_ar');
			$table->string('name_en');
			
			$table->integer('city_id');
			$table->float('delivery_cost');

		});
	
	}

	public function down()
	{
		Schema::drop('regions');
	}
}