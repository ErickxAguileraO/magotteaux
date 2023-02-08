<?php

namespace App\Http\Requests\Carga;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateCargaRequest extends FormRequest
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
        $hoy = now()->format('Y-m-d\TH:i');
        $ayer = now()->subDay(1)->format('Y-m-d 00:00');

        return [
            'empresa' => ['required', Rule::exists('empresa_transportes', 'emt_id')->where('emt_estado', 1)->whereNull('deleted_at')],
            'chofer' => ['required', Rule::exists('choferes', 'cho_id')->where('cho_estado', 1)->whereNull('deleted_at')],
            'patente' => ['required', Rule::exists('patentes', 'pat_id')->where('pat_estado', 1)->whereNull('deleted_at')],
            'tipo_carga' => ['required', Rule::exists('tipo_cargas', 'tic_id')->where('tic_estado', 1)->whereNull('deleted_at')],
            'tamano_bola' => ['required', Rule::exists('tamano_bolas', 'tab_id')->where('tab_estado', 1)->whereNull('deleted_at')],
            'fecha_carga' => ['required', 'date', 'date_format:Y-m-d\TH:i', 'before_or_equal:' . $hoy, 'after_or_equal:' . $ayer],
            'fecha_salida' => ['required', 'date', 'date_format:Y-m-d\TH:i', 'after_or_equal:fecha_carga'],
            'planta' => ['required', Rule::exists('plantas', 'pla_id')->where('pla_estado', 1)->whereNull('deleted_at')],
            'punto_carga' => ['required', Rule::exists('punto_cargas', 'puc_id')->where('puc_estado', 1)->whereNull('deleted_at')],
            'cliente' => ['required', Rule::exists('clientes', 'cli_id')->where('cli_estado', 1)->whereNull('deleted_at')],
            'destino' => ['required', Rule::exists('destinos', 'des_id')->where('des_estado', 1)->whereNull('deleted_at')],
            'numero_guia_despacho' => ['required', 'min:3', 'max:255'],
            'guia_despacho' => ['required', 'file', 'mimes:pdf', 'max:5120'],
            'certificado_calidad' => ['required', 'file', 'mimes:pdf', 'max:5120'],
            'foto_patente' => ['required', 'file', 'mimes:png,jpeg,jpg', 'max:8192'],
            'foto_carga' => ['required', 'file', 'mimes:png,jpeg,jpg', 'max:8192'],
        ];
    }

    public function attributes()
    {
        return [
            'guia_despacho' => 'guía de despacho',
            'certificado_calidad' => 'certificado de calidad',
            'foto_patente' => 'foto de patente',
            'foto_carga' => 'foto de carga',
        ];
    }
}
