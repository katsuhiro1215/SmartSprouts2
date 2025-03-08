<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Room extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    // Relationship
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }

    public function admins()
    {
        return $this->belongsToMany(Admin::class, 'admin_room')->withPivot('id')->withTimestamps();
    }

    public function students()
    {
        return $this->belongsToMany(Student::class, 'room_student')->withPivot('id')->withTimestamps();
    }
}
