<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\cars;

class CarsDataController extends Controller
{
    public function carsData(Request $request){
        $request->validate([
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|integer|min:1900|max:' . date('Y'),
            'license_plate' => [
                'required',
                'string',
                'max:10',
                'unique:cars,license_plate',
                'regex:/^(?:[A-Z]{3}-\d{3}|[A-Z]{4}-\d{2}|[A-Z]{2}\.[A-Z]{2}-\d{2}|[A-Z]{2}-[A-Z]{2}-\d{2}|[A-Z]{2}:[A-Z]{2}-\d{2})$/'
            ],
        ]);

        cars::create([
            'license_plate' => $request->license_plate,
            'brand' => $request->brand,
            'model' => $request->model,
            'year' => $request->year,
        ]);
    }
}
