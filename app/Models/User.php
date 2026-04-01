<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

// Import Notification tùy chỉnh cho Reset Password
use App\Notifications\CustomResetPass;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * Các cột được phép gán hàng loạt
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',   // <-- thêm cột phone (cần migration)
        'photo',   // <-- thêm cột photo (cần migration)
    ];

    /**
     * Ẩn các trường này khi serialize
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Ép kiểu dữ liệu
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password'          => 'hashed',
    ];

    /**
     * Override phương thức gửi email Reset Password.
     * Thay vì dùng email mặc định của Laravel,
     * sẽ dùng Notification CustomResetPass để tùy chỉnh nội dung.
     *
     * @param string $token
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new CustomResetPass($token));
    }
}