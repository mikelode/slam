<?php

namespace Logistica\Almacen;

use Illuminate\Database\Eloquent\Model;

class almTPreCta extends Model
{
    protected $connection = 'dblogistica';
    protected $table = 'TPreCta';
    protected $primaryKey = ['ctaTipo','ctaCgp'];
    public $incrementing = false;
    public $timestamps = false;
}
