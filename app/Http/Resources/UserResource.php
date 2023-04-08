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
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->rol,
            'availability' => $this->config['availability'],
            'latitude' => $this->when($request->routeIs('coordinates:update'), $this->config['latitude']),
            'longitude' => $this->when($request->routeIs('coordinates:update'), $this->config['longitude']),
        ];
    }
}
