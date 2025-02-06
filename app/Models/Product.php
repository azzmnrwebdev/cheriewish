<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $fillable = [
        'name',
        'slug',
        'size',
        'price',
        'description',
        'url_shopee'
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_product', 'product_id', 'category_id')
            ->withTimestamps();
    }

    public function thumbnail()
    {
        return $this->hasOne(ProductImage::class, 'product_id')->where('is_thumbnail', true);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class, 'product_id');
    }

    public function imagesWithoutThumbnail()
    {
        return $this->hasMany(ProductImage::class, 'product_id')->where('is_thumbnail', false);
    }

    public function testimonies()
    {
        return $this->hasMany(Testimony::class, 'product_id');
    }
}
