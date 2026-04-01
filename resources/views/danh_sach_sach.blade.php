<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>📚 Book Store</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        body { background-color: #f5f5f5; }
        .navbar { background-color: #ff5850; }
        .navbar a { color: white !important; font-weight: bold; }
        footer { background: #222; color: white; padding: 15px; text-align: center; margin-top: 30px; }
        .card img { height: 200px; object-fit: cover; }
    </style>
</head>
<body>

{{-- NAVBAR --}}
<nav class="navbar navbar-expand-lg">
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
</nav>

<div class="container mt-4">
    <!-- Nút thể loại -->
    <div class="mb-3">
        <button class="btn btn-danger mr-2" onclick="loadSach(0)">Tất cả</button>
        @foreach($theloai as $tl)
            <button class="btn btn-outline-danger mr-2" onclick="loadSach({{ $tl->id }})">
                {{ $tl->ten_the_loai }}
            </button>
        @endforeach
    </div>

    <!-- Danh sách sách -->
    <div class="row" id="danh-sach-sach">
        @foreach($sach as $s)
        <div class="col-md-3 mb-4">
            <div class="card shadow-sm">
                <img src="{{ $s->link_anh_bia }}" class="card-img-top">
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

<footer>© 2026 - Nhóm gồm 3 chàng trai</footer>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
function loadSach(theloaiId) {
    if (theloaiId == 0) {
        location.reload();
        return;
    }

    $.ajax({
        url: '/api/sach-theo-theloai/' + theloaiId,
        method: 'GET',
        success: function(data) {
            let html = '';
            data.forEach(function(s) {
                html += `
                <div class="col-md-3 mb-4">
                    <div class="card shadow-sm">
                        <img src="${s.link_anh_bia}" class="card-img-top" style="height:200px;object-fit:cover;">
                        <div class="card-body">
                            <h6 class="card-title">${s.tieu_de}</h6>
                            <p class="text-muted">${s.tac_gia}</p>
                            <p class="text-danger font-weight-bold">${Number(s.gia_ban).toLocaleString()} VNĐ</p>
                            <a href="/sach/${s.id}" class="btn btn-danger btn-sm btn-block">Xem chi tiết</a>
                        </div>
                    </div>
                </div>`;
            });
            $('#danh-sach-sach').html(html);
        }
    });
}
</script>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
</body>
</html>
```

---

### 3. Kiểm tra:
```
http://127.0.0.1:8000/sach