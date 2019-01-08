<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecycleinternTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('dbalmacen')->create('recycle_internamiento', function (Blueprint $table) {
            $table->string('giCodigo',16);
            $table->string('giAlmacen',7)->nullable();
            $table->string('giGuiaRemision',500)->nullable();
            $table->string('giFactura', 500)->nullable();
            $table->string('giUsuInternamiento',50)->nullable();
            $table->date('giFechaInternamiento')->nullable();
            $table->string('giNea',11)->nullable();
            $table->char('giTipoInternamiento',1)->nullable();
            $table->string('giTipoDoc',10)->nullable();
            $table->string('giOrdenCompra',16)->nullable();
            $table->string('giProcesoCodigo',16)->nullable();
            $table->date('giProcesoFecha')->nullable();
            $table->string('giProcesoNameEntrega',150)->nullable();
            $table->string('giProcesoDniEntrega',8)->nullable();
            $table->string('giProcesoNameReceptor',150)->nullable();
            $table->string('giProcesoDniReceptor',150)->nullable();
            $table->string('giProcesoObservacion',250)->nullable();
            $table->string('giProcesoProdCod',16)->nullable();
            $table->string('giProcesoProdDsc',1000)->nullable();
            $table->decimal('giProcesoProdCantr',19,2)->nullable();
            $table->string('giProcesoProdMedida',50)->nullable();
            $table->decimal('giProcesoProdPrecio',19,2)->nullable();
            $table->decimal('giProcesoProdCosto',19,2)->nullable();
            $table->string('giProcesoProdMarca',50)->nullable();
            $table->dateTime('giRemoveAt')->nullable();
            $table->string('giRemoveBy')->nullable();
            $table->string('giRemoveFor',1000)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('recycle_internamiento');
    }
}
