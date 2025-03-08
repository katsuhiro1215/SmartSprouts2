<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentEnrollmentGoal extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Relationship
    public function store()
    {
        return $this->belongsTo(Store::class);
    }
}
