<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laratrust\Traits\LaratrustUserTrait;
use Illuminate\Database\Eloquent\Casts\Attribute;


class User extends Authenticatable
{
    use LaratrustUserTrait;
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    protected $appends =['avatar_url'];


    protected function getAvatarUrlAttribute(){
        $path = asset('uploads/users_avatar');

        return  is_null($this->avatar) ? $path.'/default.png':$path .'/'.$this->avatar;
    }

    // protected function avatar(): Attribute
    // {
    //     $path = asset('uploads/users_avatar/');

    //     return Attribute::make(
    //         get: fn ($value) => is_null($value)? $path.'/default.png':$path .'/'.$value
    //     );
    // }


}
