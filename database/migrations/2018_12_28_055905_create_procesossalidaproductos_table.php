<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProcesossalidaproductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('dbalmacen')->create('psal_productos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('psalp_pecosa',16);
            $table->foreign('psalp_pecosa')
                    ->references('psal_pecosa')->on('procesos_salida')
                    ->onDelete('cascade');

            $table->string('psalp_cod',16);
            $table->string('psalp_desc',1000)->nullable();
            $table->decimal('psalp_cant',19,2)->nullable();
            $table->decimal('psalp_cant_atend',19,2);
            $table->string('psalp_umedida',50)->nullable();
            $table->decimal('psalp_precio',19,6)->nullable();
            $table->decimal('psalp_costo',19,2);
            $table->string('psalp_marca',100)->nullable();
            $table->string('psalp_observacion',1000)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('psal_productos');
    }
}
