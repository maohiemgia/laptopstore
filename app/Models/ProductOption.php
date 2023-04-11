<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductOption extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'quantity',
        'price',
        'status',
        'discount_value',
        'screen',
        'cpu',
        'gpu',
        'ram',
        'memory',
        'battery',
        'size',
        'weight',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function shoppingCart()
    {
        return $this->belongsTo(ShoppingCart::class, 'product_option_id');
    }
}
