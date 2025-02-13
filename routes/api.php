<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\AppointmentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/courses', [CourseController::class, 'store']);  
    Route::put('/courses/{course}', [CourseController::class, 'update']); 
    Route::delete('/courses/{course}', [CourseController::class, 'destroy']);  

    Route::get('/courses/{courseId}/appointments', [AppointmentController::class, 'getAppointments']);

});

Route::get('/courses', [CourseController::class, 'index']);
Route::get('/courses/{course}', [CourseController::class, 'show']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/appointments', [AppointmentController::class, 'index']);  
    Route::post('/appointments', [AppointmentController::class, 'store']);   
    Route::get('/appointments/{appointment}', [AppointmentController::class, 'show']);  
    Route::delete('/appointments/{appointment}', [AppointmentController::class, 'destroy']); 
});
