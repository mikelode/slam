<?php

namespace Logistica\Almacen;

use Illuminate\Database\Eloquent\Model;

class almInternamiento extends Model
{
    protected $connection = 'dbalmacen';
    protected $table = 'Internamiento';
    protected $primaryKey = 'ing_giu';
    public $timestamps = false;

    public function inventario()
    {
        return $this->hasMany('Logistica\Almacen\almInventario','cod_giu','ing_giu');
    }

    public function pecosas()
    {
        return $this->hasMany('Logistica\Almacen\almProcesoSalida','ing_giu','ing_giu');
    }

    public function ingresos()
    {
        return $this->hasMany('Logistica\Almacen\almProcesoInternamiento','cod_giu','ing_giu');
    }
}
