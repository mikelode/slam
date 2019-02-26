<?php

namespace Logistica\Tramite;

use Illuminate\Database\Eloquent\Model;

class tramLogBandeja extends Model
{
    protected $connection = 'dbalmacen';
    protected $table = 'tramLogBandeja';
    protected $primaryKey = 'tlbId';
    public $timestamps = false;

    public function verificador()
    {
        return $this->hasOne('Logistica\Tramite\tramLogVerificacion','tlvId','tlbVerificacionId');
    }
}
