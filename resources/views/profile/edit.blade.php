<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cập nhật thông tin — Book Store</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        body { background-color: #f8f0eb; font-family: 'Segoe UI', sans-serif; }

        /* NAVBAR */
        .navbar {
            background: linear-gradient(135deg, #c0392b, #e74c3c);
            box-shadow: 0 2px 10px rgba(0,0,0,0.2);
            padding: 10px 20px;
        }
        .navbar-brand { font-size: 1.4rem; font-weight: 800; color: white !important; }
        .navbar .nav-link { color: rgba(255,255,255,0.85) !important; font-weight: 500; }
        .navbar .nav-link:hover { color: white !important; }
        .navbar .dropdown-toggle { color: white !important; font-weight: 600; }
        .navbar .dropdown-menu {
            border: none;
            box-shadow: 0 4px 20px rgba(0,0,0,0.15);
            border-radius: 10px;
        }
        .navbar .dropdown-item { padding: 10px 20px; font-size: 0.9rem; }
        .navbar .dropdown-item:hover { background: #fff0ee; color: #c0392b; }
        .btn-auth {
            border: 2px solid white;
            color: white !important;
            border-radius: 20px;
            padding: 5px 16px;
            font-weight: 600;
            font-size: 0.85rem;
            margin-left: 6px;
            transition: all 0.2s;
        }
        .btn-auth:hover { background: white; color: #c0392b !important; text-decoration: none; }

        /* PAGE */
        .page-header {
            background: linear-gradient(135deg, #c0392b, #e74c3c);
            color: white;
            padding: 28px 0;
            margin-bottom: 30px;
        }
        .page-header h1 { font-size: 1.6rem; font-weight: 800; margin: 0; }
        .page-header p { margin: 4px 0 0 0; opacity: 0.85; font-size: 0.9rem; }

        /* CARD */
        .section-card {
            background: white;
            border-radius: 14px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.07);
            padding: 28px 30px;
            margin-bottom: 24px;
        }
        .section-title {
            font-size: 1.05rem;
            font-weight: 700;
            color: #c0392b;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #f5e0de;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* FORM */
        .form-label { font-weight: 600; font-size: 0.9rem; color: #444; margin-bottom: 5px; }
        .form-control {
            border-radius: 8px;
            border: 1.5px solid #ddd;
            padding: 9px 14px;
            font-size: 0.95rem;
            transition: border-color 0.2s;
        }
        .form-control:focus {
            border-color: #e74c3c;
            box-shadow: 0 0 0 3px rgba(231,76,60,0.1);
        }
        .form-control.is-invalid { border-color: #dc3545; }
        .invalid-feedback { font-size: 0.82rem; }

        /* BUTTONS */
        .btn-save {
            background: linear-gradient(135deg, #e74c3c, #c0392b);
            color: white;
            border: none;
            border-radius: 8px;
            padding: 9px 28px;
            font-weight: 700;
            font-size: 0.95rem;
            transition: opacity 0.2s;
        }
        .btn-save:hover { opacity: 0.88; color: white; }
        .btn-danger-outline {
            border: 2px solid #dc3545;
            color: #dc3545;
            background: transparent;
            border-radius: 8px;
            padding: 8px 20px;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.2s;
        }
        .btn-danger-outline:hover { background: #dc3545; color: white; }

        /* ALERT */
        .alert-success-custom {
            background: #f0fff4;
            border: 1.5px solid #68d391;
            border-radius: 8px;
            color: #276749;
            padding: 10px 16px;
            font-size: 0.9rem;
            margin-bottom: 16px;
        }

        /* FOOTER */
        footer {
            background: #1a1a1a;
            color: #aaa;
            padding: 20px;
            text-align: center;
            margin-top: 20px;
            font-size: 0.9rem;
        }
        footer span { color: #e74c3c; }
    </style>
</head>
<body>

{{-- NAVBAR --}}
<nav class="navbar navbar-expand-lg">
    <a class="navbar-brand" href="/">📚 Book Store</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navMenu">
        <span style="color:white; font-size:1.4rem;">☰</span>
    </button>
    <div class="collapse navbar-collapse" id="navMenu">
        <div class="navbar-nav mr-auto">
            <a class="nav-item nav-link" href="/sach">Tất cả sách</a>
        </div>
        <div class="navbar-nav ml-auto align-items-center">
            @auth
                <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
                        👤 {{ Auth::user()->name }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="{{ route('profile.edit') }}">⚙️ Cập nhật thông tin</a>
                        <div class="dropdown-divider"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="dropdown-item text-danger" type="submit">🚪 Đăng xuất</button>
                        </form>
                    </div>
                </div>
            @else
                <a class="btn-auth" href="{{ route('login') }}">Đăng nhập</a>
            @endauth
        </div>
    </div>
</nav>

{{-- PAGE HEADER --}}
<div class="page-header">
    <div class="container">
        <h1>⚙️ Cập nhật thông tin</h1>
        <p>Quản lý thông tin tài khoản của bạn</p>
    </div>
</div>

<div class="container pb-5">
    <div class="row justify-content-center">
        <div class="col-md-8">

            {{-- 1. CẬP NHẬT THÔNG TIN CÁ NHÂN --}}
            <div class="section-card">
                <div class="section-title">👤 Thông tin cá nhân</div>

                @if (session('status') === 'profile-updated')
                    <div class="alert-success-custom">✅ Cập nhật thông tin thành công!</div>
                @endif

                <form method="POST" action="{{ route('profile.update') }}">
                    @csrf
                    @method('patch')

                    <div class="form-group">
                        <label class="form-label">Họ và tên <span class="text-danger">*</span></label>
                        <input type="text" name="name"
                               class="form-control @error('name') is-invalid @enderror"
                               value="{{ old('name', $user->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" name="email"
                               class="form-control @error('email') is-invalid @enderror"
                               value="{{ old('email', $user->email) }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-save">💾 Lưu thay đổi</button>
                </form>
            </div>

            {{-- 2. ĐỔI MẬT KHẨU --}}
            <div class="section-card">
                <div class="section-title">🔒 Đổi mật khẩu</div>

                @if (session('status') === 'password-updated')
                    <div class="alert-success-custom">✅ Đổi mật khẩu thành công!</div>
                @endif

                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    @method('put')

                    <div class="form-group">
                        <label class="form-label">Mật khẩu hiện tại <span class="text-danger">*</span></label>
                        <input type="password" name="current_password"
                               class="form-control @error('current_password') is-invalid @enderror"
                               autocomplete="current-password">
                        @error('current_password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">Mật khẩu mới <span class="text-danger">*</span></label>
                        <input type="password" name="password"
                               class="form-control @error('password') is-invalid @enderror"
                               autocomplete="new-password">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">Xác nhận mật khẩu mới <span class="text-danger">*</span></label>
                        <input type="password" name="password_confirmation"
                               class="form-control"
                               autocomplete="new-password">
                    </div>

                    <button type="submit" class="btn btn-save">🔑 Cập nhật mật khẩu</button>
                </form>
            </div>

            {{-- 3. XÓA TÀI KHOẢN --}}
            <div class="section-card">
                <div class="section-title">🗑️ Xóa tài khoản</div>
                <p class="text-muted" style="font-size:0.9rem;">
                    Sau khi xóa, toàn bộ dữ liệu tài khoản sẽ bị xóa vĩnh viễn và không thể khôi phục.
                </p>

                <button type="button" class="btn btn-danger-outline"
                        data-toggle="modal" data-target="#deleteModal">
                    🗑️ Xóa tài khoản
                </button>
            </div>

        </div>
    </div>
</div>

{{-- MODAL XÁC NHẬN XÓA --}}
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius:14px; border:none;">
            <div class="modal-header" style="border-bottom:1px solid #f0e0de;">
                <h5 class="modal-title text-danger font-weight-bold">⚠️ Xác nhận xóa tài khoản</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <p>Bạn có chắc chắn muốn xóa tài khoản? Hành động này <strong>không thể hoàn tác</strong>.</p>
                <form method="POST" action="{{ route('profile.destroy') }}" id="deleteForm">
                    @csrf
                    @method('delete')
                    <div class="form-group">
                        <label class="form-label">Nhập mật khẩu để xác nhận</label>
                        <input type="password" name="password"
                               class="form-control @error('password', 'userDeletion') is-invalid @enderror"
                               placeholder="Mật khẩu của bạn">
                        @error('password', 'userDeletion')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </form>
            </div>
            <div class="modal-footer" style="border-top:1px solid #f0e0de;">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                <button type="submit" form="deleteForm" class="btn btn-danger font-weight-bold">
                    Xác nhận xóa
                </button>
            </div>
        </div>
    </div>
</div>

<footer>
    © 2026 — <span>Book Store</span> — Nhóm gồm 3 chàng trai 🎓
</footer>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>

{{-- Tự mở modal nếu có lỗi xóa tài khoản --}}
@if ($errors->userDeletion->isNotEmpty())
<script>
    $(document).ready(function() { $('#deleteModal').modal('show'); });
</script>
@endif

</body>
</html>