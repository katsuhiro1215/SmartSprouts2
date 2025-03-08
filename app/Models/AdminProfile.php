<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\BaseModel;

class AdminProfile extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'admin_id',
    ];

    // Relationship
    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
}
