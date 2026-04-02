<x-guest-layout>

    <h5 style="font-weight:800; color:#222; margin-bottom:12px; text-align:center;">🔐 Quên mật khẩu</h5>

    <p style="font-size:0.88rem; color:#666; text-align:center; margin-bottom:20px;">
        Nhập email của bạn, chúng tôi sẽ gửi link đặt lại mật khẩu.
    </p>

    {{-- Thông báo đã gửi --}}
    @if (session('status'))
        <div style="background:#f0fff4; border:1.5px solid #68d391; border-radius:8px; color:#276749; padding:10px 16px; font-size:0.9rem; margin-bottom:16px;">
            ✅ {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="form-group">
            <label for="email">Email <span class="text-danger">*</span></label>
            <input id="email" type="email" name="email"
                   class="form-control @error('email') is-invalid @enderror"
                   value="{{ old('email') }}"
                   placeholder="Nhập địa chỉ email"
                   required autofocus>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn-primary-red mt-2">📨 Gửi link đặt lại mật khẩu</button>

        <hr class="divider">

        <div class="text-center" style="font-size:0.88rem;">
            <a class="auth-link" href="{{ route('login') }}">← Quay lại đăng nhập</a>
        </div>
    </form>

</x-guest-layout>