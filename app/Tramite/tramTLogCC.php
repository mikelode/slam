<?php

namespace Logistica\Tramite;

use Illuminate\Database\Eloquent\Model;

class tramTLogCC extends Model
{
    protected $connection = 'dblogistica';
    protected $table = 'TLogCC';
    protected $primaryKey = 'cdrID';
    public $timestamps = false;
}
