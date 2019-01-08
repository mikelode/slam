<?php

namespace Logistica\Tramite;

use Illuminate\Database\Eloquent\Model;

class tramTLogReq extends Model
{
    protected $connection = 'dblogistica';
    protected $table = 'TLogReq';
    protected $primaryKey = 'reqID';
    public $timestamps = false;
}
