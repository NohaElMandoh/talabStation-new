<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTypesTable extends Migration {

	public function up()
	{
		Schema::create('types', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name_en');
			$table->string('name_ar');

			$table->string('photo')->nullable();

		});
		   
        
	}

	public function down()
	{
		Schema::drop('types');
	}
}