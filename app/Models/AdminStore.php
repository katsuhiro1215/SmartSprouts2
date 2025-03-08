<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminStore extends Model
{
    use HasFactory;

    protected $table = 'admin_store';

    protected $guarded = [];

    // Relationship
    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }
}
