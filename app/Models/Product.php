<?php

namespace App\Models;

use App\Models\Size;
use App\Models\Brand;
use App\Models\Color;
use App\Models\Category;
use App\Models\ProductImage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    /**
     * Get all of the sizes for the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sizes(){
        return $this->hasMany(Size::class, 'product_id', 'id');
    }

    public function colors(){
        return $this->hasMany(Color::class, 'product_id', 'id');
    }

    public function images(){
        return $this->hasMany(ProductImage::class, 'product_id', 'id');
    }

    /**
     * Get the categories that owns the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category(){
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function brand(){
        return $this->belongsTo(Brand::class, 'brand_id');
    }
}
