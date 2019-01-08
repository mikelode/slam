<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNeainternamientoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('dbalmacen')->create('neaInternamiento', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ing_nea',16);
            $table->foreign('ing_nea')
                ->references('ing_giu')->on('Internamiento')
                ->onDelete('cascade');

            $table->string('nea_dniRecepcionista',8);
            $table->string('nea_recepcionista',250);
            $table->string('nea_dniDador',8);
            $table->string('nea_dador',250);
            $table->string('nea_sfDador',1000)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('neaInternamiento');
    }
}
