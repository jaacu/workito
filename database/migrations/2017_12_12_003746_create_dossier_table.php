<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDossierTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dossiers', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->string('nombre');
            $table->string('queEs');
            $table->string('publico');
            $table->string('mision');
            $table->string('vision');
            $table->string('valores');
            $table->string('servicios');
            $table->string('crecimiento');
            $table->string('que_se_puede_encontrar');
            $table->string('cualidades');
            $table->string('comentarios')->nullable();

            $table->integer('user_id')->unsigned(); //Creador del proyecto NO el encargado
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dossiers');
    }
}
