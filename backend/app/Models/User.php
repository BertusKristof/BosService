<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class UserRegister extends Model
{
    use HasFactory;

    protected $table = 'user_register';

    protected $fillable = [
        'first_name',
        'last_name',
        'register_email',
        'register_phone',
        'register_password',
    ];
}

class UserLogin extends Model
{
    use HasFactory;

    protected $table = 'user_login';

    protected $fillable = [
        'user_id',
        'login_email',
        'login_phone',
        'login_password',
    ];
}
