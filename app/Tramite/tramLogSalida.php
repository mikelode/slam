<?php

namespace Logistica\Tramite;

use Illuminate\Database\Eloquent\Model;

class tramLogSalida extends Model
{
    protected $connection = 'dbalmacen';
    protected $table = 'tramLogSalida';
    protected $primaryKey = 'tlsId';
    public $timestamps = false;
}
