<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChiTietDonHang extends Model
{
    protected $table = 'chi_tiet_don_hang';

    protected $fillable = [
        'don_hang_id',
        'sach_id',
        'so_luong',
        'don_gia',
    ];

    public function sach()
    {
        return $this->belongsTo(Sach::class, 'sach_id');
    }
}