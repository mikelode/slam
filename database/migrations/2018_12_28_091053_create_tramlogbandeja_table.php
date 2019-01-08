<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTramlogbandejaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('dbalmacen')->create('tramLogBandeja', function (Blueprint $table) {
            $table->increments('tlbId');
            $table->string('tlbOperacion',8);
            $table->string('tlbTypeDoc',50);
            $table->string('tlbCodDoc',16);
            $table->date('tlbFechaDoc');
            $table->integer('tlbEnvioId')->unsigned();
            $table->foreign('tlbEnvioId')
                    ->references('tlsId')->on('tramLogSalida')
                    ->onDelete('cascade');

            $table->integer('tlbVerificacionId')->unsigned()->nullable();
            $table->foreign('tlbVerificacionId')
                    ->references('tlvId')->on('tramLogVerificacion')
                    ->onDelete('cascade');

            $table->integer('tlbRecepcionId')->unsigned()->nullable();
            $table->foreign('tlbRecepcionId')
                    ->references('tleId')->on('tramLogEntrada')
                    ->onDelete('cascade');

            $table->boolean('tlbFlagE');
            $table->boolean('tlbFlagCheck')->nullable();
            $table->boolean('tlbFlagR')->nullable();
            $table->string('tblUserR')->nullable();
            $table->string('tlbSituacion',1000)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tramLogBandeja');
    }
}
