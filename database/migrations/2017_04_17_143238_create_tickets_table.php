<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTicketsTable extends Migration {

	public function up()
	{
		Schema::create('tickets', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();

			$table->integer('merchant_id');
			$table->string('content');
			$table->enum('type', array('complaint', 'suggestion', 'inquiry'));
		});
	}

	public function down()
	{
		Schema::drop('tickets');
	}
}