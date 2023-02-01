<?php

namespace App\Http\Requests\Pais;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePaisRequest extends FormRequest
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
            'pais_nombre' => 'required|max:255',
            'slc_estado_pais' => 'required|boolean|numeric'
        ];
    }
}
