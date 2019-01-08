<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCodcontadorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('dbalmacen')->create('cod_contador', function (Blueprint $table) {
            $table->increments('id');
            $table->string('last_giu',16);
            $table->string('last_pecosa',16);
            $table->string('last_cpi',16);
            $table->string('last_cps',16);
            $table->string('last_nea',16)->nullable();
            $table->string('anio',4)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('cod_contador');
    }
}
