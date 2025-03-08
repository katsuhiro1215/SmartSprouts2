<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminSchedule extends Model
{
    use HasFactory;

    protected $table = 'admin_schedule';

    protected $guarded = [];

    // Relationship
    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }
}
