<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>📚 Book Store</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        * { box-sizing: border-box; }
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
        .navbar .dropdown-toggle { color: white !important; font-weight: 600; }
        .navbar .dropdown-menu {
            border: none;
            box-shadow: 0 4px 20px rgba(0,0,0,0.15);
            border-radius: 10px;
            min-width: 200px;
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

        /* HERO / FILTER BAR */
        .filter-bar {
            background: white;
            border-radius: 12px;
            padding: 16px 20px;
            margin-bottom: 24px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
        }
        .filter-bar .btn-outline-danger {
            border-radius: 20px;
            font-size: 0.85rem;
            margin: 3px;
        }
        .filter-bar .btn-danger {
            border-radius: 20px;
            font-size: 0.85rem;
            margin: 3px;
        }
        .filter-bar .btn {
            transition: all 0.25s ease;
        }
        .filter-bar .btn:hover {
            transform: translateY(-2px);
        }

        /* PAGE TITLE */
        .page-title {
            font-size: 1.3rem;
            font-weight: 700;
            color: #2c2c2c;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 3px solid #e74c3c;
            display: inline-block;
        }

        /* CARD */
.book-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.07);
            transition: transform 0.2s, box-shadow 0.2s;
            height: 100%;
            border: none;
        }
        .book-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 24px rgba(0,0,0,0.13);
        }
        .book-card img {
            height: 210px;
            width: 100%;
            object-fit: contain;   /* hiển thị full ảnh */
            background: #fff;      /* nền trắng cho đẹp */
        }

        .book-card .card-body { padding: 14px; }
        .book-card .card-title {
            font-size: 0.95rem;
            font-weight: 700;
            color: #222;
            margin-bottom: 4px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .book-card .author { font-size: 0.82rem; color: #888; margin-bottom: 8px; }
        .book-card .price {
            font-size: 1rem;
            font-weight: 800;
            color: #e74c3c;
            margin-bottom: 10px;
        }
        .btn-detail {
            background: linear-gradient(135deg, #e74c3c, #c0392b);
            color: white;
            border: none;
            border-radius: 8px;
            width: 100%;
            padding: 7px;
            font-size: 0.85rem;
            font-weight: 600;
            transition: opacity 0.2s;
        }
        .btn-detail:hover { opacity: 0.88; color: white; text-decoration: none; }

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
</nav>

<div class="container mt-4">

    {{-- BỘ LỌC THỂ LOẠI --}}
    <div class="filter-bar">
        {{-- TẤT CẢ --}}
        <a href="/sach"
        class="btn {{ request()->is('sach') ? 'btn-danger' : 'btn-outline-danger' }}">
            Tất cả
        </a>

        {{-- THỂ LOẠI --}}
        @foreach($theloai as $tl)
            <a href="/theloai/{{ $tl->id }}"
            class="btn {{ request()->is('theloai/'.$tl->id) ? 'btn-danger' : 'btn-outline-danger' }}">
                {{ $tl->ten_the_loai }}
            </a>
        @endforeach
    </div>


    {{-- TIÊU ĐỀ --}}
    <div class="page-title">
        @isset($tentheloai)
            📂 {{ $tentheloai->ten_the_loai }}
        @else
            📚 Tất cả sách
        @endisset
    </div>

    {{-- DANH SÁCH SÁCH --}}
    <div class="row">
        @forelse($sach as $s)
        <div class="col-6 col-md-3 mb-4">
            <div class="book-card">
                <img src="{{ $s->link_anh_bia }}" alt="{{ $s->tieu_de }}">
                <div class="card-body">
                    <div class="card-title">{{ $s->tieu_de }}</div>
                    <div class="author">✍️ {{ $s->tac_gia }}</div>
                    <div class="price">{{ number_format($s->gia_ban) }} VNĐ</div>
                    <a href="/sach/{{ $s->id }}" class="btn-detail">Xem chi tiết</a>
                </div>
            </div>
        </div>
        @empty
            <div class="col-12 text-center py-5 text-muted">
                <h5>Không có sách nào trong thể loại này.</h5>
            </div>
        @endforelse
    </div>

</div>

<footer>
    © 2026 — <span>Book Store</span> — Nhóm gồm 4 chàng trai 🎓
</footer>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
</body>
</html>