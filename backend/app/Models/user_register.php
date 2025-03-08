<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;

class user_register extends Model
{
    use HasFactory, HasApiTokens, Notifiable;

    protected $table = "user_register";
    public $timestamps = false;    
    protected $fillable = [
        'first_name',
        'last_name',
        'register_email',
        'register_phone',
        'register_password',
    ];

    protected $hidden =[
        'register_password'
    ];/**
    * Get the identifier that will be stored in the JWT token.
    *
    * @return mixed
    */
   public function getJWTIdentifier()
   {
       return $this->getKey();
   }

   /**
    * Get custom claims to be added to the JWT token.
    *
    * @return array
    */
   public function getJWTCustomClaims()
   {
       return [];
   }
}