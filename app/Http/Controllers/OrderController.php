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
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    // Trang checkout
    public function checkout()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng trống!');
        }

        $total = collect($cart)->sum(fn($item) => $item['gia_ban'] * $item['so_luong']);
        return view('orders.checkout', compact('cart', 'total'));
    }

    // Đặt hàng
    public function store(Request $request)
    {
        $request->validate([
            'ho_ten'        => 'required|string|max:100',
            'so_dien_thoai' => 'required|string|max:20',
            'dia_chi'       => 'required|string|max:255',
            'ghi_chu'       => 'nullable|string|max:500',
            'phuong_thuc_thanh_toan' => 'required|string|in:momo,bank,cash',
        ]);

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng trống!');
        }

        $total = collect($cart)->sum(fn($item) => $item['gia_ban'] * $item['so_luong']);

        // Tạo đơn hàng và lưu chi tiết
        $order = DB::transaction(function () use ($request, $cart, $total) {
            $order = Order::create([
                'total'         => $total,
                'status'        => 'pending',
                'ho_ten'        => $request->ho_ten,
                'so_dien_thoai' => $request->so_dien_thoai,
                'dia_chi'       => $request->dia_chi,
                'ghi_chu'       => $request->ghi_chu,
                'phuong_thuc_thanh_toan' => $request->phuong_thuc_thanh_toan,
            ]);

            foreach ($cart as $item) {
                OrderItem::create([
                    'order_id'  => $order->id,
                    'ten_sach'  => $item['tieu_de'],
                    'so_luong'  => $item['so_luong'],
                    'don_gia'   => $item['gia_ban'],
                ]);
            }

            return $order;
        });

        // Xóa giỏ hàng sau khi đã tạo đơn hàng
        session()->forget('cart');

        // Không cần lưu order vào session nữa
        // Redirect về giỏ hàng
        return redirect()->route('cart.index')->with('success', 'Đặt hàng thành công!');
    }

    // Danh sách đơn hàng
    public function index()
    {
        $orders = Order::latest()->paginate(10);
        return view('orders.index', compact('orders'));
    }

    // Chi tiết đơn hàng
    public function show(Order $order)
    {
        $order->load('items');
        return view('orders.show', compact('order'));
    }
}