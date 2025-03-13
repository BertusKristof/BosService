<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;

class user_login extends Authenticatable  
{
    use Notifiable, HasApiTokens, HasFactory;

    protected $table = "user_login";    
    protected $primaryKey = "user_login";
    public $timestamps = false;    
    protected $fillable = [
        'login_email',
        'login_phone',
        'login_password',
    ];
    protected $hidden=[
        'login_password'
    ];
}