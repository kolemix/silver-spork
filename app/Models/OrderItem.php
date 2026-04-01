<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id',
        'ten_sach',
        'so_luong',
        'don_gia'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}