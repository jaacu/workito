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
            $table->uuid('id')->primary();//Lo genera laravel solo
            $table->string('type');//Que clase de notificacion es
            $table->morphs('notifiable');//Va a tener una relacion con un objeto notificable
            $table->text('data');//Un json con los datos necesarios para la notificacion
            $table->timestamp('read_at')->nullable();//Que notificacion ya fue leida y cual no
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
        Schema::dropIfExists('notifications');
    }
}
