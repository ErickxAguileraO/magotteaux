<?php

namespace App\Http\Requests\TamnoBola;

use Illuminate\Foundation\Http\FormRequest;

class CrearTamanoBolaRequest extends FormRequest
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
            'tamano' => ['required', 'numeric', 'max:10000', 'unique:tamano_bolas,tab_tamano'],
            'estado' => ['required', 'boolean'],
        ];
    }
}
