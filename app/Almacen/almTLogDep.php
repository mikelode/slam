<?php

namespace Logistica\Almacen;

use Illuminate\Database\Eloquent\Model;

class almTLogDep extends Model
{
    protected $connection = 'dblogistica';
    protected $table = 'TLogDep';
    protected $primaryKey = 'depID';
    public $timestamps = false;
}
