<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function index()
    {
        return Course::with(['user', 'expert'])->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
        ]);
    
        if (Auth::user()->role !== 'expert') {
            return response()->json([
                'message' => 'Only experts can create courses.'
            ], 403);
        }
    
        $validated['user_id'] = Auth::id();
    
        $course = Course::create($validated);
        return response()->json([
            'message' => 'Course created successfully',
            'course' => $course,
        ], 201);
    }
    
    

    public function show(Course $course)
    {
        return response()->json($course->load('expert'), 200);
    }

    public function update(Request $request, Course $course)
    {
        if (Auth::id() !== $course->user_id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric|min:0',
        ]);

        $course->update($request->only(['title', 'description', 'price']));

        return response()->json($course, 200);
    }

    public function destroy(Course $course)
    {
        if (Auth::id() !== $course->user_id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $course->delete();

        return response()->json(['message' => 'Course deleted'], 200);
    }
}
