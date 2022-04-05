<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class MealResource extends JsonResource
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
            'id'=>$this->id,
            'calories'=>$this->calories,
            'category'=>['name'=> $this->category->name, 'id'=>$this->category->id],
            'created_at'=>$this->created_at->format('h:i A'),
            'foods'=> collect($this->foods)->map(function($item){
                return [
                    'id'=> $item->id,
                    'unit'=> strtoupper ($item->unit),
                    'name'=> $item->name,
                    'description'=> $item->description,
                    'file_url'=> $item->first_media->file_url,
                    'calories'=>$item->calories,
                    'quantity'=> $item->pivot->quantity
                ];
            }),
        ];
    }
}
