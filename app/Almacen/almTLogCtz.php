<?php

namespace Logistica\Almacen;

use Illuminate\Database\Eloquent\Model;

class almTLogCtz extends Model
{
    protected $connection = 'dblogistica';
    protected $table = 'TLogCtz';
    protected $primaryKey = 'ctzID';
    public $timestamps = false;
}
