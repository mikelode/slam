<?php

namespace Logistica\Http\Requests;

use Logistica\Http\Requests\Request;

class almStoreNeaPostRequest extends Request
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
            'neaDateInput' => 'required',
            'neaNeaType' => 'required',
            'neaAlmacen' => 'required',
            'neaDniReceipt' => 'required | digits:8',
            'neaNameReceipt' => 'required | regex:/(^[A-Za-z ñáéíóú ÑÁÉÍÓÚ ]+$)+/',
            'neaDniGiver' => 'digits:8',
            'neaNameGiver' => 'regex:/(^[A-Za-z ñáéíóú ÑÁÉÍÓÚ ]+$)+/',
            'neaComment' => 'max:255',
        ];
    }

    public function attributes()
    {
        return [
            'neaDateInput' => 'Fecha de Ingreso',
            'neaNeaType' => 'Tipo de NEA',
            'neaAlmacen' => 'Almacen',
            'neaDniReceipt' => 'DNI Recibe',
            'neaNameReceipt' => 'Nombre Recibe',
            'neaDniGiver' => 'DNI Entrega',
            'neaNameGiver' => 'Nombre Entrega',
            'neaComment' => 'Observación',
        ];
    }
}
