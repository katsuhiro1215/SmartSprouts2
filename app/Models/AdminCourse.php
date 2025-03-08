<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminCourse extends Model
{
    use HasFactory;

    protected $table = 'admin_course';

    protected $guarded = [];

    // Relationship
    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

}
