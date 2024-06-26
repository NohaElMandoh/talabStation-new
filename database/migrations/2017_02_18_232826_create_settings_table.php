<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    public function up()
    {
        Schema::create('settings', function(Blueprint $table) {
            $table->increments('id');
            $table->string('facebook');
            $table->string('twitter');
            $table->string('instagram');
            // $table->float('commission');
            $table->float('delivery_cost');
            $table->float('shopping_cost');

            $table->longText('about_app');
            $table->longText('terms');
        });

        
        App\Models\Settings::create([
            'facebook' => 'facebook',
            'twitter' => 'twitter',
            'instagram' => 'instagram',
            'delivery_cost' => 10,
            'shopping_cost' => 10,
            'about_app' => 'about',
            'terms' => 'terms',
        ]);
    }

    public function down()
    {
        Schema::drop('settings');
    }
}
