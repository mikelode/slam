<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubsanarplazoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('dbalmacen')->create('subsanarPlazo_oc', function (Blueprint $table) {
            $table->increments('id');
            $table->string('subs_oc_cod',11);
            $table->date('subs_nueva_flimite');
            $table->string('subs_descripcion',250);
            $table->date('subs_fecha');
            $table->time('subs_hora');
            $table->string('subs_usu',50);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('subsanarPlazo_oc');
    }
}
