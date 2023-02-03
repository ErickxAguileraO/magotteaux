<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DestinoResource extends JsonResource
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
            'id' => $this->des_id,
            'nombre' => $this->des_nombre,
            'estado' => $this->des_estado,
            'cliente_asociado' => $this->cliente->cli_nombre,
        ];
    }
}
