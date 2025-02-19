<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = ['created_by_id', 'user_id', 'course_id', 'appointment_time'];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    public function bookedBy()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}

