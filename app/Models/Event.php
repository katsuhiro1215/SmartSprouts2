<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    // 参加条件の定数
    const CONDITION_ALL = 'all';
    const CONDITION_MEMBERS_ONLY = 'members_only';
    const CONDITION_NON_MEMBERS_ONLY = 'non_members_only';

    // 条件を判別するメソッド (必要に応じて定義)
    public function isMembersOnly()
    {
        return $this->participation_condition === self::CONDITION_MEMBERS_ONLY;
    }

    public function isNonMembersOnly()
    {
        return $this->participation_condition === self::CONDITION_NON_MEMBERS_ONLY;
    }

    public function isForAll()
    {
        return $this->participation_condition === self::CONDITION_ALL;
    }

    // Relationship
    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function stores()
    {
        return $this->belongsToMany(Store::class, 'event_store')->withPivot('id', 'status')->withTimestamps();
    }

    public function schedules()
    {
        return $this->belongsToMany(Schedule::class, 'event_schedule')->withPivot('capacity', 'status')->withTimestamps();
    }

    public function students()
    {
        return $this->belongsToMany(Student::class, 'event_applications')->withPivot('application_date', 'cancel_date', 'status', 'remarks', 'is_paid')->withTimestamps();
    }

    public function announcements()
    {
        return $this->hasMany(Announcement::class);
    }

    public function eventApplications()
    {
        return $this->hasMany(EventApplication::class);
    }
}
