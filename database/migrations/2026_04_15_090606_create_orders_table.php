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
            $table->foreignId('client_id')->constrained('clients')->cascadeOnDelete();
            $table->foreignId('package_id')->constrained('packages')->cascadeOnDelete();
            $table->dateTime('tanggal_pesan');
            $table->date('tanggal_acara');
            $table->decimal('total_harga', 12, 2);
            $table->enum('status_pesanan', ['Pending', 'Dikonfirmasi', 'Selesai', 'Batal'])->default('Pending');
            $table->enum('status_pembayaran', ['Belum Lunas', 'DP', 'Lunas'])->default('Belum Lunas');
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
