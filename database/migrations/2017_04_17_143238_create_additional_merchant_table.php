<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAdditionalMerchantTable extends Migration {

	public function up()
	{
		Schema::create('additional_merchant', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			
			$table->integer('client_id');
			$table->string('merchant_name');
			$table->string('merchant_address');
			$table->string('phone');
			$table->string('service_describe');
		});
	}

	public function down()
	{
		Schema::drop('additional_merchant');
	}
}