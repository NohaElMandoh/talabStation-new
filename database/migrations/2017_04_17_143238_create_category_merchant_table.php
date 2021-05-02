<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCategoryMerchantTable extends Migration {

	public function up()
	{
		Schema::create('category_merchant', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('category_id');
			$table->integer('merchant_id');
		});
	}

	public function down()
	{
		Schema::drop('category_merchant');
	}
}