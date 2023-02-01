<?php

namespace App\Http\Requests\PuntoCarga;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePuntoCargaRequest extends FormRequest
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
            'nombre_puntoCarga' => 'required|max:255',
            'slc_planta_puntoCarga' => 'required',
            'slc_estado_puntoCarga' => 'required|boolean|numeric'
        ];
    }
}
