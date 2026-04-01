<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $title ?? 'Book Store' }}</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <style>
        body {
            background-color: #f5f5f5;
        }

        .navbar {
            background-color: #ff5850;
        }

        .navbar a {
            color: white !important;
            font-weight: bold;
        }

        footer {
            background: #222;
            color: white;
            padding: 15px;
            text-align: center;
            margin-top: 30px;
        }
    </style>
</head>

<body>

<!-- HEADER -->
<nav class="navbar navbar-expand-lg">
    <a class="navbar-brand" href="/">📚 Book Store</a>

    <div class="navbar-nav">
        <a class="nav-item nav-link" href="/sach">Sách</a>
        <a class="nav-item nav-link" href="/theloai">Thể loại</a>
    </div>
</nav>

<!-- CONTENT -->
<div class="container mt-4">
    {{ $slot }}
</div>

<!-- FOOTER -->
<footer>
    © 2026 - Nhóm gồm 3 chàng trai
</footer>

</body>
</html>