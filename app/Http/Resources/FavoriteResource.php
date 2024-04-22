<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FavoriteResource extends JsonResource
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
            'id' => (string)$this->id,
            'type' => $this->type,
            'created_at' => $this->created_at,
            'relationships' => [
                'module' => $this->modele,
                'package' => $this->package,
                'user' => $this->user
            ],
        ];
    }
}
