<?php

namespace App\Http\Controllers;

use App\Models\Sach;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // Hiện giỏ hàng
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = collect($cart)->sum(fn($item) => $item['gia_ban'] * $item['so_luong']);
        return view('cart.index', compact('cart', 'total'));
    }

    // Thêm sản phẩm vào giỏ
    public function add(Request $request, $id)
    {
        $sach = Sach::findOrFail($id);
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['so_luong'] += 1;
        } else {
            $cart[$id] = [
                'tieu_de'    => $sach->tieu_de,
                'gia_ban'    => $sach->gia_ban,
                'link_anh_bia' => $sach->link_anh_bia,
                'so_luong'   => 1,
            ];
        }

        session()->put('cart', $cart);
        return back()->with('success', 'Đã thêm vào giỏ hàng!');
    }

    // Cập nhật số lượng
    public function update(Request $request, $id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $qty = (int) $request->input('so_luong', 1);
            if ($qty <= 0) {
                unset($cart[$id]);
            } else {
                $cart[$id]['so_luong'] = $qty;
            }
            session()->put('cart', $cart);
        }

        return back()->with('success', 'Đã cập nhật giỏ hàng!');
    }

    // Xoá sản phẩm
    public function remove($id)
    {
        $cart = session()->get('cart', []);
        unset($cart[$id]);
        session()->put('cart', $cart);

        return back()->with('success', 'Đã xoá sản phẩm!');
    }
}