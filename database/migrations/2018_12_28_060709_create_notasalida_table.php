<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotasalidaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('dbalmacen')->create('NotaSalida', function (Blueprint $table) {
            $table->string('nsal_cod')->primary();
            $table->string('nsal_pecosa',16)->nullable();
            $table->foreign('psal_pecosa')
                    ->references('psal_pecosa')->on('procesos_salida')
                    ->onDelete('cascade');

            $table->date('nsal_fecha')->nullable();
            $table->time('nsal_hora')->nullable();
            $table->string('nsal_usu',50)->nullable();
            $table->string('nsal_destino',50)->nullable();
            $table->string('nsal_duracion_llegada',50)->nullable();
            $table->string('nsal_solicitante',50)->nullable();
            $table->string('nsal_responsable_traslado',50)->nullable();
            $table->string('nsal_tipo_transporte',50)->nullable();
            $table->string('nsal_placa_transporte',50)->nullable();
            $table->string('nsal_conductor',50);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('NotaSalida');
    }
}
