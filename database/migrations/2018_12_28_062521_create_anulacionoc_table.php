<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnulacionocTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('dbalmacen')->create('anulacion_oc', function (Blueprint $table) {
            $table->increments('id');
            $table->string('anul_oc_cod',11);
            $table->string('anul_motivo',250);
            $table->dateTime('anul_fecha')->nullable();
            $table->time('anul_hora')->nullable();
            $table->string('anul_usu',50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('anulacion_oc');
    }
}
