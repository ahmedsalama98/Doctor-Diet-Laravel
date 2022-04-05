<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;

    protected $guarded=[];
    protected $table ='foods';

    protected $appends =['name', 'description'];

    public function first_media()
    {
        return $this->hasOne(FoodMedia::class, 'food_id', 'id')->oldestOfMany();
    }
    protected function getNameAttribute(){

        $name  = 'name_'.app()->getLocale();
        return  $this->$name ;
    }

    protected function getDescriptionAttribute(){

        $description  = 'description_'.app()->getLocale();
        return  $this->$description ;
    }


    public function media()
    {
        return $this->hasMany(FoodMedia::class, 'food_id', 'id');
    }

    public function category(){
        return $this->belongsTo(FoodCategory::class,'category_id','id');
    }

    public function meals()
    {
        return $this->belongsToMany(Meal::class, 'meal_food', 'food_id', 'meal_id');
    }



}
