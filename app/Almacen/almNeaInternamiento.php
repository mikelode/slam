<?php

namespace Logistica\Almacen;

use Illuminate\Database\Eloquent\Model;

class almNeaInternamiento extends Model
{
    protected $connection = 'dbalmacen';
    protected $table = 'neaInternamiento';
    protected $primaryKey = 'id';
    public $timestamps = false;
}
