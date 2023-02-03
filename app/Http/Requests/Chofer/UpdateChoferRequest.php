<?php

namespace App\Http\Requests\Chofer;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateChoferRequest extends FormRequest
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
            'nombre' => ['required', 'max:255'],
            'apellido' => ['required', 'max:255'],
            'empresa' => ['required', Rule::exists('empresa_transportes', 'emt_id')->whereNull('deleted_at')],
            'identificacion' => ['required', 'max:255'],
            'estado' => ['required', 'boolean'],
        ];
    }

    public function attributes()
    {
        return [
            'empresa' => 'empresa de transporte',
            'identificacion' => 'identificación',
        ];
    }
}
