<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Chi tiết đơn hàng - Book Store</title>
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
        <a class="nav-item nav-link" href="/cart">🛒 Giỏ hàng</a>
        <a class="nav-item nav-link" href="/orders">📋 Đơn hàng</a>
    </div>
</nav>

<div class="container mt-4">
    <h4 class="mb-4">📦 Chi tiết đơn hàng #{{ $order->id }}</h4>

    <div class="row">
        <!-- Thông tin người đặt -->
        <div class="col-md-5">
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h5 class="card-title">Thông tin nhận hàng</h5>
                    <p><strong>Họ tên:</strong> {{ $order->ho_ten }}</p>
                    <p><strong>Số điện thoại:</strong> {{ $order->so_dien_thoai }}</p>
                    <p><strong>Địa chỉ:</strong> {{ $order->dia_chi }}</p>
                    <p><strong>Ghi chú:</strong> {{ $order->ghi_chu ?? 'Không có' }}</p>
                    <p><strong>Ngày đặt:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>
                    <p><strong>Trạng thái:</strong>
                        @if($order->status == 'pending')
                            <span class="badge badge-warning">Chờ xử lý</span>
                        @elseif($order->status == 'paid')
                            <span class="badge badge-success">Đã thanh toán</span>
                        @elseif($order->status == 'cancelled')
                            <span class="badge badge-danger">Đã huỷ</span>
                        @endif
                    </p>
                </div>
            </div>
        </div>

        <!-- Danh sách sách đã đặt -->
        <div class="col-md-7">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Sách đã đặt</h5>
                    <table class="table table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th>Tên sách</th>
                                <th>Số lượng</th>
                                <th>Đơn giá</th>
                                <th>Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->items as $item)
                            <tr>
                                <td>{{ $item->ten_sach }}</td>
                                <td>{{ $item->so_luong }}</td>
                                <td>{{ number_format($item->don_gia) }} VNĐ</td>
                                <td>{{ number_format($item->don_gia * $item->so_luong) }} VNĐ</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="text-right">
                        <h5>Tổng cộng: <span class="text-danger">{{ number_format($order->total) }} VNĐ</span></h5>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <a href="{{ route('orders.index') }}" class="btn btn-outline-danger">← Quay lại danh sách đơn hàng</a>
</div>

<footer>
    © 2026 - Nhóm gồm 3 chàng trai
</footer>

</body>
</html>