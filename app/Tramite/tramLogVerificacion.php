<?php

namespace Logistica\Tramite;

use Illuminate\Database\Eloquent\Model;

class tramLogVerificacion extends Model
{
    protected $connection = 'dbalmacen';
    protected $table = 'tramLogVerificacion';
    protected $primaryKey = 'tlvId';
    public $timestamps = false;
}
