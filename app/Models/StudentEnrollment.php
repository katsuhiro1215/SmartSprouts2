<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentEnrollment extends Model
{
    use HasFactory;

    protected $table = 'student_enrollments';

    protected $guarded = [];

    // Relationship
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    // Accessors & Mutators
    public function getSelectedDaysAttribute($value)
    {
        return explode(', ', $value);
    }

    public function setSelectedDaysAttribute($value)
    {
        $this->attributes['selected_days'] = implode(', ', (array) $value);
    }
}
