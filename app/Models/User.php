<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;
use App\Notifications\UserResetPassword as ResetPasswordNotification;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'username',
        'email',
        'password',
        'google_id',
        'provider',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Role
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    public function isOnline()
    {
        return $this->login_at && !$this->logout_at;
    }

    // Scope
    public function scopeSearchUsers($query, $input = null)
    {
        if (!empty($input)) {
            return $query->where('name', 'like', '%' . $input . '%');
        }
        return $query;
    }

    // Relationship
    public function userAddresses()
    {
        return $this->hasMany(UserAddress::class);
    }

    public function stores()
    {
        return $this->belongsToMany(Store::class, 'store_user');
    }
    
    public function students()
    {
        return $this->belongsToMany(Student::class, 'student_user');
    }

    public function guardians()
    {
        return $this->belongsToMany(Guardian::class, 'guardian_user');
    }

    public function orders()
    {
        return $this->hasMany(Order::class)->withTrashed();
    }

    public function bulkEmailRecipient()
    {
        return $this->hasOne(BulkEmailRecipient::class);
    }

    public function responses()
    {
        return $this->hasMany(Response::class);
    }
}
