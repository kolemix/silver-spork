<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <title>📦 Đặt hàng - Book Store</title>
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

        /* CARD */
        .card {
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }
        .card-title {
            font-weight: 700;
            color: #2c2c2c;
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
        <a class="nav-item nav-link" href="/cart">🛒 Giỏ hàng</a>
    </div>
</nav>

<div class="container mt-4">
    <h4 class="mb-4">📦 Thông tin đặt hàng</h4>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row">
        <!-- Form thông tin -->
        <div class="col-md-7">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title mb-3">Thông tin nhận hàng</h5>

                    <form action="{{ route('orders.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Họ tên</label>
                            <input type="text" name="ho_ten" class="form-control" value="{{ old('ho_ten') }}" required>
                        </div>
                        <div class="form-group">
                            <label>Số điện thoại</label>
                            <input type="text" name="so_dien_thoai" class="form-control" value="{{ old('so_dien_thoai') }}" required>
                        </div>
                        <div class="form-group">
                            <label>Địa chỉ</label>
                            <input type="text" name="dia_chi" class="form-control" value="{{ old('dia_chi') }}" required>
                        </div>
                        <div class="form-group">
                            <label>Ghi chú</label>
                            <textarea name="ghi_chu" class="form-control" rows="3">{{ old('ghi_chu') }}</textarea>
                        </div>

                        <!-- Phương thức thanh toán -->
                        <h5 class="mt-4">Phương thức thanh toán</h5>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="phuong_thuc_thanh_toan" value="momo" checked>
                            <label class="form-check-label">Ví MoMo</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="phuong_thuc_thanh_toan" value="bank">
                            <label class="form-check-label">Ngân hàng (ATM/Internet Banking)</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="phuong_thuc_thanh_toan" value="cash">
                            <label class="form-check-label">Thanh toán khi nhận hàng (Tiền mặt)</label>
                        </div>

                        <button type="submit" class="btn btn-danger btn-block mt-3">Xác nhận đặt hàng</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Tóm tắt đơn hàng -->
        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-3">Đơn hàng của bạn</h5>
                    @foreach($cart as $item)
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <div class="d-flex align-items-center">
                                <img src="{{ $item['link_anh_bia'] ?? $item['file_anh_bia'] ?? '' }}"
                                     style="width: 45px; height: 65px; object-fit: cover; margin-right: 10px; border-radius: 6px;">
                                <span>{{ $item['tieu_de'] }} x{{ $item['so_luong'] }}</span>
                            </div>
                            <span>{{ number_format($item['gia_ban'] * $item['so_luong']) }} VNĐ</span>
                        </div>
                    @endforeach
                    <hr>
                    <div class="d-flex justify-content-between">
                        <strong>Tổng cộng</strong>
                        <strong class="text-danger">{{ number_format($total) }} VNĐ</strong>
                    </div>
                </div>
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