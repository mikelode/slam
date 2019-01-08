<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlmacenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('dbalmacen')->create('Almacen', function (Blueprint $table) {
            $table->string('id',5)->primary();
            $table->string('nombre',50);
            $table->string('descripcion',250)->nullable();
            $table->string('direccion',50);
            $table->string('ubicacion',50)->nullable();
            $table->string('capacidad',50)->nullable();
            $table->string('jefe_profesion',10)->nullable();
            $table->string('jefe_nombres',100)->nullable();
            $table->string('jefe_apaterno',100)->nullable();
            $table->string('jefe_amaterno',100)->nullable();
            $table->string('jefe_dni',8)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('Almacen');
    }
}
