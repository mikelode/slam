<?php

namespace Logistica\Almacen;

use Illuminate\Database\Eloquent\Model;

class almAlmacen extends Model
{
    protected $connection = 'dbalmacen';
    protected $table = 'Almacen';
    protected $primaryKey = 'id';
    public $timestamps = false;
}