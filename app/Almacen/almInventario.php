<?php

namespace Logistica\Almacen;

use Illuminate\Database\Eloquent\Model;

class almInventario extends Model
{
    protected $connection = 'dbalmacen';
    protected $table = 'Inventario';
    protected $primaryKey = 'id';
    public $timestamps = false;
}
