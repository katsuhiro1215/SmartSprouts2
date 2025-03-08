<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FeeCategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    // Relationship
    public function feeAmounts()
    {
        return $this->hasMany(FeeAmount::class);
    }
}
