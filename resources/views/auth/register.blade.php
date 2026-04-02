<x-guest-layout>

    <h5 style="font-weight:800; color:#222; margin-bottom:24px; text-align:center;">Tạo tài khoản mới</h5>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        {{-- Họ tên --}}
        <div class="form-group">
            <label for="name">Họ và tên <span class="text-danger">*</span></label>
            <input id="name" type="text" name="name"
                   class="form-control @error('name') is-invalid @enderror"
                   value="{{ old('name') }}"
                   placeholder="Nhập họ và tên"
                   required autofocus autocomplete="name">
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Email --}}
        <div class="form-group">
            <label for="email">Email <span class="text-danger">*</span></label>
            <input id="email" type="email" name="email"
                   class="form-control @error('email') is-invalid @enderror"
                   value="{{ old('email') }}"
                   placeholder="Nhập địa chỉ email"
                   required autocomplete="username">
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Mật khẩu --}}
        <div class="form-group">
            <label for="password">Mật khẩu <span class="text-danger">*</span></label>
            <input id="password" type="password" name="password"
                   class="form-control @error('password') is-invalid @enderror"
                   placeholder="Tối thiểu 8 ký tự"
                   required autocomplete="new-password">
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Xác nhận mật khẩu --}}
        <div class="form-group">
            <label for="password_confirmation">Xác nhận mật khẩu <span class="text-danger">*</span></label>
            <input id="password_confirmation" type="password" name="password_confirmation"
                   class="form-control"
                   placeholder="Nhập lại mật khẩu"
                   required autocomplete="new-password">
        </div>

        {{-- Nút đăng ký --}}
        <button type="submit" class="btn-primary-red mt-2">📝 Đăng ký</button>

        <hr class="divider">

        <div class="text-center" style="font-size:0.88rem;">
            <a class="auth-link" href="{{ route('login') }}">Đã có tài khoản? Đăng nhập</a>
        </div>
    </form>

</x-guest-layout>