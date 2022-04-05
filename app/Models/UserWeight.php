<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserWeight extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected $table ='user_weights';
    protected $casts = [
        'created_at' => "date:Y-m-d",
    ];



}
