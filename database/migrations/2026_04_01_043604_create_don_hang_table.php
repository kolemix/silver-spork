<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('don_hang', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained('users');
        $table->string('ho_ten');
        $table->string('email');
        $table->string('so_dien_thoai');
        $table->text('dia_chi');
        $table->decimal('tong_tien', 15, 0);
        $table->enum('trang_thai', ['cho_xac_nhan', 'dang_giao', 'da_giao', 'da_huy'])->default('cho_xac_nhan');
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('don_hang');
    }
};
