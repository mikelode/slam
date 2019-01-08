<?php

namespace Logistica\Almacen;

use Illuminate\Database\Eloquent\Model;

class almSeguimiento extends Model
{
    protected $connection = 'dbalmacen';
    protected $table = 'seguimiento_almacen';
    protected $primaryKey = 'id';
    public $timestamps = false;
}
