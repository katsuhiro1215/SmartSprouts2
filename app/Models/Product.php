<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Relationship
    public function productBrand()
    {
        return $this->belongsTo(ProductBrand::class);
    }

    public function productSubCategory()
    {
        return $this->belongsTo(ProductSubCategory::class);
    }

    public function productImages()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function productVariants()
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function getTotalStockAttribute()
    {
        return $this->productVariants->sum(function ($productVariant) {
            return $productVariant->total_stock;
        });
    }
}
