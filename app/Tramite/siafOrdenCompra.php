<?php

namespace Logistica\Tramite;

use Illuminate\Database\Eloquent\Model;

class siafOrdenCompra extends Model
{
    protected $connection = 'dbalmacen';
    protected $table = 'siafOrdenCompra';
    protected $primaryKey = 'socId';
    public $timestamps = false;
}
