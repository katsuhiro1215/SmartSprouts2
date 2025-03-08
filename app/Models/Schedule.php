<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Carbon\Carbon;

class Schedule extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    // Accessor
    protected function eventDate(): Attribute
    {
        return new Attribute(
            get: fn() => Carbon::parse($this->start_date)->format('Y年m月d日')
        );
    }

    protected function startTime(): Attribute
    {
        return new Attribute(
            get: fn() => Carbon::parse($this->start_date)->format('H時i分')
        );
    }

    protected function endTime(): Attribute
    {
        return new Attribute(
            get: fn() => Carbon::parse($this->end_date)->format('H時i分')
        );
    }

    // Relationship
    public function stores()
    {
        return $this->belongsToMany(Store::class, 'schedule_store')->withPivot('id')->withTimestamps();
    }

    public function events()
    {
        return $this->belongsToMany(Event::class, 'event_schedule')->withPivot('capacity', 'status')->withTimestamps();
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_schedule')->whereNull('courses.deleted_at')->withPivot('id', 'capacity', 'status')->withTimestamps();
    }

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    public function admins()
    {
        return $this->belongsToMany(Admin::class, 'admin_schedule')->withPivot('id')->withTimestamps();
    }

    public function students()
    {
        return $this->belongsToMany(Student::class, 'schedule_student')->withPivot('id', 'student_id', 'schedule_id')->withTimestamps();
    }

    public function studentAttendances()
    {
        return $this->hasMany(StudentAttendance::class, 'schedule_id');
    }
}
