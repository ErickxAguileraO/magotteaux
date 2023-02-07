<?php

namespace App\Http\Requests\Patente;

use Illuminate\Foundation\Http\FormRequest;

class CreatePatenteRequest extends FormRequest
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
            'numero_patente' => 'required|max:255',
            'empresa_transporte_patente' => 'required',
            'estado_patente' => 'required|boolean|numeric'
        ];
    }
}
