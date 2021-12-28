<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CapiResource extends JsonResource
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
            /*'gestion' => '',
            'entidad' => '',
            'sisin' => '',
            'capi' => '',
            'MontoTotal' => '',
            'estado' => '',
            'mensaje' => '',*/
            'id' => $this->usuario_id,
            'nombreCompleto' => $this->nombres.' '.$this->paterno.' '.$this->materno,
            'correo' => $this->correo
        ];
    }
}
