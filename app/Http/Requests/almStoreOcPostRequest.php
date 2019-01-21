<?php

namespace Logistica\Http\Requests;

use Logistica\Http\Requests\Request;

class almStoreOcPostRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'ocCodigo' => 'required',
            'ocDateNotification' => 'required',
            'ocDateExpiration' => 'required',
            'ocDeliveryType' => 'required',
            'ocAlmacen' => 'required',
//            'ocNroGuiaRemision' => 'required',
//            'ocNroFactura' => 'required',
            'ocComment' => 'max:255',
        ];
    }

    public function attributes()
    {
        return[
            'ocCodigo' => 'Orden de Compra',
            'ocDateNotification' => 'Fecha de Notificación',
            'ocDateExpiration' => 'Fecha de Vencimiento',
            'ocDeliveryType' => 'Tipo de Entrega',
            'ocAlmacen' => 'Almacén',
//            'ocNroGuiaRemision' => 'Guia de Remisión',
//            'ocNroFactura' => 'Factura',
            'ocComment' => 'Observación',
        ];
    }
}
