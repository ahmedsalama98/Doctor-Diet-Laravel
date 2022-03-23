<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    protected $guarded=[];

    protected $appends =['ago'];

    public function getAgoAttribute(){
        $contact_date = new DateTime($this->created_at);
        $now = new DateTime();
        $interval = $now->diff($contact_date);

        // return $interval;

        if($interval->y >= 1){
            return $interval->y .' Y ';
        }
        if($interval->m <= 12  &&$interval->m !=0 ){
            return $interval->m .' M ';
        }
        if($interval->d<= 31&&$interval->d !=0){
            return $interval->d .' D ';
        }
        if($interval->h <= 24 &&$interval->h !=0){
            return $interval->h .' H ';
        }

        if($interval->i <= 60 &&$interval->i !=0){
            return $interval->i .' minutes';
        }

        if($interval->s <= 60 &&$interval->s !=0){
            return $interval->s .' second';
        }

        return 'Now';




    }

}
