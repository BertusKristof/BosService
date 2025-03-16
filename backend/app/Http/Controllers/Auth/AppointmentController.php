<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\appointments;

class AppointmentController extends Controller
{
    public function manageAppointment(Request $request, $appointment_id)
    { 
        $userId = auth()->id();
        $existAppointment = appointments::where('id', $userId)->first();
        
        if($existAppointment){
            $existAppointment->appointment_service = $request->appointment_service;
            $existAppointment->appointment_time = $request->appointment_time;
            $existAppointment->appointment_date = $request->appointment_date;
            $existAppointment->save();

            return response()->json(['message' => 'Appointment updated successfully', 'appointment' => $existAppointment], 200);
        }else{
            $newAppointment = appointments::create([
                'id' => $userId,
                'appointment_service' => $appointment_service,
                'appointment_time' => $appointment_time,
                'appointment_date' => $appointment_date,
            ]);

            return response()->json(['message' => 'Appointment created successfully', 'appointment' => $newAppointment], 201);
        }
    }
}