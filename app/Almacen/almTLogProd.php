<?php

namespace Logistica\Almacen;

use Illuminate\Database\Eloquent\Model;

class almTLogProd extends Model
{
    protected $connection = 'dblogistica';
    protected $table = 'TLogProd';
    protected $primaryKey = 'proID';
    public $timestamps = false;
}
