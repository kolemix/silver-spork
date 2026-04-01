<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <title>{{ $sach->tieu_de }} - 📚 Book Store</title>
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

        /* BOOK DETAIL */
        .book-img {
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.15);
            background: #fff;
            padding: 8px;
        }
        .book-info h2 {
            font-weight: 700;
            color: #2c2c2c;
            margin-bottom: 10px;
        }
        .book-info p { margin-bottom: 6px; }
        .book-info b { color: #c0392b; }
        .book-desc {
            background: #fff;
            border-radius: 12px;
            padding: 15px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            margin-top: 15px;
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
        @php
            $cartCount = collect(session()->get('cart', []))->sum('so_luong');
        @endphp
        <a class="nav-item nav-link" href="/cart">
            🛒 Giỏ hàng
            @if($cartCount > 0)
                <span class="badge badge-light">{{ $cartCount }}</span>
            @endif
        </a>
    </div>
</nav>

<div class="container mt-4">
    <div class="row">
        <!-- Ảnh sách -->
        <div class="col-md-4">
            <img src="{{ $sach->link_anh_bia }}" 
                 alt="{{ $sach->tieu_de }}" 
                 class="img-fluid book-img">
        </div>

        <!-- Thông tin sách -->
        <div class="col-md-8 book-info">
            <h2>{{ $sach->tieu_de }}</h2>
            <p><b>Tác giả:</b> {{ $sach->tac_gia }}</p>
            <p><b>Nhà xuất bản:</b> {{ $sach->nha_xuat_ban }}</p>
            <p><b>Nhà cung cấp:</b> {{ $sach->nha_cung_cap }}</p>
            <p><b>Hình thức bìa:</b> {{ $sach->hinh_thuc_bia }}</p>
            <p><b>Giá bán:</b> {{ number_format($sach->gia_ban) }} VNĐ</p>

            <form action="{{ route('cart.add', $sach->id) }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-danger">🛒 Thêm vào giỏ hàng</button>
            </form>
            <a href="/sach" class="btn btn-outline-danger ml-2">← Quay lại danh sách</a>

            <div class="book-desc mt-3">
                <p><b>Mô tả:</b></p>
                <p>{{ $sach->mo_ta }}</p>
            </div>
        </div>
    </div>
</div>

<footer>
    © 2026 — <span>Book Store</span> — Nhóm gồm 4 chàng trai 🎓
</footer>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
</body>
</html>