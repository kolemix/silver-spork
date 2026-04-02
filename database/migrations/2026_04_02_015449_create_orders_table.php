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
    Schema::create('orders', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('user_id')->nullable();
        $table->string('ho_ten');
        $table->string('so_dien_thoai');
        $table->string('dia_chi');
        $table->text('ghi_chu')->nullable();
        $table->decimal('total', 15, 0);
        $table->string('status')->default('pending');
        $table->string('phuong_thuc_thanh_toan')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
