<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOffersTitlesTable extends Migration
{

	public function up()
	{
		Schema::create('offers_titles', function (Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name');
			$table->text('description');
			$table->string('photo')->nullable();
			$table->integer('type_id');


		});
	}

	public function down()
	{
		Schema::drop('offers_titles');
	}
}
