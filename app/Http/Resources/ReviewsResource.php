<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReviewsResource extends JsonResource
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
            'fullname' => $this->fullname,
            'email' => $this->email,
            'title' => $this->title,
            'rate' => (string)$this->rate,
            'message' => $this->message,
            'type' => $this->type
        ];
    }
}
