<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\appointments;

class AppointmentController extends Controller
{
    public function updateAppointment(Request $request, $appointment_id)
    { 
        $appointment = appointments::where('appointment_id', $id)->first();

    if (!$appointment) {
        return response()->json(['message' => 'Appointment not found'], 404);
    }

    $appointment->appointment_service = $request->appointment_service;
    $appointment->appointment_time = $request->appointment_time;
    $appointment->appointment_date = $request->appointment_date;

    $appointment->save();

    return response()->json([
        'message' => 'Appointment updated successfully',
        'appointment' => $appointment
    ], 200);
}
public function store(Request $request)
{
    $validated = $request->validate([
        'appointment_service' => 'required|string',
        'appointment_time' => 'required',
        'appointment_date' => 'required|date',
    ]);

    $appointment = appointments::create([
        'appointment_service' => $validated['appointment_service'],
        'appointment_time' => $validated['appointment_time'],
        'appointment_date' => $validated['appointment_date']
    ]);

    return response()->json([
        'message' => 'Appointment created successfully',
        'appointment' => $appointment
    ], 201);
}

}