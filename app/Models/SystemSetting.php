<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SystemSetting extends Model
{
    use HasFactory;

    protected $table = 'system_settings';

    protected $guarded = [];

    // Relationship
    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
}
