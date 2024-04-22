<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderItemResource extends JsonResource
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
            'quantity' => (string)$this->quantity, 
            'type' => $this->type,
            'relationships' => [
                'module' => $this->modele, 
                'package' => $this->package,
                'order' => $this->order
            ]
        ];
    }
}
