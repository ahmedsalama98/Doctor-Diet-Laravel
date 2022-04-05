<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FoodResource extends JsonResource
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
            'id'=> $this->id,
            'unit'=> strtoupper ($this->unit),
            'name'=> $this->name,
            'description'=> $this->description,
            'file_url'=> $this->first_media->file_url,
            'calories'=>$this->calories,
            'media'=>$this->media,

        ];
    }
}
