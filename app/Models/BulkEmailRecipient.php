<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BulkEmailRecipient extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Relationship
    public function bulkEmail()
    {
        return $this->belongsTo(BulkEmail::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
