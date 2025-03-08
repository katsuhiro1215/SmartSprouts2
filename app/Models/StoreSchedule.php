<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreSchedule extends Model
{
    use HasFactory;

    protected $table = 'store_schedules';
    
    protected $guarded = [];

    // Relationship
    public function store()
    {
        return $this->belongsTo(Store::class);
    }
}
