<?php

namespace Logistica\Tramite;

use Illuminate\Database\Eloquent\Model;

class tramLogEntrada extends Model
{
    protected $connection = 'dbalmacen';
    protected $table = 'tramLogEntrada';
    protected $primaryKey = 'tleId';
    public $timestamps = false;
}
