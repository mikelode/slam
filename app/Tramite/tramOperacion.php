<?php

namespace Logistica\Tramite;

use Illuminate\Database\Eloquent\Model;

class tramOperacion extends Model
{
    protected $connection = 'dbalmacen';
    protected $table = 'tramOperacion';
    protected $primaryKey = 'topId';
    public $timestamps = false;

    public function documentos()
    {
        return $this->hasMany('Logistica\Tramite\tramLogBandeja','tlbOperacion','topId');
    }

    public function remitente()
    {
        return $this->hasOne('Logistica\Tramite\tramLogSalida','tlsId','topEnvioId');
    }

    public function receptor()
    {
        return $this->hasOne('Logistica\Tramite\tramLogEntrada','tleId','topRecepcionId');
    }

}
