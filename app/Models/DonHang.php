<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DonHang extends Model
{
    protected $table = 'don_hang';

    protected $fillable = [
        'user_id',
        'ho_ten',
        'email',
        'so_dien_thoai',
        'dia_chi',
        'tong_tien',
        'trang_thai',
    ];

    public function chiTiet()
    {
        return $this->hasMany(ChiTietDonHang::class, 'don_hang_id');
    }
}