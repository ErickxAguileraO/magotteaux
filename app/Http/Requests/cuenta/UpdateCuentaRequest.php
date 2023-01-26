<?php

namespace App\Http\Requests\cuenta;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCuentaRequest extends FormRequest
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
            'password' => 'required|max:12|min:8'
        ];
    }

    public function messages()
    {
        return [
            'password.required' => 'Debe ingresar su contraseña,',
            'password.max' => 'Los caracteres máximos de la contraseña son 12',
            'password.min' => 'Los caracteres mínimos de la contraseña son 8',
        ];
    }
}
