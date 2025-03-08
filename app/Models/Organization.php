<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\BaseModel;

class Organization extends BaseModel
{
    use HasFactory;

    protected $guarded = [];

    public function welcomeSetting()
    {
        return $this->hasOne(WelcomeSetting::class);
    }

    public function stores()
    {
        return $this->hasMany(Store::class);
    }

    public function admins()
    {
        return $this->hasMany(Admin::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function schoolCategories()
    {
        return $this->hasMany(SchoolCategory::class);
    }

    public function events()
    {
        return $this->hasMany(Event::class);
    }

    public function NoificationCategories()
    {
        return $this->hasMany(NotificationCategory::class);
    }

    public function productBrands()
    {
        return $this->hasMany(ProductBrand::class);
    }

    public function productCategories()
    {
        return $this->hasMany(ProductCategory::class);
    }

    public function productImages()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function questionnaires()
    {
        return $this->hasMany(Questionnaire::class);
    }
}
