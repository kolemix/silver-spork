<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration thêm cột phone và photo vào bảng users
 *
 * Chạy lệnh: php artisan migrate
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Số điện thoại — có thể để trống
            $table->string('phone', 15)->nullable()->after('email');

            // Tên file ảnh đại diện — có thể để trống
            $table->string('photo', 100)->nullable()->after('phone');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['phone', 'photo']);
        });
    }
};