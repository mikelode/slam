<?php

namespace Logistica\Almacen;

use Illuminate\Database\Eloquent\Model;

class almTPrePto extends Model
{
    protected $connection = 'dblogistica';
    protected $table = 'TPrePto';
    protected $primaryKey = 'ptoID';
    public $timestamps = false;
}
