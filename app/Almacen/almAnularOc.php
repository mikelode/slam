<?php

namespace Logistica\Almacen;

use Illuminate\Database\Eloquent\Model;

class almAnularOc extends Model
{
    protected $connection = 'dbalmacen';
    protected $table = 'anulacion_oc';
    protected $primaryKey = 'id';
    public $timestamps = false;
}
