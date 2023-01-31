<?php

namespace App\Http\Requests\cuenta;

use Illuminate\Foundation\Http\FormRequest;

class CreateEmpresaTransporteRequest extends FormRequest
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
            'nombre_empresa' => 'required|max:255',
            'rut_empresa' => 'required|max:255',
            'slc_estado_empresa' => 'required|boolean|numeric'
        ];
    }
}
