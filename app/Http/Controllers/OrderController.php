<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DonHang;
use App\Models\ChiTietDonHang;
use App\Mail\DonHangMail;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        // Lưu đơn hàng
        $donHang = DonHang::create([
            'user_id'       => auth()->id(),
            'ho_ten'        => $request->ho_ten,
            'email'         => $request->email,
            'so_dien_thoai' => $request->so_dien_thoai,
            'dia_chi'       => $request->dia_chi,
            'tong_tien'     => $request->tong_tien,
            'trang_thai'    => 'cho_xac_nhan',
        ]);

        // Lưu chi tiết đơn hàng
        foreach ($request->san_pham as $sp) {
            ChiTietDonHang::create([
                'don_hang_id' => $donHang->id,
                'sach_id'     => $sp['id'],
                'so_luong'    => $sp['so_luong'],
                'don_gia'     => $sp['don_gia'],
            ]);
        }

        // Gửi email xác nhận
        Mail::to($donHang->email)->send(new DonHangMail($donHang));

        return redirect()->route('order.success')->with('success', 'Đặt hàng thành công!');
    }

    public function success()
    {
        return view('orders.success');
    }
}