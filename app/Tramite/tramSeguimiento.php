<?php

namespace Logistica\Tramite;

use Illuminate\Database\Eloquent\Model;

class tramSeguimiento extends Model
{
    protected $connection = 'dbalmacen';
    protected $table = 'tramSeguimiento';
    public $timestamps = false;
}
