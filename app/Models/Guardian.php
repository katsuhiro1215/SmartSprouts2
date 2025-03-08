<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\BaseModel;

class Guardian extends BaseModel
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    // Relationship
    public function user()
    {
        return $this->belongsToMany(User::class, 'guardian_user');
    }
}
