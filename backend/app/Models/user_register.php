<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;

class user_register extends Model
{
    use HasFactory, HasApiTokens, Notifiable;

    protected $table = "user_register";
    protected $primaryKey = "register_id";
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
    ];
}