<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\appointments;

class AppointmentController extends Controller
{
    public function manageAppointment(Request $request, $id)
    {
    $data = $request->all();

    $appointment = appointments::where('appointment_id', $id)->first();

    $updateData = [
        'appointment_service' => $data['service'] ?? null,
        'appointment_time' => $data['time'] ?? null,
        'appointment_date' => $data['date'] ?? null,
    ];

    if (isset($data['contact_name'])) {
        $updateData['contact_name'] = $data['contact_name'];
    }

    if ($appointment) {
        if (
            empty($updateData['appointment_service']) &&
            empty($updateData['appointment_time']) &&
            empty($updateData['appointment_date'])
        ) {
            return response()->json(['message' => 'Nincs változás, üres adatokkal nem frissítünk'], 200);
        }

        $appointment->update($updateData);
        return response()->json(['message' => 'Appointment updated', 'appointment' => $appointment], 200);
    }

    $updateData['appointment_id'] = $id;
    $appointment = appointments::create($updateData);
    return response()->json(['message' => 'Appointment created', 'appointment' => $appointment], 201);

    }


    public function getAppointment($id)
    {
        $appointment = appointments::where('appointment_id', $id)->first();

        if ($appointment) {
            return response()->json($appointment);
        } else {
            return response()->json(['message' => 'Nincs foglalás'], 404);
        }
    }
    public function getBookedTimes(Request $request)
    {
        $date = $request->input('date');

        $bookedTimes = appointments::where('appointment_date', $date)
            ->whereNotNull('appointment_time')
            ->pluck('appointment_time');

        return response()->json($bookedTimes);
    }
}