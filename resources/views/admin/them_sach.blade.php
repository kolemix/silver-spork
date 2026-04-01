<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <title>Thêm sách</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        * { box-sizing: border-box; }
        body { background-color: #f8f0eb; font-family: 'Segoe UI', sans-serif; }
        .navbar { background: linear-gradient(135deg, #c0392b, #e74c3c); box-shadow: 0 2px 10px rgba(0,0,0,0.2); padding: 10px 20px; }
        .navbar-brand { font-size: 1.4rem; font-weight: 800; color: white !important; }
        .navbar .nav-link { color: rgba(255,255,255,0.85) !important; font-weight: 500; }
        .page-title { font-size: 1.3rem; font-weight: 700; color: #2c2c2c; margin-bottom: 20px; padding-bottom: 10px; border-bottom: 3px solid #e74c3c; display: inline-block; }
        .form-card { background: white; border-radius: 12px; padding: 30px; box-shadow: 0 2px 10px rgba(0,0,0,0.07); }
        .form-control:focus { border-color: #e74c3c; box-shadow: 0 0 0 0.2rem rgba(231,76,60,0.25); }
        .btn-danger { border-radius: 20px; padding: 8px 24px; }
        .btn-secondary { border-radius: 20px; padding: 8px 24px; }
        footer { background: #1a1a1a; color: #aaa; padding: 20px; text-align: center; margin-top: 40px; font-size: 0.9rem; }
        footer span { color: #e74c3c; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg">
    <a class="navbar-brand" href="/">📚 Book Store</a>
    <div class="navbar-nav ml-auto">
        <a class="nav-item nav-link" href="/sach">Tất cả sách</a>
        <a class="nav-item nav-link" href="/admin/sach">Quản lý sách</a>
    </div>
</nav>

<div class="container mt-4">
    <div class="page-title">➕ Thêm sách mới</div>

    <div class="form-card">
        <form method="POST" action="/admin/sach/them">
            @csrf
            <div class="form-group">
                <label>📖 Tên sách</label>
                <input type="text" name="tieu_de" class="form-control" required>
            </div>
            <div class="form-group">
                <label>✍️ Tác giả</label>
                <input type="text" name="tac_gia" class="form-control">
            </div>
            <div class="form-group">
                <label>🏢 Nhà xuất bản</label>
                <input type="text" name="nha_xuat_ban" class="form-control">
            </div>
            <div class="form-group">
                <label>🏪 Nhà cung cấp</label>
                <input type="text" name="nha_cung_cap" class="form-control">
            </div>
            <div class="form-group">
                <label>📦 Hình thức bìa</label>
                <input type="text" name="hinh_thuc_bia" class="form-control">
            </div>
            <div class="form-group">
                <label>📝 Mô tả</label>
                <textarea name="mo_ta" class="form-control" rows="3"></textarea>
            </div>
            <div class="form-group">
                <label>🖼️ Link ảnh bìa</label>
                <input type="text" name="link_anh_bia" class="form-control">
            </div>
            <div class="form-group">
                <label>💰 Giá bán</label>
                <input type="number" name="gia_ban" class="form-control" required>
            </div>
            <div class="form-group">
                <label>📂 Thể loại</label>
                <select name="the_loai" class="form-control">
                    @foreach($theloai as $tl)
                        <option value="{{ $tl->id }}">{{ $tl->ten_the_loai }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-danger">➕ Thêm sách</button>
            <a href="/admin/sach" class="btn btn-secondary ml-2">← Quay lại</a>
        </form>
    </div>
</div>

<footer>© 2026 — <span>Book Store</span> — Nhóm gồm 4 chàng trai 🎓</footer>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
</body>
</html>