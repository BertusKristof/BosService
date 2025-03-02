<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class appointments extends Model
{
    use HasFactory;
    protected $table = "appointments";
    public $timestamps = false;
    protected $fillable = [
        'contact_name',
        'appointment_service',
        'appointment_date',
        'appointment_time',
    ];
}