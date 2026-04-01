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
        .navbar-brand { font-size: 1.4rem; font-weight: 800; color: white !important; }
        .navbar .nav-link { color: rgba(255,255,255,0.85) !important; font-weight: 500; }
        .navbar .nav-link:hover { color: white !important; }
        .navbar .dropdown-toggle { color: white !important; font-weight: 600; }
        .navbar .dropdown-menu {
            border: none;
            box-shadow: 0 4px 20px rgba(0,0,0,0.15);
            border-radius: 10px;
        }
        .navbar .dropdown-item { padding: 10px 20px; font-size: 0.9rem; }
        .navbar .dropdown-item:hover { background: #fff0ee; color: #c0392b; }
        .btn-auth {
            border: 2px solid white;
            color: white !important;
            border-radius: 20px;
            padding: 5px 16px;
            font-weight: 600;
            font-size: 0.85rem;
            margin-left: 6px;
            transition: all 0.2s;
        }
        .btn-auth:hover { background: white; color: #c0392b !important; text-decoration: none; }
        .btn-auth.filled { background: white; color: #c0392b !important; }
        .btn-auth.filled:hover { background: transparent; color: white !important; }

        /* BREADCRUMB */
        .breadcrumb {
            background: transparent;
            padding: 12px 0 0 0;
            font-size: 0.85rem;
        }
        .breadcrumb-item a { color: #e74c3c; }
        .breadcrumb-item.active { color: #666; }

        /* DETAIL CARD */
        .detail-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            padding: 30px;
            margin-top: 10px;
        }
        .book-cover {
            width: 100%;
            border-radius: 12px;
            box-shadow: 0 6px 20px rgba(0,0,0,0.15);
            border: 3px solid #e74c3c;
            padding: 5px;
            background: white;
        }
        .book-title {
            font-size: 1.7rem;
            font-weight: 800;
            color: #1a1a1a;
            margin-bottom: 16px;
            line-height: 1.3;
        }
        .info-row {
            display: flex;
            align-items: flex-start;
            margin-bottom: 10px;
            font-size: 0.95rem;
        }
        .info-label {
            font-weight: 700;
            color: #555;
            min-width: 150px;
        }
        .info-value { color: #222; }
        .price-box {
            background: linear-gradient(135deg, #fff0ee, #ffe4e1);
            border: 2px solid #e74c3c;
            border-radius: 10px;
            padding: 14px 20px;
            margin: 20px 0;
            display: inline-block;
        }
        .price-box .price-label { font-size: 0.85rem; color: #888; margin-bottom: 2px; }
        .price-box .price-value {
            font-size: 1.8rem;
            font-weight: 900;
            color: #e74c3c;
        }
        .desc-box {
            background: #fafafa;
            border-left: 4px solid #e74c3c;
            border-radius: 6px;
            padding: 16px 20px;
            margin-top: 20px;
            font-size: 0.95rem;
            line-height: 1.7;
            color: #444;
        }
        .desc-box h6 {
            font-weight: 700;
            color: #c0392b;
            margin-bottom: 10px;
        }
        .btn-back {
            background: linear-gradient(135deg, #e74c3c, #c0392b);
            color: white;
            border: none;
            border-radius: 10px;
            padding: 10px 24px;
            font-weight: 600;
            font-size: 0.95rem;
            margin-top: 20px;
            display: inline-block;
            transition: opacity 0.2s;
        }
        .btn-back:hover { opacity: 0.85; color: white; text-decoration: none; }

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
    <a class="navbar-brand" href="/">📚 Book Store</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navMenu">
        <span style="color:white; font-size:1.4rem;">☰</span>
    </button>
    <div class="collapse navbar-collapse" id="navMenu">
        <div class="navbar-nav mr-auto">
            <a class="nav-item nav-link" href="/sach">Tất cả sách</a>
        </div>
        <div class="navbar-nav ml-auto align-items-center">
            @auth
                <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        👤 {{ Auth::user()->name }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="{{ route('profile.edit') }}">
                            ⚙️ Cập nhật thông tin
                        </a>
                        <div class="dropdown-divider"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="dropdown-item text-danger" type="submit">
                                🚪 Đăng xuất
                            </button>
                        </form>
                    </div>
                </div>
            @else
                <a class="btn-auth" href="{{ route('login') }}">Đăng nhập</a>
                <a class="btn-auth filled" href="{{ route('register') }}">Đăng ký</a>
            @endauth
        </div>
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
<div class="container">
    {{-- BREADCRUMB --}}
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
            <li class="breadcrumb-item"><a href="/sach">Sách</a></li>
            <li class="breadcrumb-item active">{{ $sach->tieu_de }}</li>
        </ol>
    </nav>

    {{-- CHI TIẾT SÁCH --}}
    <div class="detail-card">
        <div class="row">
            {{-- ẢNH BÌA --}}
            <div class="col-md-3 mb-4 mb-md-0 text-center">
                <img src="{{ $sach->link_anh_bia }}"
                     class="book-cover"
                     alt="{{ $sach->tieu_de }}">
            </div>

            {{-- THÔNG TIN --}}
            <div class="col-md-9">
                <h1 class="book-title">{{ $sach->tieu_de }}</h1>

                <div class="info-row">
                    <span class="info-label">✍️ Tác giả</span>
                    <span class="info-value">{{ $sach->tac_gia }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">🏢 Nhà xuất bản</span>
                    <span class="info-value">{{ $sach->nha_xuat_ban }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">🚚 Nhà cung cấp</span>
                    <span class="info-value">{{ $sach->nha_cung_cap }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">📖 Hình thức bìa</span>
                    <span class="info-value">{{ $sach->hinh_thuc_bia }}</span>
                </div>

                <div class="price-box">
                    <div class="price-label">Giá bán</div>
                    <div class="price-value">{{ number_format($sach->gia_ban) }} VNĐ</div>
                </div>

                @if(!empty($sach->mo_ta))
                <div class="desc-box">
                    <h6>📝 Mô tả</h6>
                    {{ $sach->mo_ta }}
                </div>
                @endif

                <a href="/sach" class="btn-back">← Quay lại danh sách</a>
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