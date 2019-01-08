<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTramlogsalidaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('dbalmacen')->create('tramLogSalida', function (Blueprint $table) {
            $table->increments('tlsId');
            $table->string('tlsDni',8);
            $table->string('tlsNombre',150);
            $table->string('tlsAPaterno',150);
            $table->string('tlsAMaterno',150);
            $table->dateTime('tlsFecha');
            $table->string('tlsRegisterBy',150);
            $table->dateTime('tlsRegisterAt');
            $table->string('tlsOrigenPlace',250);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tramLogSalida');
    }
}
