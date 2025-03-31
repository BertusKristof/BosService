<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class cars extends Model
{
    use HasFactory;
    protected $table = "cars";
    protected $primaryKey = 'car_id';
    public $timestamps = false;
    protected $fillable = [
        'car_id',
        'license_plate',    
        'brand',
        'model',
        'year',
    ];
}
