<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UsuarioResource extends JsonResource
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
            'id' => $this->usu_id,
            'tipo' => $this->getRoleId(),
            'nombre' => $this->usu_nombre.' '.$this->usu_apellido,
            'planta' => $this->planta->pla_nombre ?? '- - -',
            'estado' => $this->usu_estado,
        ];
    }
}
