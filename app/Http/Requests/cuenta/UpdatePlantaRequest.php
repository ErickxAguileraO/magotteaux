<?php

namespace App\Http\Requests\cuenta;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePlantaRequest extends FormRequest
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
            'nombre_planta' => 'required|max:255',
            'slc_planta_pais' => 'required',
            'estado_planta' => 'required|boolean|numeric'
        ];
    }
}
