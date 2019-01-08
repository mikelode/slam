<?php

namespace Logistica\Almacen;

use Illuminate\Database\Eloquent\Model;

class almProcesoSalidaB extends Model
{
    protected $connection = 'dbalmacen';
    protected $table = 'psal_productos';
    protected $primaryKey = 'id';
    public $timestamps = false;
}
