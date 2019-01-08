<?php

namespace Logistica\Tramite;

use Illuminate\Database\Eloquent\Model;

class tramTLogOS extends Model
{
    protected $connection = 'dblogistica';
    protected $table = 'TLogOS';
    protected $primaryKey = 'orsID';
    public $timestamps = false;
}
