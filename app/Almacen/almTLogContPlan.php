<?php

namespace Logistica\Almacen;

use Illuminate\Database\Eloquent\Model;

class almTLogContPlan extends Model
{
    protected $connection = 'dblogistica';
    protected $table = 'TLogContPlan';
    protected $primaryKey = ['pcgAnio','pcgSubcta'];
    public $incrementing = false;
    public $timestamps = false;
}
