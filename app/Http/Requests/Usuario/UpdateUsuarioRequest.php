<?php

namespace App\Http\Requests\Usuario;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUsuarioRequest extends FormRequest
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
            'celular' => ['required', 'max:255'],
            'email' => ['required', 'max:255', 'email:filter'],
            'contrasena' => ['nullable', 'max:255', 'min:8'],
            'identificacion' => ['nullable', 'max:255'],
            'tipo_usuario' => ['required', 'in:1,2,3'],
            'cliente' => [
                'nullable',
                'required_if:tipo_usuario,2',
                Rule::exists('clientes', 'cli_id')->whereNull('deleted_at')
            ],
            'destino' => [
                'nullable',
                'required_if:tipo_usuario,2',
                Rule::exists('destinos', 'des_id')->where('des_cliente_id', $this->cliente)->whereNull('deleted_at')
            ],
            'planta' => [
                'nullable',
                'required_if:tipo_usuario,1',
                Rule::exists('plantas', 'pla_id')->whereNull('deleted_at')
            ],
            'estado' => ['required', 'boolean'],
        ];
    }

    public function messages()
    {
        return [
            'cliente.required_if' => 'El campo empresa es obligatorio cuando tipo usuario es cliente.',
            'planta.required_if' => 'El campo planta es obligatorio cuando tipo usuario es logística.',
        ];
    }
}
