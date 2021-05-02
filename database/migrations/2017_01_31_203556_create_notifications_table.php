<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('title_en');
            $table->text('content')->nullable();
            $table->text('content_en')->nullable();
            $table->integer('user_id');
            $table->integer('order_id');
            $table->string('type');// add_comment | upload files | change phase
            $table->morphs('notifiable'); //notifiable  App\User | App\Client
            $table->string('order_url');
            $table->timestamp('read_at')->nullable();
            $table->string('photo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('notifications');
    }
}
