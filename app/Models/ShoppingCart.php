<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShoppingCart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id ',
        'product_option_id',
        'quantity',
    ];

    public function item()
    {
        // item of shopping cart has relationship with product option by product_options.id  
        return $this->hasOne(ProductOption::class, 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
