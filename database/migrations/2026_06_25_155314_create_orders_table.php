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
            $table->foreignId('tenant_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('villa_id')->constrained()->onDelete('cascade');
            $table->foreignId('host_id')->constrained('users')->onDelete('cascade');
            $table->decimal('total_harga', 10, 2);
            $table->dateTime('tgl_check_in');
            $table->dateTime('tgl_check_out');
            $table->dateTime('tgl_pesanan');
            $table->enum('status_pesanan', ['pending', 'confirm', 'checkin', 'checkout', 'cancelled', 'expired', 'refund requested', 'refunded', 'no show'])->default('pending');
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
