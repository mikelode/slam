<?php

namespace Logistica\Almacen;

use Illuminate\Database\Eloquent\Model;

class almProcesoInternamientoB extends Model
{
    protected $connection = 'dbalmacen';
    protected $table = 'pint_productos';
    protected $primaryKey = 'id';
    public $timestamps = false;
}
