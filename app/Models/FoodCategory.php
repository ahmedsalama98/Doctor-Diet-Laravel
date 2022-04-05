<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodCategory extends Model
{
    use HasFactory;

    protected $guarded=[];
    protected $table ='food_categories';

    protected $appends =['file_url' ,'name','description'];


    protected function getFileUrlAttribute(){
        return  is_null($this->file_name) ? asset('uploads/food_categories/default.png'):asset('uploads/food_categories/'.$this->file_name);
    }
    protected function getDescriptionAttribute(){

        $description  = 'description_'.app()->getLocale();
        return  $this->$description ;
    }

    protected function getNameAttribute(){

        $name = 'name_'.app()->getLocale();
        return $this->$name ;
    }

    public function foods(){

        return $this->hasMany(Food::class , 'category_id','id');
    }
}
