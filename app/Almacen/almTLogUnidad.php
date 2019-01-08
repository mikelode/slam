<?php

namespace Logistica\Almacen;

use Illuminate\Database\Eloquent\Model;

class almTLogUnidad extends Model
{
    protected $connection = 'dblogistica';
    protected $table = 'TLogUnd';
    protected $primaryKey = 'undID';
    public $timestamps = false;
}
