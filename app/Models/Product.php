<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'description',
        'sub_category_id',
        'category_id'
    ];

    public function productoptions()
    {
        return $this->hasMany(ProductOption::class);
    }
    public function subcategory()
    {
        return $this->belongsTo(SubCategory::class);
    }
    public function productgalleries()
    {
        return $this->hasMany(ProductGallery::class);
    }
}
