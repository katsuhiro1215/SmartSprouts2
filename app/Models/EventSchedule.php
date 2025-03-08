<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventSchedule extends Model
{
    use HasFactory;

    protected $table = 'event_schedule';

    protected $guarded = [];

    // Relationship
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }
}
