<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProcesosinternTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('dbalmacen')->create('procesos_intern', function (Blueprint $table) {
            $table->string('pint_cpi')->primary();
            $table->string('cod_giu',16);
            $table->foreign('cod_giu')
                ->references('ing_giu')->on('Internamiento')
                ->onDelete('cascade');

            $table->date('pint_fecha');
            $table->time('pint_hora');
            $table->string('pint_pentrega',150);
            $table->string('pint_dni_pentrega',8);
            $table->string('pint_preceptor',150);
            $table->string('pint_dni_receptor',8);
            $table->string('pint_conductor',150)->nullable();
            $table->string('pint_dni_conductor',8)->nullable();
            $table->string('pint_placas',150)->nullable();
            $table->string('pint_observacion',250)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('procesos_intern');
    }
}
