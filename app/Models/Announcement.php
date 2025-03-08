<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Relationship
    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'announcement_course')->withPivot('id')->withTimestamps();
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
