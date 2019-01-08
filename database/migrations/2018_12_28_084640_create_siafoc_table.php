<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSiafocTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('dbalmacen')->create('siafOrdenCompra', function (Blueprint $table) {
            $table->increments('socId');
            $table->string('socAno_eje',10)->nullable();
            $table->string('socSec_ejec',50)->nullable();
            $table->string('socExpediente',50)->nullable();
            $table->string('socCiclo',5)->nullable();
            $table->string('socFase',5)->nullable();
            $table->string('socSecuencia',10)->nullable();
            $table->string('socCorrelativo',10)->nullable();
            $table->string('socCod_doc',10)->nullable();
            $table->string('socNum_doc',50)->nullable();
            $table->string('socFecha_doc',10)->nullable();
            $table->string('socMoneda',10)->nullable();
            $table->decimal('socMonto',18,2)->nullable();
            $table->string('socAno_proceso',10)->nullable();
            $table->string('socMes_proceso',10)->nullable();
            $table->string('socDia_proceso',10)->nullable();
            $table->string('socFecha_autorizacion',20)->nullable();
            $table->string('socEstado_envio',5)->nullable();
            $table->string('socUpdateBy',50)->nullable();
            $table->dateTime('socUpdateAt',10)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('siafOrdenCompra');
    }
}
