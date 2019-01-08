<?php

namespace Logistica\Almacen;

use Illuminate\Database\Eloquent\Model;

class almRecyclePecosa extends Model
{
    protected $connection = 'dbalmacen';
    protected $table = 'recycle_pecosa';
    protected $primaryKey = 'pcsCodigo';
    public $timestamps = false;
}
