<?php

namespace App\Http\Requests\Destino;

use Illuminate\Foundation\Http\FormRequest;

class CreateDestinoRequest extends FormRequest
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
            'nombre_destino' => 'required|max:255',
            'cliente_destino' => 'required',
            'estado_destino' => 'required|boolean|numeric'
        ];
    }
}
