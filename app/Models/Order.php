<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'customer_name',
        'customer_email',
        'customer_address',
        'customer_phone_number',
        'tax_fee',
        'shipping_fee',
        'payment_type',
        'total_cost',
        'discount_value',
        'note',
        'date_receive',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function detail()
    {
        return $this->hasMany(OrderDetail::class);
    }
    public function orderdetails()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
