<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsSettingsTable extends Migration
{
    public function up()
    {
        Schema::create('clients_settings', function(Blueprint $table) {
            $table->increments('id');
			$table->integer('client_id');

            $table->tinyInteger('notifications')->default(1);
       
        });
    }

    public function down()
    {
        Schema::drop('clients_settings');
    }
}
