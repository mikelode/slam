<?php

namespace Logistica\Almacen;

use Illuminate\Database\Eloquent\Model;

class almTPerPrs extends Model
{
    protected $connection = 'dblogistica';
    protected $table = 'TPerPrs';
    protected $primaryKey = 'perID';
    public $timestamps = false;
}