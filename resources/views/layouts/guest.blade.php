<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Book Store') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #1a0000, #3d0000);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Figtree', 'Segoe UI', sans-serif;
        }
        .auth-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 8px 40px rgba(0,0,0,0.3);
            padding: 40px;
            width: 100%;
            max-width: 420px;
        }
        .auth-logo {
            text-align: center;
            margin-bottom: 28px;
        }
        .auth-logo a {
            font-size: 1.8rem;
            font-weight: 900;
            color: #e74c3c;
            text-decoration: none;
            letter-spacing: 1px;
        }
        .auth-logo a:hover { color: #c0392b; }
        .auth-logo p {
            color: #888;
            font-size: 0.88rem;
            margin-top: 4px;
        }
        .form-group label {
            font-weight: 600;
            font-size: 0.88rem;
            color: #444;
        }
        .form-control {
            border-radius: 8px;
            border: 1.5px solid #ddd;
            padding: 10px 14px;
            font-size: 0.95rem;
        }
        .form-control:focus {
            border-color: #e74c3c;
            box-shadow: 0 0 0 3px rgba(231,76,60,0.12);
        }
        .btn-primary-red {
            background: linear-gradient(135deg, #e74c3c, #c0392b);
            color: white;
            border: none;
            border-radius: 8px;
            padding: 10px;
            font-weight: 700;
            font-size: 0.95rem;
            width: 100%;
            transition: opacity 0.2s;
        }
        .btn-primary-red:hover { opacity: 0.88; color: white; }
        .auth-link {
            color: #e74c3c;
            font-size: 0.88rem;
            text-decoration: none;
        }
        .auth-link:hover { color: #c0392b; text-decoration: underline; }
        .divider {
            border: none;
            border-top: 1px solid #eee;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="auth-card">
        <div class="auth-logo">
            <a href="/">📚 Book Store</a>
            <p>Hệ thống quản lý sách trực tuyến</p>
        </div>
        {{ $slot }}
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
</body>
</html>