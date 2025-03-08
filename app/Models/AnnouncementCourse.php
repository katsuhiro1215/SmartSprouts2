<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnnouncementCourse extends Model
{
    use HasFactory;

    protected $table = 'announcement_course';

    protected $guarded = [];

    // Relationship
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function announcement()
    {
        return $this->belongsTo(Announcement::class);
    }
}
