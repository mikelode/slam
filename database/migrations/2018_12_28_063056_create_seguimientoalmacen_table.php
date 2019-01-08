<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeguimientoalmacenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('dbalmacen')->create('seguimiento_almacen', function (Blueprint $table) {
            $table->increments('id');
            $table->string('seg_giu',16)->nullable();
            $table->string('seg_operacion',50);
            $table->string('seg_usuario',50);
            $table->dateTime('seg_fecha');
            $table->time('seg_hora');
            $table->text('seg_descripcion');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('seguimiento_almacen');
    }
}
