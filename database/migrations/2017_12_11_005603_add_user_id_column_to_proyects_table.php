<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserIdColumnToProyectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('proyects', function (Blueprint $table) {
            // $table->integer('user_id')->unsigned(); //Encargado del proyecto
            // $table->foreign('user_id')->references('id')->on('users');

         $table->integer('proyect_id')->unsigned();// El id del proyecto 
         $table->integer('proyect_type')->unsigned();// Que tipo de proyecto es
         /* 0 Dossier
         *  1 adminSocialNetwork
         */

         //El user_id de los tipos de proyectos es el creador
     });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('proyects', function (Blueprint $table) {
            $table->dropForeign('proyects_user_id_foreign');
            $table->dropColumn('user_id');
            $table->dropColumn('proyect_id');
            $table->dropColumn('proyect_type');
        });
    }
}
