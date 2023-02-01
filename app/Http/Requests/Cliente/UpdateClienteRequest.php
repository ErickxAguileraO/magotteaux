<?php

namespace App\Http\Requests\Cliente;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClienteRequest extends FormRequest
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
            'crear_nombre_cliente' => 'required|max:255',
            'identificador_cliente' => 'max:255',
            'slc_crear_pais_cliente' => 'required',
            'slc_estado_cliente' => 'required|boolean|numeric'
        ];
    }
}
