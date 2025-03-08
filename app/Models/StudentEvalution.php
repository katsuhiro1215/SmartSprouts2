<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentEvalution extends Model
{
    use HasFactory;

    protected $table = 'student_evalutions';

    protected $guarded = [];

    // Relationship
    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
}
