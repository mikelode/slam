<?php

namespace Logistica\Almacen;

use Illuminate\Database\Eloquent\Model;

class almRecycleInternamiento extends Model
{
    protected $connection = 'dbalmacen';
    protected $table = 'recycle_internamiento';
    protected $primaryKey = 'giCodigo';
    public $timestamps = false;
}
