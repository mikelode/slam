<?php

namespace Logistica\Almacen;

use Illuminate\Database\Eloquent\Model;

class almProcesoSalida extends Model
{
    protected $connection = 'dbalmacen';
    protected $table = 'procesos_salida';
    protected $primaryKey = 'psal_pecosa';
    public $timestamps = false;

    public function productos_distribuidos()
    {
        return $this->hasMany('Logistica\Almacen\almProcesoSalidaB','psalp_pecosa','psal_pecosa');
    }
}
