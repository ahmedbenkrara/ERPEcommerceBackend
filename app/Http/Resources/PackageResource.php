<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PackageResource extends JsonResource
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
            'name' => $this->name,
            'description' => $this->description,
            'price' => (string) $this->price,
            'created_at' => (string) $this->created_at,
            'relationships' => [
                'modules' => $this->models->map->only(['id', 'name', 'description', 'price', 'images', 'reviews']),
                'reviews' => $this->reviews
            ]
        ];
    }
}