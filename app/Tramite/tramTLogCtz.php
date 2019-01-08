<?php

namespace Logistica\Tramite;

use Illuminate\Database\Eloquent\Model;

class tramTLogCtz extends Model
{
    protected $connection = 'dblogistica';
    protected $table = 'TLogCtz';
    protected $primaryKey = 'ctzID';
    public $timestamps = false;
}
