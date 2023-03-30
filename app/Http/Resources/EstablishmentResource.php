<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EstablishmentResource extends JsonResource
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
            'id' => $this->id ,
            'name' => $this->name ,
            'address' => $this->address ,
            'phone' => $this->phone ,
            'logo' => $this->logo ,
            'stars' => $this->stars ,
            'category' => $this->category ,
            'products' => ProductResource::collection($this->whenLoaded('products'))
        ];
    }
}
