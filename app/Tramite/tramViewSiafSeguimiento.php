<?php

namespace Logistica\Tramite;

use Illuminate\Database\Eloquent\Model;

class tramViewSiafSeguimiento extends Model
{
    protected $connection = 'dbalmacen';
    protected $table = 'vSiafSeguimiento';
    public $timestamps = false;
}
