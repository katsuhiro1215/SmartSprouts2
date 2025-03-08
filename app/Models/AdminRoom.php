<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminRoom extends Model
{
    use HasFactory;

    protected $table = 'admin_room';

    protected $guarded = [];

    // Relationship
    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
    
    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
