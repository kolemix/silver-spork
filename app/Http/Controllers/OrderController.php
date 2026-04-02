<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderConfirmationMail;

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
            'ho_ten'                 => 'required|string|max:100',
            'so_dien_thoai'          => 'required|string|max:20',
            'dia_chi'                => 'required|string|max:255',
            'ghi_chu'                => 'nullable|string|max:500',
            'phuong_thuc_thanh_toan' => 'required|string|in:momo,bank,cash',
        ]);

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng trống!');
        }

        $total = collect($cart)->sum(fn($item) => $item['gia_ban'] * $item['so_luong']);

        // Tạo đơn hàng và lưu chi tiết trong transaction
        $order = DB::transaction(function () use ($request, $cart, $total) {
            $order = Order::create([
                'total'                  => $total,
                'status'                 => 'pending',
                'ho_ten'                 => $request->ho_ten,
                'so_dien_thoai'          => $request->so_dien_thoai,
                'dia_chi'                => $request->dia_chi,
                'ghi_chu'                => $request->ghi_chu,
                'phuong_thuc_thanh_toan' => $request->phuong_thuc_thanh_toan,
            ]);

            foreach ($cart as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'ten_sach' => $item['tieu_de'],
                    'so_luong' => $item['so_luong'],
                    'don_gia'  => $item['gia_ban'],
                ]);
            }

            return $order;
        });

        // Xóa giỏ hàng
        session()->forget('cart');

        // Gửi email xác nhận đơn hàng
        $items = $order->items;
        $email = $request->user()->email;
        Mail::to($email)->send(new OrderConfirmationMail($order, $items));

        return redirect()->route('cart.index')->with('success', '✅ Đặt hàng thành công! Email xác nhận đã được gửi.');
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