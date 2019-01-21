<?php

namespace Logistica\Almacen;

use Illuminate\Database\Eloquent\Model;

class logTbNotif extends Model
{
    protected $connection = 'dblogistica';
    protected $table = 'TLogNotif';
    protected $primaryKey = 'mdnID';
    public $timestamps = false;
}
