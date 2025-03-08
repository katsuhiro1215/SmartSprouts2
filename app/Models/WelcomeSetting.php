<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WelcomeSetting extends Model
{
    use HasFactory;

    protected $table = 'welcome_settings';

    protected $guarded = [];

    // Relationship
    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }
}
