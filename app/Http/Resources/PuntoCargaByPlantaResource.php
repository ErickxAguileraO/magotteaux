<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PuntoCargaByPlantaResource extends JsonResource
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
            'id' => $this->puc_id,
            'nombre' => $this->puc_nombre,
        ];
    }
}
