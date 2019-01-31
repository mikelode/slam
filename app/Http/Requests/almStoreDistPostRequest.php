<?php

namespace Logistica\Http\Requests;

use Logistica\Http\Requests\Request;

class almStoreDistPostRequest extends Request
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
            'disDateAttend' => 'required',
            'disNameServer' => 'required | regex:/(^[A-Za-z ñáéíóú ÑÁÉÍÓÚ ]+$)+/',
//            'disDniApplicant' => 'required | digits:8',
//            'disNameApplicant' => 'required | regex:/(^[A-Za-z ñáéíóú ÑÁÉÍÓÚ ]+$)+/',
            'disDependency' => 'required',
            'disRole' => 'required',
            'disTarget' => 'required',
            'disComment' => 'max:255',
        ];
    }

    public function attributes()
    {
        return [
            'disDateAttend' => 'Fecha de Atención',
            'disNameServer' => 'Nombre Atiende',
//            'disDniApplicant' => 'DNI Solicitante',
//            'disNameApplicant' => 'Nombres Solicitante',
            'disDependency' => 'Dependencia',
            'disRole' => 'Cargo',
            'disTarget' => 'Destino',
            'disComment' => 'Observación',
        ];
    }
}
