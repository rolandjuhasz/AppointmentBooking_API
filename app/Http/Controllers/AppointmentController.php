<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    public function index()
    {
        return Appointment::with(['user', 'course'])->where('user_id', Auth::id())->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'appointment_time' => 'required|date|after:now',
        ]);

        $course = Course::findOrFail($request->course_id);

        if (Auth::id() === $course->user_id) {
            return response()->json(['error' => 'You cannot book your own course'], 403);
        }

        $appointment = Appointment::create([
            'user_id' => Auth::id(),
            'course_id' => $request->course_id,
            'appointment_time' => $request->appointment_time,
        ]);

        return response()->json($appointment, 201);
    }

    public function show(Appointment $appointment)
    {
        if (Auth::id() !== $appointment->user_id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        return response()->json($appointment->load(['user', 'course']), 200);
    }

    public function destroy(Appointment $appointment)
    {
        if (Auth::id() !== $appointment->user_id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $appointment->delete();

        return response()->json(['message' => 'Appointment canceled'], 200);
    }
}
