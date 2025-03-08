<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseFeeAmount extends Model
{
    use HasFactory;

    protected $table = 'course_fee_amount';

    protected $guarded = [];

    // Relationship
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function feeAmount()
    {
        return $this->belongsTo(FeeAmount::class);
    }
}
