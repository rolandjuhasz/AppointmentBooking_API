<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    public function index(){
        return Appointment::with(['user', 'course'])->where('user_id', Auth::id())->get();
    }

    public function store(Request $request){
    $request->validate([
        'course_id' => 'required|exists:courses,id',
        'appointment_time' => 'required|date_format:Y-m-d',
    ]);

    $user = Auth::user();
    $course = Course::find($request->course_id);

    if ($user->role !== 'expert' || $course->user_id !== $user->id) {
        return response()->json(['error' => 'Unauthorized to create appointment for this course'], 403);
    }

    $appointment = new Appointment([
        'course_id' => $request->course_id,
        'appointment_time' => $request->appointment_time,
        'user_id' => null, // Kezdetben senki sem foglalta még le
        'created_by_id' => $user->id, // A létrehozó felhasználó az aktuális user
    ]);

    $appointment->save();

    return response()->json([
        'message' => 'Appointment created successfully',
        'appointment' => $appointment,
    ], 201);
}

    public function show(Appointment $appointment){
        if (Auth::id() !== $appointment->user_id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        return response()->json($appointment->load(['user', 'course']), 200);
    }

    public function destroy(Appointment $appointment){
        if (Auth::id() !== $appointment->user_id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $appointment->delete();

        return response()->json(['message' => 'Appointment canceled'], 200);
    }

    public function getAppointments($courseId){
    $appointments = Appointment::where('course_id', $courseId)->get();
    
    return response()->json($appointments);
    }
    

    public function bookAppointment($id) {
    $appointment = Appointment::find($id);

    if (!$appointment) {
        return response()->json(['error' => 'Appointment not found'], 404);
    }

    if ($appointment->user_id !== null) {
        return response()->json(['error' => 'Appointment already booked'], 400);
    }

    $appointment->user_id = Auth::id();
    $appointment->save();

    return response()->json([
        'message' => 'Appointment booked successfully',
        'appointment' => $appointment,
    ], 200);
}


}
