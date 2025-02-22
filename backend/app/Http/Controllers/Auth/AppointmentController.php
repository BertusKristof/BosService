<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;



class AppointmentController extends Controller
{
    // public function showAppointmentForm(){
    //     return view('idopont');
    // }
    // public function appointment(Request $request){
    //     $validate = Validator::make($request->all(),[
    //         'contact_name' => 'required|string|max:200',
    //         'appointment_service' => 'required|string|max:250',
    //         'appointment_date' => 'required|date',
    //         'appointment_time' => 'required|string',
    //     ]);
    //     if($validate->fails()){
    //         return redirect('idopont')
    //             ->withErrors($validate)
    //             ->withInput();
    //     }
    // }
    public function UpdateUserAppointment(Request $request){
        $validate = Validator::make($request->all(),[
            'appointment_service' => 'required|varchar|max:250',
            'appointment_date' => 'required|date',
            'appointment_time' => 'required|string',
        ]);

        if($validate->fails()){
            return response()->json(['error' => $validate->errors()], 400);
        }

        $appointments = appointment::where('user_id', Auth::id())->first();
        $appointments->update([
            'appointment_service' => $request->appointment_service,
            'appointment_date' => $request->appointment_date,
            'appointment_time' => $request->appointment_time,
        ]);
        // if($validate->fails()){
        //     return response()->json(['error' => $validate->errors()], 400);
        // }
        // DB::statment('CALL UpdateUserAppointment(?,?,?)',[
        //     $request->appointment_date,
        //     $request->appointment_time,  
        //     $request->appointment_service,
        // ]);ű
        return response()->json(['success' => 'Sikeresen módosítottad az időpontodat.'], 200);
    }
}
