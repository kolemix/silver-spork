<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <title>🛒 Giỏ hàng - Book Store</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        body { background-color: #f8f0eb; font-family: 'Segoe UI', sans-serif; }

        /* NAVBAR */
        .navbar {
            background: linear-gradient(135deg, #c0392b, #e74c3c);
            box-shadow: 0 2px 10px rgba(0,0,0,0.2);
            padding: 10px 20px;
        }
        .navbar-brand {
            font-size: 1.4rem;
            font-weight: 800;
            color: white !important;
            letter-spacing: 1px;
        }
        .navbar .nav-link {
            color: rgba(255,255,255,0.85) !important;
            font-weight: 500;
            transition: color 0.2s;
        }
        .navbar .nav-link:hover { color: white !important; }

        /* CART ITEM */
        .cart-item {
            background: #fff;
            border-radius: 12px;
            padding: 12px;
            margin-bottom: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }
        .cart-item img {
            width: 65px;
            height: 90px;
            object-fit: cover;
            border-radius: 8px;
            margin-right: 12px;
        }

        /* BUTTONS */
        .btn-danger {
            background: linear-gradient(135deg, #e74c3c, #c0392b);
            border: none;
            border-radius: 8px;
            font-weight: 600;
        }
        .btn-outline-danger {
            border-radius: 8px;
            font-weight: 600;
        }

        /* FOOTER */
        footer {
            background: #1a1a1a;
            color: #aaa;
            padding: 20px;
            text-align: center;
            margin-top: 40px;
            font-size: 0.9rem;
        }
        footer span { color: #e74c3c; }
    </style>
</head>
<body>

{{-- NAVBAR --}}
<nav class="navbar navbar-expand-lg">
    <a class="navbar-brand" href="/sach">📚 Book Store</a>
    <div class="navbar-nav mr-auto">
        <a class="nav-item nav-link" href="/sach">Tất cả sách</a>
        <a class="nav-item nav-link" href="/theloai">Thể loại</a>
    </div>
    <div class="navbar-nav ml-auto">
        <a class="nav-item nav-link" href="/cart">🛒 Giỏ hàng</a>
    </div>
</nav>

<div class="container mt-4">
    <h3 class="mb-4">🛒 Giỏ hàng của bạn</h3>

    @if(session('success'))
        <div class="alert alert-success d-flex align-items-center">
            ✅ <span class="ml-2">{{ session('success') }}</span>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger d-flex align-items-center">
            ⚠️ <span class="ml-2">{{ session('error') }}</span>
        </div>
    @endif

    @if(empty($cart))
        <div class="alert alert-warning d-flex justify-content-between align-items-center">
            <span>Giỏ hàng trống!</span>
            <a href="/sach" class="btn btn-sm btn-danger">Mua sắm ngay →</a>
        </div>
    @else
        @foreach($cart as $id => $item)
            <div class="cart-item d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <img src="{{ $item['link_anh_bia'] ?? $item['file_anh_bia'] ?? '' }}">
                    <div>
                        <strong>{{ $item['tieu_de'] }}</strong><br>
                        <small>Giá: {{ number_format($item['gia_ban']) }} VNĐ</small>
                    </div>
                </div>
                <div class="d-flex align-items-center">
                    <form action="{{ route('cart.update', $id) }}" method="POST" class="d-flex mr-2">
                        @csrf
                        @method('PATCH')
                        <input type="number" name="so_luong" value="{{ $item['so_luong'] }}" min="1"
                               class="form-control form-control-sm" style="width:70px">
                        <button class="btn btn-sm btn-outline-secondary ml-1">↻</button>
                    </form>
                    <span class="text-danger font-weight-bold mr-3">
                        {{ number_format($item['gia_ban'] * $item['so_luong']) }} VNĐ
                    </span>
                    <form action="{{ route('cart.remove', $id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">✖</button>
                    </form>
                </div>
            </div>
        @endforeach

        <div class="card shadow-sm mt-3">
            <div class="card-body d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Tổng cộng:</h5>
                <h5 class="mb-0 text-danger">{{ number_format($total) }} VNĐ</h5>
            </div>
        </div>

        <div class="text-right mt-3">
            <a href="/sach" class="btn btn-outline-danger mr-2">← Tiếp tục mua sắm</a>
            <a href="{{ route('checkout') }}" class="btn btn-danger">Đặt hàng →</a>
        </div>
    @endif
</div>

<footer>
    © 2026 — <span>Book Store</span> — Nhóm gồm 4 chàng trai 🎓
</footer>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
</body>
</html>