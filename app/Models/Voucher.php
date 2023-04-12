<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'type_voucher',
        'value',
        'max_des_value',
        'description',
        'quantity',
        'count_use',
        'date_expired',
        'status'
    ];
}
