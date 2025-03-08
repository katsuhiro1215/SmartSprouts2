<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminLesson extends Model
{
    use HasFactory;

    protected $table = 'admin_lesson';

    protected $guarded = [];

    // Relationship
    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function lesson()
    {
        return $this->belongsTo(Course::class);
    }
}
