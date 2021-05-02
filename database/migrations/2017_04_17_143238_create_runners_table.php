<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRunnersTable extends Migration {

	public function up()
	{
		Schema::create('runners', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name');
			$table->string('email');
			$table->string('phone');
			$table->integer('region_id');
			$table->text('address');
			$table->string('password');
			$table->string('api_token',60);
			$table->string('code',6)->nullable();
			$table->string('lat')->nullable();
			$table->string('lang')->nullable();
			$table->string('photo')->nullable();
			$table->enum('state', array('free', 'busy'))->default('free');

			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('runners');
	}
}