<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    // Relationships
    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }

    public function courseCategory()
    {
        return $this->belongsTo(CourseCategory::class);
    }

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    // public function Availabilities()
    // {
    //     return $this->hasMany(Availability::class);
    // }

    public function schedules()
    {
        return $this->belongsToMany(Schedule::class, 'course_schedule')->withPivot('id', 'capacity', 'status')->withTimestamps();
    }

    public function admins()
    {
        return $this->belongsToMany(Admin::class, 'admin_course')->withPivot('id', 'position')->withTimestamps();
    }

    public function students()
    {
        return $this->belongsToMany(Student::class, 'course_student')->withPivot('id')->withTimestamps();
    }

    public function applications()
    {
        return $this->hasMany(Application::class)->withTrashed();
    }

    public function studentAttendances()
    {
        return $this->hasMany(StudentAttendance::class);
    }

    public function feeAmounts()
    {
        return $this->belongsToMany(FeeAmount::class, 'course_fee_amount');
    }

    public function announcements()
    {
        return $this->belongsToMany(Announcement::class, 'announcement_course')->withPivot('id')->withTimestamps();
    }

    // public function evaluations()
    // {
    //     return $this->hasMany(StudentEvaluation::class, 'course_id');
    // }
}
