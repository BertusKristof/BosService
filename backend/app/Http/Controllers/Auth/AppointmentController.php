<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\appointments;

class AppointmentController extends Controller
{
    public function updateAppointment(Request $request, $appointment_id)
    { 
        $validated = $request->validate([
            'appointment_service' => 'nullable|string',
            'appointment_time' => 'nullable|date_format:H:i',
            'appointment_date' => 'nullable|date_format:Y-m-d',
        ]);
    
        $appointment = appointments::where('appointment_id', $appointment_id)
                                  ->first();
    
        if (!$appointment) {
            return response()->json(['error' => 'Appointment not found'], 404);
        }
    
        \Log::info('Before update:', [
            'appointment_service' => $appointment->appointment_service,
            'appointment_time' => $appointment->appointment_time,
            'appointment_date' => $appointment->appointment_date
        ]);
        
        $appointment->appointment_service = $validated['appointment_service'];
        $appointment->appointment_time = $validated['appointment_time'];
        $appointment->appointment_date = $validated['appointment_date'];
        
        $appointment->save();
        
     
    
        $updated = false;
        if ($validated['appointment_service'] !== null) {
            $appointment->appointment_service = $validated['appointment_service'];
            $updated = true;
        }
        if ($validated['appointment_time'] !== null) {
            $appointment->appointment_time = $validated['appointment_time'];
            $updated = true;
        }
        if ($validated['appointment_date'] !== null) {
            $appointment->appointment_date = $validated['appointment_date'];
            $updated = true;
        }
    
        if ($updated) {
            $appointment->save();
    
            \Log::info('After update:', [
                'appointment_service' => $appointment->appointment_service,
                'appointment_time' => $appointment->appointment_time,
                'appointment_date' => $appointment->appointment_date
            ]);
    
            return response()->json(['message' => 'Appointment updated successfully', 'appointment' => $appointment]);
        } else {
            return response()->json(['message' => 'No updates were made'], 200);
        }
}
}