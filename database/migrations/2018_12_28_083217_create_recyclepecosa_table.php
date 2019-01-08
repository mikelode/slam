<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecyclepecosaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('dbalmacen')->create('recycle_pecosa', function (Blueprint $table) {
            $table->string('pcsCodigo',16);
            $table->string('pcsGiu',16)->nullable();
            $table->date('pcsFecha')->nullable();
            $table->string('pcsDniSolicitante',8)->nullable();
            $table->string('pcsNameSolicitante',50)->nullable();
            $table->string('pcsDepSolicitante',50)->nullable();
            $table->string('pcsDespachador',200)->nullable();
            $table->string('pcsDestino',1000)->nullable();
            $table->string('pcsProdCod',16)->nullable();
            $table->string('pcsProdDsc',1000)->nullable();
            $table->decimal('pcsProdCant',19,2)->nullable();
            $table->decimal('pcsProdCantAtend',19,2)->nullable();
            $table->decimal('pcsProdPrecio',19,2)->nullable();
            $table->string('pcsProdMedida',50)->nullable();
            $table->decimal('pcsProdCosto',19,2)->nullable();
            $table->string('pcsProdMarca',50)->nullable();
            $table->dateTime('pcsRemoveAt')->nullable();
            $table->string('pcsRemoveBy',50)->nullable();
            $table->string('pcsRemoveFor',1000)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('recycle_pecosa');
    }
}
