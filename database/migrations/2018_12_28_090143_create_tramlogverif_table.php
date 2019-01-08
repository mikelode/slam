<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTramlogverifTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('dbalmacen')->create('tramLogVerificacion', function (Blueprint $table) {
            $table->increments('tlvId');
            $table->string('tlvDni',8);
            $table->string('tlvNombre',150);
            $table->string('tlvAPaterno',150);
            $table->string('tlvAMaterno',150);
            $table->dateTime('tlvFecha');
            $table->string('tlvRegisterBy',150);
            $table->string('tlvRegisterAt',150);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tramLogVerificacion');
    }
}
