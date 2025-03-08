<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankTransfer extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Relationship
    public function student()
    {
        return $this->belongsTo(Student::class, 'member_id', 'serial_no');
    }
}
