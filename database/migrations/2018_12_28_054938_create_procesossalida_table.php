<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProcesossalidaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('dbalmacen')->create('procesos_salida', function (Blueprint $table) {
            $table->string('psal_pecosa',16)->primary();
            $table->string('ing_giu',16);
            $table->foreign('ing_giu')
                    ->references('ing_giu')->on('Internamiento')
                    ->onDelete('cascade');

            $table->date('psal_fecha');
            $table->string('psal_dni_solicitante',8);
            $table->string('psal_solicitante',50);
            $table->string('psal_dependencia_solic',50);
            $table->string('psal_solic_cargo',100)->nullable();
            $table->string('psal_usu_despachador',200);
            $table->string('psal_destino',1000)->nullable();
            $table->string('seguimiento',500)->nullable();
            $table->string('psal_observacion',1000)->nullable();
            $table->string('usu_act',20);
            $table->dateTime('fec_act');
            $table->time('hor_act');
            $table->string('psal_receptor',100)->nullable();
            $table->string('psal_guiarem',100)->nullable();
            $table->string('psal_factura',100)->nullable();
            $table->string('psal_receptordni',8)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('procesos_salida');
    }
}
