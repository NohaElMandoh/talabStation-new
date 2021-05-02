<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClientsTable extends Migration {

	public function up()
	{
		Schema::create('clients', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name');
			$table->string('email');
			$table->string('phone');
			$table->string('home_phone')->nullable();

			$table->integer('region_id')->default(1);
			$table->text('address');
			$table->string('password')->nullable();
			$table->string('api_token',60);
			$table->string('code',6)->nullable();
			$table->string('lat')->nullable();
			$table->string('lang')->nullable();
			$table->string('photo')->nullable();

			$table->string('provider')->nullable();
			$table->string('provider_id')->nullable();
			$table->string('provider_token')->nullable();
			


			$table->tinyInteger('verified')->default(0);//verified code or not


		});
	}

	public function down()
	{
		Schema::drop('clients');
	}
}