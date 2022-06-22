<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model 
{
    protected $fillable = [
        'title',
        'category_id',
		'brand_id',
        'slug',
        'description',
        'price',
        'sale_price',
		'size',
		'gender',
        'image',
        'active',
        'active_on_slider'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    } 

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    } 

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    } 
}