<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PatenteResource extends JsonResource
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
            'id' => $this->pat_id,
            'nombre' => $this->pat_patente,
            'estado' => $this->pat_estado,
            'empresa_transportes' => $this->empresaTransporte->emt_nombre,
        ];
    }
}
