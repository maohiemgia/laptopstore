<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name'
    ];

    // declare a protected $dates property to cast the deleted_at column to a Carbon instance.
    protected $dates = ['deleted_at'];

    public function subcategories(): HasMany
    {
        return $this->hasMany(SubCategory::class);
    }
    public function products()
    {
        return $this->hasManyThrough(Product::class, SubCategory::class);
    }
}
