<x-guest-layout>

    <h5 style="font-weight:800; color:#222; margin-bottom:12px; text-align:center;">🔑 Đặt lại mật khẩu</h5>
    <p style="font-size:0.88rem; color:#666; text-align:center; margin-bottom:20px;">
        Nhập mật khẩu mới cho tài khoản của bạn.
    </p>

    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        {{-- Token ẩn --}}
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        {{-- Email --}}
        <div class="form-group">
            <label for="email">Email <span class="text-danger">*</span></label>
            <input id="email" type="email" name="email"
                   class="form-control @error('email') is-invalid @enderror"
                   value="{{ old('email', $request->email) }}"
                   required autofocus autocomplete="username">
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Mật khẩu mới --}}
        <div class="form-group">
            <label for="password">Mật khẩu mới <span class="text-danger">*</span></label>
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
            <label for="password_confirmation">Xác nhận mật khẩu mới <span class="text-danger">*</span></label>
            <input id="password_confirmation" type="password" name="password_confirmation"
                   class="form-control"
                   placeholder="Nhập lại mật khẩu mới"
                   required autocomplete="new-password">
        </div>

        {{-- Nút submit --}}
        <button type="submit" class="btn-primary-red mt-2">✅ Xác nhận đặt lại mật khẩu</button>

        <hr class="divider">

        <div class="text-center" style="font-size:0.88rem;">
            <a class="auth-link" href="{{ route('login') }}">← Quay lại đăng nhập</a>
        </div>
    </form>

</x-guest-layout>