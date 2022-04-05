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
        $lastWeight =  is_null($this->lastWeight)? null :['weight'=> $this->lastWeight->weight , 'created_at'=>$this->lastWeight->created_at->format('d/m/Y')];

        $perfect_weight =$this->height -100;
        $weight_matrix = $perfect_weight /$this->lastWeight->weight;
        if($weight_matrix > 1){
            $weight_matrix =  $this->lastWeight->weight /$perfect_weight;
        }
        $percentage = $weight_matrix * 100;

        $fitness = [
            'percentage'=> $percentage,
            'perfect_weight'=>$perfect_weight,
            'lastWeight'=> $lastWeight,
            'should_lose_weight'=>  $perfect_weight <  $this->lastWeight->weight ? $this->lastWeight->weight -$perfect_weight :null,
            'should_gain_weight'=>  $perfect_weight >  $this->lastWeight->weight ?  $perfect_weight - $this->lastWeight->weight:null,
        ];

        return [
            'id'=> $this->id,
            'name'=> $this->name,
            'email'=> $this->email,
            'gender'=> $this->gender,
            'birth_date'=> $this->birth_date,
            'avatar_url'=> $this->avatar_url,
            'daily_use_target'=> $this->daily_use_target,
            'receive_email'=> $this->receive_email,
            'height'=> $this->height,
            'fitness'=>$fitness,
            "using_today"=> collect($this->today_meals)->reduce(function($total ,$item){
                return $total + $item['calories'];
            }),
            // 'today_meals'=> MealResource::collection($this->today_meals),
        ];
    }
}
