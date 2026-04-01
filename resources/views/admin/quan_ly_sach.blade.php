<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Quản lý sách</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        * { box-sizing: border-box; }
        body { background-color: #f8f0eb; font-family: 'Segoe UI', sans-serif; }
        .navbar {
            background: linear-gradient(135deg, #c0392b, #e74c3c);
            box-shadow: 0 2px 10px rgba(0,0,0,0.2);
            padding: 10px 20px;
        }
        .navbar-brand { font-size: 1.4rem; font-weight: 800; color: white !important; }
        .navbar .nav-link { color: rgba(255,255,255,0.85) !important; font-weight: 500; }
        .navbar .nav-link:hover { color: white !important; }
        .navbar .dropdown-toggle { color: white !important; font-weight: 600; }
        .navbar .dropdown-menu { border: none; box-shadow: 0 4px 20px rgba(0,0,0,0.15); border-radius: 10px; }
        .navbar .dropdown-item:hover { background: #fff0ee; color: #c0392b; }
        .btn-auth { border: 2px solid white; color: white !important; border-radius: 20px; padding: 5px 16px; font-weight: 600; font-size: 0.85rem; margin-left: 6px; transition: all 0.2s; }
        .btn-auth:hover { background: white; color: #c0392b !important; text-decoration: none; }
        .btn-auth.filled { background: white; color: #c0392b !important; }
        .page-title { font-size: 1.3rem; font-weight: 700; color: #2c2c2c; margin-bottom: 20px; padding-bottom: 10px; border-bottom: 3px solid #e74c3c; display: inline-block; }
        .admin-card { background: white; border-radius: 12px; padding: 24px; box-shadow: 0 2px 10px rgba(0,0,0,0.07); }
        .table thead th { background: linear-gradient(135deg, #c0392b, #e74c3c); color: white; cursor: pointer; user-select: none; }
        .table thead th:hover { opacity: 0.9; }
        .search-box { border-radius: 20px; border: 2px solid #e74c3c; padding: 8px 16px; }
        .search-box:focus { box-shadow: 0 0 0 0.2rem rgba(231,76,60,0.25); border-color: #e74c3c; outline: none; }
        footer { background: #1a1a1a; color: #aaa; padding: 20px; text-align: center; margin-top: 40px; font-size: 0.9rem; }
        footer span { color: #e74c3c; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg">
    <a class="navbar-brand" href="/">📚 Book Store</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navMenu">
        <span style="color:white; font-size:1.4rem;">☰</span>
    </button>
    <div class="collapse navbar-collapse" id="navMenu">
        <div class="navbar-nav mr-auto">
            <a class="nav-item nav-link" href="/sach">Tất cả sách</a>
            <a class="nav-item nav-link" href="/admin/sach">Quản lý sách</a>
        </div>
        <div class="navbar-nav ml-auto align-items-center">
            @auth
                <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        👤 {{ Auth::user()->name }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
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
    <div class="page-title">🛠️ Quản lý sách</div>

    <div class="admin-card">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <input type="text" id="timKiem" class="form-control search-box w-50" placeholder="🔍 Tìm kiếm theo tên sách hoặc tác giả...">
            <a href="/admin/sach/them" class="btn btn-danger" style="border-radius:20px;">
                <i class="fa fa-plus"></i> Thêm sách
            </a>
        </div>

        <table class="table table-hover" id="bangSach">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Ảnh</th>
                    <th onclick="sapXep(2)">Tên sách <i class="fa fa-sort" id="icon_2"></i></th>
                    <th onclick="sapXep(3)">Tác giả <i class="fa fa-sort" id="icon_3"></i></th>
                    <th onclick="sapXep(4)">Giá bán <i class="fa fa-sort" id="icon_4"></i></th>
                    <th onclick="sapXep(5)">Thể loại <i class="fa fa-sort" id="icon_5"></i></th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody id="danhSachSach">
                @foreach($sach as $s)
                <tr>
                    <td>{{ $s->id }}</td>
                    <td><img src="{{ $s->link_anh_bia }}" width="60" style="border-radius:8px;"></td>
                    <td>{{ $s->tieu_de }}</td>
                    <td>{{ $s->tac_gia }}</td>
                    <td>{{ number_format($s->gia_ban) }} VNĐ</td>
                    <td>{{ $s->ten_the_loai }}</td>
                    <td>
                        <a href="/admin/sach/sua/{{ $s->id }}" class="btn btn-warning btn-sm">
                            <i class="fa fa-edit"></i> Sửa
                        </a>
                        <a href="/admin/sach/xoa/{{ $s->id }}" class="btn btn-danger btn-sm"
                           onclick="return confirm('Bạn có chắc muốn xóa?')">
                            <i class="fa fa-trash"></i> Xóa
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<footer>© 2026 — <span>Book Store</span> — Nhóm gồm 4 chàng trai 🎓</footer>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$('#timKiem').on('keyup', function() {
    let tuKhoa = $(this).val().toLowerCase();
    $('#danhSachSach tr').filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(tuKhoa) > -1);
    });
});

let trangThai = {};
function sapXep(index) {
    if (!trangThai[index] || trangThai[index] === 'default') {
        trangThai[index] = 'asc';
    } else if (trangThai[index] === 'asc') {
        trangThai[index] = 'desc';
    } else {
        trangThai[index] = 'default';
    }

    [2,3,4,5].forEach(function(i) {
        $('#icon_' + i).removeClass('fa-sort-asc fa-sort-desc').addClass('fa-sort');
    });

    if (trangThai[index] === 'default') { location.reload(); return; }
    if (trangThai[index] === 'asc') {
        $('#icon_' + index).removeClass('fa-sort').addClass('fa-sort-asc');
    } else {
        $('#icon_' + index).removeClass('fa-sort').addClass('fa-sort-desc');
    }

    let rows = $('#danhSachSach tr').toArray();
    rows.sort(function(a, b) {
        let valA = $(a).find('td').eq(index).text().trim();
        let valB = $(b).find('td').eq(index).text().trim();
        if (index === 4) {
            valA = parseInt(valA.replace(/[^0-9]/g, ''));
            valB = parseInt(valB.replace(/[^0-9]/g, ''));
            return trangThai[index] === 'asc' ? valA - valB : valB - valA;
        }
        return trangThai[index] === 'asc'
            ? valA.localeCompare(valB, 'vi')
            : valB.localeCompare(valA, 'vi');
    });
    $('#danhSachSach').empty().append(rows);
}
</script>
</body>
</html>