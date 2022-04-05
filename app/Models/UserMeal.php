<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserMeal extends Model
{
    use HasFactory;
    protected $table ='user_meals';
    public function category(){
        return $this->belongsTo(MealCategory::class,'category_id','id');
    }
    public function foods()
    {
        return $this->belongsToMany(Food::class, 'user_meals_food', 'meal_id', 'food_id')->withPivot('quantity');
    }

}
