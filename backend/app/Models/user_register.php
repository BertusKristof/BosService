<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class user_register extends Model
{
    use HasFactory;

    protected $table = "user_register";
    public $timestamps = false;    
    protected $fillable = [
        'first_name',
        'last_name',
        'register_email',
        'register_phone',
        'register_password',
    ];
}
