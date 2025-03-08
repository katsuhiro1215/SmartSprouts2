<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lesson extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    // Relationship
    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function courseCategories()
    {
        return $this->hasMany(CourseCategory::class);
    }

    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    public function admins()
    {
        return $this->belongsToMany(Admin::class, 'admin_lesson')->withPivot('id', 'position')->withTimestamps();
    }

    public function students()
    {
        return $this->belongsToMany(Student::class, 'lesson_student')->withPivot('id')->withTimestamps();
    }
}
