<?php

namespace Logistica\Almacen;

use Illuminate\Database\Eloquent\Model;

class almProcesoInternamiento extends Model
{
    protected $connection = 'dbalmacen';
    protected $table = 'procesos_intern';
    protected $primaryKey = 'pint_cpi';
    public $timestamps = false;

    public function productos_ingresados()
    {
        return $this->hasMany('Logistica\Almacen\almProcesoInternamientoB','pintp_cpi','pint_cpi');
    }
}
