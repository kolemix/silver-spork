<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Đơn hàng của tôi - Book Store</title>
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
    <h4 class="mb-4">📋 Đơn hàng của tôi</h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($orders->isEmpty())
        <div class="alert alert-warning">
            Bạn chưa có đơn hàng nào! <a href="/sach">Mua sắm ngay</a>
        </div>
    @else
        <table class="table table-bordered bg-white">
            <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>Ngày đặt</th>
                    <th>Tổng tiền</th>
                    <th>Trạng thái</th>
                    <th>Chi tiết</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                    <td>{{ number_format($order->total) }} VNĐ</td>
                    <td>
                        @if($order->status == 'pending')
                            <span class="badge badge-warning">Chờ xử lý</span>
                        @elseif($order->status == 'paid')
                            <span class="badge badge-success">Đã thanh toán</span>
                        @elseif($order->status == 'cancelled')
                            <span class="badge badge-danger">Đã huỷ</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('orders.show', $order->id) }}" class="btn btn-sm btn-danger">Xem</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{ $orders->links() }}
    @endif
</div>

<footer>
    © 2026 - Nhóm gồm 3 chàng trai
</footer>

</body>
</html>