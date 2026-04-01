<!DOCTYPE html>
<html>
<head><meta charset="utf-8"></head>
<body>
    <h2>Đặt hàng thành công! 🎉</h2>
    <p>Cảm ơn bạn đã đặt hàng.</p>
    <p><strong>Mã đơn hàng:</strong> {{ $donHang->id }}</p>
    <p><strong>Tổng tiền:</strong> {{ number_format($donHang->tong_tien) }} đ</p>
    <p>Chúng tôi sẽ giao hàng sớm nhất có thể!</p>
</body>
</html>