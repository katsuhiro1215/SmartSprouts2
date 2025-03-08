<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\BaseModel;

class School extends BaseModel
{
    use HasFactory, SoftDeletes;

    protected $table = 'schools';
    
    protected $fillable = [
        'type',
        'name',
        'zipcode',
        'address1',
        'address2',
        'address3',
        'address4',
        'phone_number',
    ];

    public function students()
    {
        return $this->belongsToMany(Student::class, 'school_student')->withTimestamps();
    }

    public function scopeSearchSchools($query, $input = null)
    {
        if (!empty($input)) {
            return $query->where('name', 'like', '%' . $input . '%');
        }
        return $query;
    }
}
