<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentLog extends Model
{
    use HasFactory;

    protected $table = 'payment_logs';

    protected $guarded = [];

    // Relationship
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function feeAmount()
    {
        return $this->belongsTo(FeeAmount::class);
    }
}
