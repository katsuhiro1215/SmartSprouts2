<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\BaseModel;

class Store extends BaseModel
{
    use HasFactory, SoftDeletes;

    protected $table = 'stores';
    
    protected $guarded = [];

    // Relationships
    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function admins()
    {
        return $this->belongsToMany(Admin::class, 'admin_store');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'store_user');
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }

    public function courseCategories()
    {
        return $this->hasMany(CourseCategory::class);
    }

    // public function availabilities()
    // {
    //     return $this->hasMany(Availability::class);
    // }

    public function storeSchedules()
    {
        return $this->hasMany(StoreSchedule::class);
    }

    public function events()
    {
        return $this->belongsToMany(Event::class, 'event_store')->withPivot('id', 'status')->withTimestamps();
    }

    public function announcements()
    {
        return $this->hasMany(Announcement::class);
    }

    public function studentEnrollmentGoals()
    {
        return $this->hasMany(StudentEnrollmentGoal::class);
    }
}
