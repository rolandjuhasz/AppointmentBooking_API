<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
public function index() {
    $user = Auth::user();
    $appointments = Appointment::with(['creator', 'bookedBy', 'course'])
                               ->where('user_id', $user->id)
                               ->get();

    return response()->json($appointments);
}

    public function store(Request $request){
        $request->validate([
            'appointment_time' => 'required|date_format:Y-m-d',
            'course_id' => 'required|exists:courses,id', 
        ]);
    
        $user = Auth::user();
    

        $course = Course::where('id', $request->course_id)->where('user_id', $user->id)->first();
    
        if (!$course) {
            return response()->json(['error' => 'No course found or unauthorized'], 404);
        }
    
        if ($user->role !== 'expert') {
            return response()->json(['error' => 'Unauthorized to create appointment'], 403);
        }
    
        $appointment = new Appointment([
            'course_id' => $request->course_id,
            'appointment_time' => $request->appointment_time,
            'user_id' => null,
            'created_by_id' => $user->id,
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
        $user = Auth::user();
    

        if ($user->id === $appointment->user_id) {
            $appointment->update(['user_id' => null]);
            return response()->json(['message' => 'Your appointment booking has been canceled'], 200);
        }
    

        if ($user->id === $appointment->created_by_id) {
            $appointment->delete();
            return response()->json(['message' => 'Appointment has been deleted'], 200);
        }
    
        return response()->json(['error' => 'Unauthorized'], 403);
    }
    
    
    public function getAppointments($courseId) {
        $appointments = Appointment::with(['creator', 'bookedBy', 'course'])
                                    ->where('course_id', $courseId)
                                    ->get();
    
        return response()->json($appointments);
    }

    public function getAppointmentsForUser($userId)
    {
        $appointments = Appointment::where('user_id', $userId)
            ->with(['creator', 'bookedBy' , 'course'])
            ->get();
    
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
