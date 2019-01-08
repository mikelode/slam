<?php

namespace Logistica\Almacen;

use Illuminate\Database\Eloquent\Model;

class almTLogOC extends Model
{
    protected $connection = 'dblogistica';
    protected $table = 'TLogOC';
    protected $primaryKey = 'orcID';
    public $timestamps = false;
}
