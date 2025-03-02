<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
// use App\Models\PersonalAccessToken;

class user_login extends Authenticatable
{
    use Notifiable, HasApiTokens;

    protected $table = "user_login";
    public $timestamps = false;    
    protected $fillable = [
        'login_email',
        'login_phone',
        'login_password',
    ];
    protected $hidden=[
        'login_password'
    ];
public function tokens()
{
    return $this->hasMany(PersonalAccessToken::class, 'tokenable_id');
}

}