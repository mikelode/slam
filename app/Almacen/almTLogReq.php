<?php

namespace Logistica\Almacen;

use Illuminate\Database\Eloquent\Model;

class almTLogReq extends Model
{
    protected $connection = 'dblogistica';
    protected $table = 'TLogReq';
    protected $primaryKey = 'reqID';
    public $timestamps = false;
}
