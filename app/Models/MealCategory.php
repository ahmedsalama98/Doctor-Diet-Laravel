<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MealCategory extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected $table ='meal_categories';


    protected $appends =['file_url','name'];


    protected function getFileUrlAttribute(){
        return  is_null($this->file_name) ? asset('uploads/meal_categories/default.png'):asset('uploads/meal_categories/'.$this->file_name);
    }



    protected function getNameAttribute(){

        $name = 'name_'.app()->getLocale();
        return $this->$name ;
    }
}
