<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FeeAmount extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    // Relationship
    public function feeCategory()
    {
        return $this->belongsTo(FeeCategory::class);
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_fee_amount');
    }

    public function students()
    {
        return $this->belongsToMany(Student::class, 'payment_logs')->withPivot('id', 'payment_date', 'is_paid')->withTimestamps();
    }
}
