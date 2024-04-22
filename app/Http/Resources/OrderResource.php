<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'status' => $this->status,
            'orderdate' => $this->orderdate,
            'shipdate' => $this->shipdate,
            'relationships' => [
                'user' => $this->user,
                'items' => $this->items->map(function($item){
                    return [
                        'id' => (string) $item->id,
                        'quantity' => (string) $item->quantity,
                        'type' => $item->type,
                        'created_at' => $item->created_at,
                        'module' => $item->modele ? $item->modele->only(['id', 'name', 'description', 'price', 'images']) : null,
                        'package' => $item->package ? [
                            'id' => $item->package->id, 
                            'name' => $item->package->name, 
                            'description' => $item->package->description, 
                            'price' => $item->package->price, 
                            'modules' => $item->package->models ? $item->package->models->map(function ($md){
                                return [
                                    'id' => $md->id,
                                    'name' => $md->name,
                                    'description' => $md->description,
                                    'price' => $md->price,
                                    'images' => $md->images
                                ];
                            }) : null,
                        ] : null
                    ];
                })
            ]
        ];
    }
}
