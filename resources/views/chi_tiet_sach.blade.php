<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $sach->tieu_de }}</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        body { background-color: #f5f5f5; }
        .navbar { background-color: #ff5850; }
        .navbar a { color: white !important; font-weight: bold; }
        footer { background: #222; color: white; padding: 15px; text-align: center; margin-top: 30px; }
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
    <div class="row">
        <div class="col-md-3">
            <img src="{{ $sach->link_anh_bia }}" 
                class="img-fluid" 
                alt="{{ $sach->tieu_de }}"
                style="border: 3px solid #ff5850; border-radius: 10px; box-shadow: 0 4px 15px rgba(0,0,0,0.2); padding: 5px; background: white;">
        </div>
        <div class="col-md-9">
            <h2>{{ $sach->tieu_de }}</h2>
            <p><b>Tác giả:</b> {{ $sach->tac_gia }}</p>
            <p><b>Nhà xuất bản:</b> {{ $sach->nha_xuat_ban }}</p>
            <p><b>Nhà cung cấp:</b> {{ $sach->nha_cung_cap }}</p>
            <p><b>Hình thức bìa:</b> {{ $sach->hinh_thuc_bia }}</p>
            <p><b>Giá bán:</b> {{ number_format($sach->gia_ban) }} VNĐ</p>
            <hr>
            <p><b>Mô tả:</b></p>
            <p>{{ $sach->mo_ta }}</p>
            <a href="/sach" class="btn btn-danger">← Quay lại danh sách</a>
        </div>
    </div>
</div>

<footer>
    © 2026 - Nhóm gồm 3 chàng trai
</footer>

</body>
</html>
