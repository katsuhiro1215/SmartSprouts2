<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactReply extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Relationship
    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }
}
