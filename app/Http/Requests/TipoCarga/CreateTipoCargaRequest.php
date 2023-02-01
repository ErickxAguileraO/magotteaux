<?php

namespace App\Http\Requests\TipoCarga;

use Illuminate\Foundation\Http\FormRequest;

class CreateTipoCargaRequest extends FormRequest
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
            'nombre_tipo_carga' => 'required|max:255',
            'slc_estado_tipo_carga' => 'required|boolean|numeric'
        ];
    }
}
