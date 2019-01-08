<?php

namespace Logistica\Tramite;

use Illuminate\Database\Eloquent\Model;

class tramLogBandeja extends Model
{
    protected $connection = 'dbalmacen';
    protected $table = 'tramLogBandeja';
    protected $primaryKey = 'tlbId';
    public $timestamps = false;

    public function remitente()
    {
        return $this->hasOne('Logistica\Tramite\tramLogSalida','tlsId','tlbEnvioId');
    }

    public function receptor()
    {
        return $this->hasOne('Logistica\Tramite\tramLogEntrada','tleId','tlbRecepcionId');
    }

    public function verificador()
    {
        return $this->hasOne('Logistica\Tramite\tramLogVerificacion','tlvId','tlbVerificacionId');
    }
}
