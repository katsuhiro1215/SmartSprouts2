<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventStore extends Model
{
    use HasFactory;

    protected $table = 'event_store';

    protected $guarded = [];

    // Relationship
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }
}
