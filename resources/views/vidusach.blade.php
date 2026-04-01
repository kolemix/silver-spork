{{-- resources/views/vidusach/account.blade.php --}}
<x-account-panel>

    <div class="account-wrapper">

        {{-- Tiêu đề --}}
        <div class="account-header">
            <h4>⚙️ Cập Nhật Thông Tin Cá Nhân</h4>
            <p class="account-sub">Thay đổi thông tin tài khoản của bạn bên dưới</p>
        </div>

        {{-- Thông báo lỗi validate --}}
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>⚠️ Có lỗi xảy ra:</strong>
                <ul class="mb-0 mt-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="close" data-dismiss="alert">
                    <span>&times;</span>
                </button>
            </div>
        @endif

        {{-- Thông báo thành công --}}
        @if (session('status'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                ✅ {{ session('status') }}
                <button type="button" class="close" data-dismiss="alert">
                    <span>&times;</span>
                </button>
            </div>
        @endif

        {{-- Form cập nhật --}}
        <form method="POST"
              action="{{ route('saveinfo') }}"
              enctype="multipart/form-data"
              class="account-form">

            {{ csrf_field() }}
            <input type="hidden" name="id" value="{{ $user->id }}">

            {{-- Ảnh đại diện preview --}}
            <div class="avatar-section text-center mb-4">
                @if (!empty($user->photo))
                    <img id="avatar-preview"
                         src="{{ asset('storage/profile/' . $user->photo) }}"
                         class="avatar-img"
                         alt="Ảnh đại diện">
                @else
                    <div id="avatar-placeholder" class="avatar-placeholder">
                        {{ strtoupper(substr($user->name ?? 'U', 0, 1)) }}
                    </div>
                    <img id="avatar-preview"
                         src=""
                         class="avatar-img d-none"
                         alt="Ảnh đại diện">
                @endif
                <div class="mt-2">
                    <label for="photo" class="btn btn-sm btn-outline-secondary">
                        📷 Chọn ảnh đại diện
                    </label>
                    <input type="file"
                           id="photo"
                           name="photo"
                           accept="image/*"
                           class="d-none"
                           onchange="previewAvatar(this)">
                    <div class="text-muted small mt-1">JPG, PNG, GIF — tối đa 2MB</div>
                </div>
            </div>

            {{-- Tên --}}
            <div class="form-group">
                <label for="name">👤 Họ và tên <span class="text-danger">*</span></label>
                <input type="text"
                       id="name"
                       name="name"
                       class="form-control @error('name') is-invalid @enderror"
                       value="{{ old('name', $user->name) }}"
                       placeholder="Nhập họ và tên"
                       required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Email --}}
            <div class="form-group">
                <label for="email">📧 Email <span class="text-danger">*</span></label>
                <input type="email"
                       id="email"
                       name="email"
                       class="form-control @error('email') is-invalid @enderror"
                       value="{{ old('email', $user->email) }}"
                       placeholder="Nhập địa chỉ email"
                       required>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Số điện thoại --}}
            <div class="form-group">
                <label for="phone">📞 Số điện thoại</label>
                <input type="text"
                       id="phone"
                       name="phone"
                       class="form-control @error('phone') is-invalid @enderror"
                       value="{{ old('phone', $user->phone ?? '') }}"
                       placeholder="Nhập số điện thoại (không bắt buộc)">
                @error('phone')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Nút lưu --}}
            <div class="form-group text-center mt-4">
                <button type="submit" class="btn btn-primary btn-save">
                    💾 Lưu thay đổi
                </button>
                <a href="{{ url('/') }}" class="btn btn-secondary ml-2">
                    ← Quay lại trang chủ
                </a>
            </div>

        </form>
    </div>

    {{-- Style riêng cho trang account --}}
    <style>
        .account-wrapper {
            max-width: 480px;
            margin: 30px auto;
            padding: 30px;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 2px 16px rgba(0,0,0,0.08);
        }
        .account-header h4 {
            font-weight: 700;
            color: #1155cc;
            margin-bottom: 4px;
        }
        .account-sub {
            color: #888;
            font-size: 0.9em;
            margin-bottom: 20px;
        }
        .avatar-img {
            width: 90px;
            height: 90px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #1155cc;
        }
        .avatar-placeholder {
            width: 90px;
            height: 90px;
            border-radius: 50%;
            background: #1155cc;
            color: #fff;
            font-size: 2.2rem;
            font-weight: bold;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
        }
        .account-form label {
            font-weight: 600;
            font-size: 0.9rem;
            color: #333;
        }
        .btn-save {
            padding: 8px 32px;
            font-weight: 600;
            border-radius: 8px;
        }
    </style>

    {{-- Script preview ảnh --}}
    <script>
        function previewAvatar(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    var preview = document.getElementById('avatar-preview');
                    var placeholder = document.getElementById('avatar-placeholder');
                    preview.src = e.target.result;
                    preview.classList.remove('d-none');
                    if (placeholder) placeholder.style.display = 'none';
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

</x-account-panel>