<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTramlogentradaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('dbalmacen')->create('tramLogEntrada', function (Blueprint $table) {
            $table->increments('tleId');
            $table->string('tleDni',8);
            $table->string('tleNombre',150);
            $table->string('tleAPaterno',150);
            $table->string('tleAMaterno',150);
            $table->dateTime('tleFecha');
            $table->string('tleRegisterBy',150);
            $table->dateTime('tleRegisterAt');
            $table->string('tleDestinoPlace',250);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tramLogEntrada');
    }
}
