<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sach extends Model
{
    protected $table = 'sach';

    protected $fillable = [
        'tieu_de',
        'nha_cung_cap',
        'nha_xuat_ban',
        'tac_gia',
        'hinh_thuc_bia',
        'mo_ta',
        'file_anh_bia',
        'link_anh_bia',
        'gia_ban',
        'the_loai'
    ];
}