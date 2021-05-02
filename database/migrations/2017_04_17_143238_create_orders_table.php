<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrdersTable extends Migration
{

	public function up()
	{
		Schema::create('orders', function (Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->text('note')->nullable();
			$table->text('address');
			$table->decimal('cost')->default(0.00);
			$table->decimal('delivery_cost')->default(0.00);
			$table->decimal('shopping_cost')->default(0.00);
			$table->decimal('total')->default(0.00);
			$table->integer('client_id');
			$table->enum('state', array('pending', 'accepted', 'rejected', 'delivered')); //'delivered','notdelivered' for runner ,,,,,,'rejected','completed ' for client
		
			// $table->enum('state', array('pending', 'accepted','price_set', 'rejected','completed ', 'delivered','notdelivered')); //'delivered','notdelivered' for runner ,,,,,,'rejected','completed ' for client
			$table->string('orderable_type')->nullable();
			$table->integer('orderable_id')->nullable();
			$table->boolean('delivery_confirmed_by_runner')->default(0);
			$table->boolean('delivery_confirmed_by_client')->default(0);
			$table->string('phone');
			$table->string('home_phone')->nullable();
			$table->text('rejected_note')->nullable();

			$table->decimal('commission')->default(0.00);
			$table->decimal('net')->default(0.00);
			// $table->datetime('need_delivery_at');
			// $table->integer('delivery_time_id');
			$table->integer('merchant_id');
			// $table->datetime('delivered_at')->nullable();
			// $table->integer('payment_method_id');
			$table->string('merchant_reject_reason')->nullable();
			$table->string('client_reject_reason')->nullable();





		});
	}

	public function down()
	{
		Schema::drop('orders');
	}
}
