<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMerchantsTable extends Migration {

	public function up()
	{
		Schema::create('merchants', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			
			$table->integer('region_id');
			$table->integer('type_id');
			$table->string('name');
			$table->string('email');
			$table->string('password');
			$table->string('phone');
			$table->string('lat')->nullable();
			$table->string('lang')->nullable();
			$table->string('personal_photo')->nullable();
			$table->string('national_id_photo')->nullable();
			$table->string('whatsapp')->nullable();
			$table->string('address')->nullable();

			$table->string('photo')->nullable();
			$table->enum('availability', array('open', 'closed'));
			$table->string('api_token',60);
            $table->string('code',6)->nullable();
			$table->boolean('activated')->default(1);
			$table->boolean('selected')->default(0);

			$table->rememberToken();
			// $table->integer('delivery_method_id');
			// $table->text('delivery_days');
			// $table->decimal('delivery_cost');
			// $table->decimal('minimum_charger');
		 
		});

	
	}

	public function down()
	{
		Schema::drop('merchants');
	}
}