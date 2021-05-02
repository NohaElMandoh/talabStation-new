<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGalariesTable extends Migration {

	public function up()
	{
		Schema::create('galaries', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name')->nullable();
			$table->string('position');
			$table->string('photo');
			$table->integer('display')->default(0);

		});
	}

	public function down()
	{
		Schema::drop('galaries');
	}
}