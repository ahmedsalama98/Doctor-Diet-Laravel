<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MealMedia extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected $table ='meal_media';



    protected $appends =['file_url'];

    protected function getFileUrlAttribute(){
        return  is_null($this->file_name) ? asset('uploads/meal_media/default.png'):asset('uploads/meal_media/'.$this->file_name);
    }

    public function meal()
    {
        return $this->belongsTo(Meal::class, 'meal_id');
    }
}
