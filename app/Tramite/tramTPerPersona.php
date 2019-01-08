<?php

namespace Logistica\Tramite;

use Illuminate\Database\Eloquent\Model;

class tramTPerPersona extends Model
{
    protected $connection = 'dblogistica';
    protected $table = 'TPerPrs';
    protected $primaryKey = 'perID';
    public $timestamps = false;
}
