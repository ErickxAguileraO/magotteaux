<?php

namespace App\Http\Resources\Carga;

use Illuminate\Http\Resources\Json\JsonResource;

class CargaLogisticaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->car_id,
            'patente' => $this->patente->pat_patente,
            'tipo' => $this->tipo->tic_nombre,
            'cliente' => $this->cliente->cli_nombre,
            'tamano_bola' => $this->tamanoBola->tab_tamano,
            'planta' => $this->planta->pla_nombre,
            'fecha_carga' => $this->car_fecha_carga,
            'fecha_salida' => $this->car_fecha_salida,
            'empresa' => $this->empresaTransporte->emt_nombre,
            'email_enviado' => $this->car_email_enviado,
        ];
    }
}
