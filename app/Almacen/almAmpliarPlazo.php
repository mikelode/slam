<?php

namespace Logistica\Almacen;

use Illuminate\Database\Eloquent\Model;

class almAmpliarPlazo extends Model
{
    protected $connection = 'dbalmacen';
    protected $table = 'subsanarPlazo_oc';
    protected $primaryKey = 'id';
    public $timestamps = false;
}
