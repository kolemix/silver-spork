<x-guest-layout>

    {{-- Thông báo status (vd: link reset password đã gửi) --}}
    @if (session('status'))
        <div class="alert" style="background:#f0fff4; border:1.5px solid #68d391; border-radius:8px; color:#276749; padding:10px 16px; font-size:0.9rem; margin-bottom:16px;">
            {{ session('status') }}
        </div>
    @endif

    <h5 style="font-weight:800; color:#222; margin-bottom:24px; text-align:center;">Đăng nhập</h5>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        {{-- Email --}}
        <div class="form-group">
            <label for="email">Email <span class="text-danger">*</span></label>
            <input id="email" type="email" name="email"
                   class="form-control @error('email') is-invalid @enderror"
                   value="{{ old('email') }}"
                   placeholder="Nhập địa chỉ email"
                   required autofocus autocomplete="username">
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Password --}}
        <div class="form-group">
            <label for="password">Mật khẩu <span class="text-danger">*</span></label>
            <input id="password" type="password" name="password"
                   class="form-control @error('password') is-invalid @enderror"
                   placeholder="Nhập mật khẩu"
                   required autocomplete="current-password">
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Remember me --}}
        <div class="form-group">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember" id="remember_me">
                <label class="form-check-label text-muted" for="remember_me" style="font-size:0.88rem;">
                    Ghi nhớ đăng nhập
                </label>
            </div>
        </div>

        {{-- Nút đăng nhập --}}
        <button type="submit" class="btn-primary-red mt-2">🔑 Đăng nhập</button>

        <hr class="divider">

        <div class="text-center" style="font-size:0.88rem;">
            @if (Route::has('password.request'))
                <a class="auth-link" href="{{ route('password.request') }}">Quên mật khẩu?</a>
                &nbsp;·&nbsp;
            @endif
            <a class="auth-link" href="{{ route('register') }}">Chưa có tài khoản? Đăng ký</a>
        </div>
    </form>

</x-guest-layout>