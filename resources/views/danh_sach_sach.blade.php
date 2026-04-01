<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Book Store</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        body { background-color: #f5f5f5; }
        .navbar { background-color: #ff5850; }
        .navbar a { color: white !important; font-weight: bold; }
        footer { background: #222; color: white; padding: 15px; text-align: center; margin-top: 30px; }
        .card { height: 100%; }
        .card img { height: 200px; object-fit: cover; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg">
    <a class="navbar-brand" href="/">📚 Book Store</a>
    <div class="navbar-nav">
        <a class="nav-item nav-link" href="/sach">Sách</a>
        <a class="nav-item nav-link" href="/theloai">Thể loại</a>
    </div>
</nav>

<div class="container mt-4">

    <!-- Thể loại -->
    <div class="mb-3">
        <a href="/sach" class="btn btn-danger mr-2">Tất cả</a>
        @foreach($theloai as $tl)
            <a href="/theloai/{{ $tl->id }}" class="btn btn-outline-danger mr-2">{{ $tl->ten_the_loai }}</a>
        @endforeach
    </div>

    <!-- Tiêu đề -->
    <h4 class="mb-3">
        @isset($tentheloai)
            Thể loại: {{ $tentheloai->ten_the_loai }}
        @else
            Tất cả sách
        @endisset
    </h4>

    <!-- Danh sách sách -->
    <div class="row">
        @foreach($sach as $s)
        <div class="col-md-3 mb-4">
            <div class="card shadow-sm">
                <img src="{{ $s->link_anh_bia }}" class="card-img-top" alt="{{ $s->tieu_de }}">
                <div class="card-body">
                    <h6 class="card-title">{{ $s->tieu_de }}</h6>
                    <p class="text-muted">{{ $s->tac_gia }}</p>
                    <p class="text-danger font-weight-bold">{{ number_format($s->gia_ban) }} VNĐ</p>
                    <a href="/sach/{{ $s->id }}" class="btn btn-danger btn-sm btn-block">Xem chi tiết</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

</div>

<footer>
    © 2026 - Nhóm gồm 3 chàng trai
</footer>

</body>
</html>