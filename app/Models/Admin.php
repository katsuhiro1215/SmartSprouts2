<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Notifications\AdminResetPassword as ResetPasswordNotification;

class Admin extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'username',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Role
    // Owner
    public function scopeOwners($query)
    {
        return $query->whereIn('role', ['Owner']);
    }

    // Admin (管理者)
    public function scopeAdmins($query)
    {
        return $query->whereIn('role', ['SuperAdmin', 'Admin', 'SubAdmin']);
    }

    // Employee (従業員)
    public function scopeEmployees($query)
    {
        return $query->whereIn('role', ['Manager', 'Employee', 'Contract', 'PartTime']);
    }

    // その他 (外部講師など)
    public function scopeOthers($query)
    {
        return $query->whereNotIn('role', ['Owner', 'SuperAdmin', 'Admin', 'SubAdmin','Manager', 'Employee', 'Contract', 'PartTime']);
    }

    // Password Reset
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    // Relationship
    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function adminProfile()
    {
        return $this->hasOne(AdminProfile::class);
    }

    public function adminEnrollment()
    {
        return $this->hasOne(AdminEnrollment::class);
    }

    public function adminAttendances()
    {
        return $this->hasMany(AdminAttendance::class);
    }

    public function stores()
    {
        return $this->belongsToMany(Store::class, 'admin_store')->withPivot('id', 'is_default')->withTimestamps();
    }
    
    public function lessons()
    {
        return $this->belongsToMany(Lesson::class, 'admin_lesson')->withPivot('id', 'position')->withTimestamps();
    }
    
    public function courses()
    {
        return $this->belongsToMany(Course::class, 'admin_course')->withPivot('id', 'position')->withTimestamps();
    }

    public function rooms()
    {
        return $this->belongsToMany(Room::class, 'admin_room')->withPivot('id', 'position')->withTimestamps();
    }

    public function schedules()
    {
        return $this->belongsToMany(Schedule::class)->withPivot('id')->withTimestamps();
    }
}
