<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
    use HasFactory;

    protected $guarded=[];
    protected $table ='meals';


    public function media()
    {
        return $this->hasMany(MealMedia::class, 'meal_id', 'id');
    }
    public function first_media()
    {
        return $this->hasOne(MealMedia::class, 'meal_id', 'id')->oldestOfMany();
    }

    public function category(){
        return $this->belongsTo(MealCategory::class,'category_id','id');
    }
    public function foods()
    {
        return $this->belongsToMany(Food::class, 'meal_food', 'meal_id', 'food_id')->withPivot('quantity');
    }


}
