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
        'appointment_id	',
        'costumer_name',
        'car_license_plate',
        'appointment_date',
        'appointment_time',
        'status'
    ];
}
