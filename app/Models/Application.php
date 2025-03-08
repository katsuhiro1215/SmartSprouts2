<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Relationship
    public function student()
    {
        return $this->belongsTo(Student::class)->withTrashed();
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
