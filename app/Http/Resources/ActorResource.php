<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ActorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return parent::toArray($request);
        /*return [
            'title' => $this->name,
            'slug' => $this->slug,
            'rating' => $this->rating,
            'image_path' => $this->image_path,
            'alternative_name' => $this->alternative_name,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];*/
    }
}
