<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('dbalmacen')->create('Inventario', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cod_giu',16)->nullable();
            $table->foreign('cod_giu')->references('ing_giu')->on('Internamiento')
                ->onDelete('cascade');

            $table->string('prod_oc',11)->nullable();
            $table->string('prod_cod',16);
            $table->string('prod_desc',1000)->nullable();
            $table->string('prod_marca',100)->nullable();
            $table->decimal('prod_cant',19,2);
            $table->string('prod_medida',20);
            $table->decimal('prod_precio',19,6)->nullable();
            $table->decimal('prod_costo',19,4);
            $table->string('prod_ingobs',250)->nullable();
            $table->decimal('prod_recep',19,2);
            $table->string('conf_prod',1)->nullable();
            $table->boolean('flagR');
            $table->decimal('prod_distribuido',19,2)->nullable();
            $table->decimal('prod_stock',19,2)->nullable();
            $table->boolean('flagD')->nullable();
            $table->string('prod_salobs',250)->nullable();
            $table->string('prod_clasif',15)->nullable();
            $table->date('fecha_act');
            $table->time('hora_act');
            $table->string('user_act',50);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('Inventario');
    }
}
