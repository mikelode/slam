<?php

namespace Logistica\Almacen;

use Illuminate\Database\Eloquent\Model;

class almTPreSF extends Model
{
    protected $connection = 'dblogistica';
    protected $table = 'TPreSF';
    protected $primaryKey = 'secID';
    public $timestamps = false;
}
