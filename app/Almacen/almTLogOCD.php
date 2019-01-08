<?php

namespace Logistica\Almacen;

use Illuminate\Database\Eloquent\Model;

class almTLogOCD extends Model
{
    protected $connection = 'dblogistica';
    protected $table = 'TLogOCD';
    protected $primaryKey = 'cdtID';
    public $timestamps = false;
}
