<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodMedia extends Model
{
    use HasFactory;

    protected $guarded=[];
    protected $table ='food_media';



    protected $appends =['file_url'];

    protected function getFileUrlAttribute(){
        return  is_null($this->file_name) ? asset('uploads/food_media/default.png'):asset('uploads/food_media/'.$this->file_name);
    }

    public function food()
    {
        return $this->belongsTo(Food::class, 'food_id');
    }

}
