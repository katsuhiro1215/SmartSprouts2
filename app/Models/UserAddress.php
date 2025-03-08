<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\BaseModel;

class UserAddress extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'zipcode',
        'address1',
        'address2',
        'address3',
        'address4',
        'phone_number',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
