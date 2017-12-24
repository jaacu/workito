<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdministracionRedesSocialesTable1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_social_networks', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            
            $table->string('nombre');
            
            $table->boolean('facebook');
            $table->string('fbPermisosCompra')->nullable();

            $table->boolean('twitter');
            $table->string('twEmail')->nullable();
            $table->string('twPassword')->nullable();

            $table->boolean('instagram');
            $table->string('instEmail')->nullable();
            $table->string('instPassword')->nullable();            

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
        Schema::dropIfExists('admin_social_networks');
    }
}
