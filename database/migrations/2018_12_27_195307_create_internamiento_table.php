<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInternamientoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('dbalmacen')->create('Internamiento', function (Blueprint $table) {
            $table->string('ing_giu',16)->primary();
            $table->string('ing_almacen',7);
            $table->string('ing_guiaremision',500)->nullable();
            $table->string('ing_factura', 500)->nullable();
            $table->date('ing_fecha');
            $table->time('ing_hora');
            $table->string('ing_usu',50);
            $table->string('ing_obs',250)->nullable();
            $table->char('estado_validacion',1);
            $table->char('estado_salida',1)->nullable();
            $table->date('conf_fecha')->nullable();
            $table->time('conf_hora')->nullable();
            $table->string('conf_usu',50)->nullable();
            $table->boolean('flagI');
            $table->boolean('flagS');
            $table->string('nea_cod',11)->nullable();
            $table->char('tipo_internamiento',1)->nullable();
            $table->string('tipo_doc',10)->nullable();
            $table->string('oc_cod',16)->nullable();
            $table->string('oc_plazo_dias',50)->nullable();
            $table->decimal('oc_costotal',18,4);
            $table->string('oc_proveedor',500)->nullable();
            $table->string('oc_rucprovee',11)->nullable();
            $table->date('oc_fecha');
            $table->string('oc_dep_destino',1000)->nullable();
            $table->string('oc_obra_destino',1000)->nullable();
            $table->string('usu_act',50);
            $table->date('fec_act');
            $table->time('hor_act');
            $table->date('oc_fecha_limite');
            $table->string('estado_anulacion',2)->nullable();
            $table->string('oc_tipoProceso',4)->nullable();
            $table->string('oc_FteFto',4)->nullable();
            $table->string('oc_rubro',4)->nullable();
            $table->string('oc_secFuncional',14)->nullable();
            $table->string('oc_subSecFuncional',20)->nullable();
            $table->string('oc_docRef',100)->nullable();
            $table->string('oc_glosa',1000)->nullable();
            $table->string('oc_expSiaf',20)->nullable();
            $table->boolean('flagEnvio')->nullable();
            $table->date('oc_fecha_notificacion')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('Internamiento');
    }
}
