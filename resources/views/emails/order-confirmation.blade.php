<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xác nhận đơn hàng</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Arial, sans-serif; background: #f8f0eb; padding: 40px 16px; }
        .container { max-width: 600px; margin: 0 auto; background: white; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 24px rgba(0,0,0,0.1); }

        .header { background: linear-gradient(135deg, #c0392b, #e74c3c); padding: 36px 40px; text-align: center; }
        .header .icon { font-size: 48px; margin-bottom: 12px; display: block; }
        .header h1 { color: white; font-size: 22px; font-weight: 700; }
        .header p { color: rgba(255,255,255,0.85); font-size: 13px; margin-top: 6px; }

        .body { padding: 36px 40px; }
        .body p { font-size: 15px; line-height: 1.7; color: #444; margin-bottom: 12px; }

        .info-box { background: #fafafa; border-radius: 10px; padding: 20px; margin: 20px 0; border: 1px solid #eee; }
        .info-box h3 { font-size: 1rem; font-weight: 700; color: #c0392b; margin-bottom: 14px; }
        .info-row { display: flex; margin-bottom: 8px; font-size: 0.9rem; }
        .info-label { font-weight: 600; color: #555; min-width: 160px; }
        .info-value { color: #222; }

        .items-table { width: 100%; border-collapse: collapse; margin: 20px 0; font-size: 0.9rem; }
        .items-table th { background: #e74c3c; color: white; padding: 10px 14px; text-align: left; }
        .items-table td { padding: 10px 14px; border-bottom: 1px solid #f0e0de; color: #333; }
        .items-table tr:last-child td { border-bottom: none; }
        .items-table .total-row td { font-weight: 700; color: #e74c3c; font-size: 1rem; background: #fff8f7; }

        .warning-box { background: #fff8e1; border-left: 4px solid #f59e0b; border-radius: 4px; padding: 12px 16px; font-size: 13px; color: #7a5c00; margin-top: 20px; }

        .footer { background: #fdf5f3; padding: 20px 40px; text-align: center; border-top: 1px solid #f0e0dc; }
        .footer p { font-size: 12px; color: #aaa; line-height: 1.6; }
        .footer .app-name { font-weight: 700; color: #e74c3c; }
    </style>
</head>
<body>
<div class="container">

    <div class="header">
        <span class="icon">✅</span>
        <h1>Đặt hàng thành công!</h1>
        <p>{{ config('app.name', 'Book Store') }}</p>
    </div>

    <div class="body">
        <p>Xin chào <strong>{{ $order->ho_ten }}</strong>,</p>
        <p>Chúng tôi đã nhận được đơn hàng của bạn và đang xử lý. Dưới đây là thông tin chi tiết:</p>

        {{-- Thông tin giao hàng --}}
        <div class="info-box">
            <h3>📦 Thông tin giao hàng</h3>
            <div class="info-row">
                <span class="info-label">Họ và tên:</span>
                <span class="info-value">{{ $order->ho_ten }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Số điện thoại:</span>
                <span class="info-value">{{ $order->so_dien_thoai }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Địa chỉ:</span>
                <span class="info-value">{{ $order->dia_chi }}</span>
            </div>
            @if($order->ghi_chu)
            <div class="info-row">
                <span class="info-label">Ghi chú:</span>
                <span class="info-value">{{ $order->ghi_chu }}</span>
            </div>
            @endif
        </div>

        {{-- Danh sách sản phẩm --}}
        <div class="info-box">
            <h3>📚 Sản phẩm đặt hàng</h3>
            <table class="items-table">
                <thead>
                    <tr>
                        <th>Tên sách</th>
                        <th>SL</th>
                        <th>Đơn giá</th>
                        <th>Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($items as $item)
                    <tr>
                        <td>{{ $item->ten_sach }}</td>
                        <td>{{ $item->so_luong }}</td>
                        <td>{{ number_format($item->don_gia) }} VNĐ</td>
                        <td>{{ number_format($item->don_gia * $item->so_luong) }} VNĐ</td>
                    </tr>
                    @endforeach
                    <tr class="total-row">
                        <td colspan="3">Tổng cộng</td>
                        <td>{{ number_format($order->total) }} VNĐ</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="warning-box">
            📞 Nếu có thắc mắc, vui lòng liên hệ chúng tôi qua email hoặc số điện thoại hỗ trợ.
        </div>
    </div>

    <div class="footer">
        <p>Email được gửi tự động từ <span class="app-name">{{ config('app.name', 'Book Store') }}</span>.<br>Vui lòng không trả lời email này.</p>
    </div>

</div>
</body>
</html>