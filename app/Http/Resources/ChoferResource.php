<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ChoferResource extends JsonResource
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
            'id' => $this->cho_id,
            'nombre' => $this->cho_nombre.' '.$this->cho_apellido,
            'empresa' => $this->empresaTransporte->emt_nombre,
            'estado' => $this->cho_estado,
        ];
    }
}
