<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProcesosinternproductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('dbalmacen')->create('pint_productos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('pintp_cpi',16);
            $table->foreign('pintp_cpi')
                    ->references('pint_cpi')->on('procesos_intern')
                    ->onDelete('cascade');

            $table->string('pintp_cod',16);
            $table->string('pintp_desc',1000)->nullable();
            $table->decimal('pintp_cant',19,2)->nullable();
            $table->decimal('pintp_cantr',19,2);
            $table->string('pintp_umedida',50)->nullable();
            $table->decimal('pintp_precio',19,6)->nullable();
            $table->decimal('pintp_costo',19,2);
            $table->string('pintp_marca',100)->nullable();
            $table->string('pintp_observacion',250)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('pint_productos');
    }
}
