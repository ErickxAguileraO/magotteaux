<?php

namespace App\Http\Requests\cuenta;

use Illuminate\Foundation\Http\FormRequest;

class CreatePaisRequest extends FormRequest
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

    public function rules()
    {
        return [
            'pais_nombre' => 'required|max:255',
            'slc_estado_pais' => 'required|boolean|numeric'
        ];
    }
}
