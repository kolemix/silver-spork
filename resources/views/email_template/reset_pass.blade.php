{{-- resources/views/email_template/reset_pass.blade.php --}}
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lấy lại mật khẩu</title>
    <style>
        /* Reset */
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background-color: #f0f4f8;
            color: #333;
            padding: 40px 16px;
        }

        .email-container {
            max-width: 560px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 24px rgba(0, 0, 0, 0.10);
        }

        /* Header xanh đậm */
        .email-header {
            background: linear-gradient(135deg, #1a3a6b 0%, #1155cc 100%);
            padding: 36px 40px;
            text-align: center;
        }
        .email-header .lock-icon {
            font-size: 48px;
            margin-bottom: 12px;
            display: block;
        }
        .email-header h1 {
            color: #ffffff;
            font-size: 22px;
            font-weight: 700;
            letter-spacing: 0.5px;
        }
        .email-header p {
            color: rgba(255,255,255,0.8);
            font-size: 13px;
            margin-top: 6px;
        }

        /* Nội dung */
        .email-body {
            padding: 36px 40px;
        }
        .email-body p {
            font-size: 15px;
            line-height: 1.7;
            color: #444;
            margin-bottom: 16px;
        }
        .email-body p.highlight {
            color: #222;
            font-weight: 600;
        }

        /* Nút Reset */
        .btn-container {
            text-align: center;
            margin: 28px 0;
        }
        .btn-reset {
            display: inline-block;
            background: linear-gradient(135deg, #1155cc, #0d47a1);
            color: #ffffff !important;
            text-decoration: none;
            padding: 14px 40px;
            border-radius: 50px;
            font-size: 15px;
            font-weight: 700;
            letter-spacing: 0.5px;
            box-shadow: 0 4px 14px rgba(17, 85, 204, 0.4);
            transition: opacity 0.2s;
        }
        .btn-reset:hover {
            opacity: 0.9;
        }

        /* Divider */
        .divider {
            border: none;
            border-top: 1px solid #e8edf2;
            margin: 24px 0;
        }

        /* Link dự phòng */
        .fallback {
            background: #f5f8ff;
            border: 1px solid #d0ddf7;
            border-radius: 8px;
            padding: 16px;
            font-size: 13px;
            color: #555;
            word-break: break-all;
        }
        .fallback a {
            color: #1155cc;
            text-decoration: none;
        }

        /* Cảnh báo */
        .warning-box {
            background: #fff8e1;
            border-left: 4px solid #f59e0b;
            border-radius: 4px;
            padding: 12px 16px;
            font-size: 13px;
            color: #7a5c00;
            margin-top: 20px;
        }

        /* Footer */
        .email-footer {
            background: #f7f9fc;
            padding: 20px 40px;
            text-align: center;
            border-top: 1px solid #e8edf2;
        }
        .email-footer p {
            font-size: 12px;
            color: #999;
            line-height: 1.6;
        }
        .email-footer .app-name {
            font-weight: 700;
            color: #1155cc;
        }
    </style>
</head>
<body>

<div class="email-container">

    {{-- Header --}}
    <div class="email-header">
        <span class="lock-icon">🔐</span>
        <h1>Yêu cầu lấy lại mật khẩu</h1>
        <p>{{ config('app.name', 'Ứng dụng của chúng tôi') }}</p>
    </div>

    {{-- Nội dung --}}
    <div class="email-body">
        <p>Xin chào,</p>

        <p>
            Chúng tôi nhận được yêu cầu <strong>đặt lại mật khẩu</strong> cho tài khoản của bạn.
            Nhấn vào nút bên dưới để tiến hành đặt lại mật khẩu mới.
        </p>

        {{-- Nút chính --}}
        <div class="btn-container">
            <a href="{{ $url }}" class="btn-reset">
                🔑 Đặt lại mật khẩu
            </a>
        </div>

        <hr class="divider">

        {{-- Link dự phòng nếu nút không hoạt động --}}
        <p style="font-size:13px; color:#666;">
            Nếu nút trên không hoạt động, hãy sao chép và dán đường dẫn sau vào trình duyệt:
        </p>
        <div class="fallback">
            <a href="{{ $url }}">{{ $url }}</a>
        </div>

        {{-- Cảnh báo --}}
        <div class="warning-box">
            ⏰ <strong>Lưu ý:</strong> Đường dẫn này chỉ có hiệu lực trong vòng
            <strong>60 phút</strong> kể từ khi bạn nhận được email này.
            Nếu bạn không yêu cầu đặt lại mật khẩu, hãy bỏ qua email này.
        </div>
    </div>

    {{-- Footer --}}
    <div class="email-footer">
        <p>
            Email này được gửi tự động từ hệ thống
            <span class="app-name">{{ config('app.name', 'Ứng dụng') }}</span>.<br>
            Vui lòng không trả lời email này.
        </p>
    </div>

</div>

</body>
</html>