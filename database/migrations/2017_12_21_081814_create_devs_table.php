<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDevsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('devs', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->integer('user_id')->unsigned(); //El id del desarrollador
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');;

            $table->integer('proyect_id')->unsigned(); //El id proyecto
            $table->foreign('proyect_id')->references('id')->on('proyects')->onDelete('cascade');;            

            $table->integer('diasTrabajado')->default(0);
            $table->integer('horasTrabajado')->default(0);
            $table->integer('minutosTrabajado')->default(0);
            $table->integer('segundosTrabajado')->default(0);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('devs');
    }
}
