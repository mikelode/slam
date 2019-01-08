<?php

namespace Logistica\Http\Requests;

use Logistica\Http\Requests\Request;

class almStoreInterPostRequest extends Request
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
            'intDateReceipt' => 'required',
            'intDniGiver' => 'required | digits:8',
            'intNameGiver' => 'required | regex:/(^[A-Za-z ñáéíóú ÑÁÉÍÓÚ ]+$)+/',
            'intDniReceiver' => 'required | digits:8',
            'intNameReceiver' => 'required | regex:/(^[A-Za-z ñáéíóú ÑÁÉÍÓÚ ]+$)+/',
            'intDniDriver' => 'digits:8',
            'intNameDriver' => 'regex:/(^[A-Za-z ñáéíóú ÑÁÉÍÓÚ ]+$)+/',
            'intComment' => 'max:255',
        ];
    }

    public function attributes()
    {
        return [
            'intDateReceipt' => 'de la Fecha de Recepción',
            'intDniGiver' => 'del DNI de la persona que entrega',
            'intNameGiver' => 'del Nombre de la persona que entrega',
            'intDniReceiver' => 'del DNI de la persona que recibe',
            'intNameReceiver' => 'del Nombre de la persona que recibe',
            'intDniDriver' => 'del DNI del onductor',
            'intNameDriver' => 'del Nombre del Conductor',
            'intComment' => 'de la Observación',
        ];
    }
}
