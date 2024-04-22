<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'id'=> (string)$this->id,
            'fname'=> $this->fname,
            'lname'=> $this->lname,
            'email'=> $this->email,
            'email_verified_at'=> $this->email_verified_at,
            'role'=> $this->role,
            'created_at'=> $this->created_at,
            'updated_at'=> $this->updated_at,
            'details' => $this->clientdetails,
            'favorites' => $this->favorites->map(function($item){
                return[
                    'id' => (string)$item->id,
                    'type' => $item->type,
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
                    ] : null,
                    'module' => $item->modele ? $item->modele->only(['id', 'name', 'description', 'price', 'images']) : null,
                ];
            })
        ];
    }
}
