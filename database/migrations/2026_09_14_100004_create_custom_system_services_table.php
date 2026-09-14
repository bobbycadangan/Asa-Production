<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Kartu "Layanan yang Kami Tawarkan" (ikon + judul) khusus halaman
     * sistem kustom. Sengaja dibuat tabel terpisah dari `services` (yang
     * dipakai landing page utama) supaya tidak saling menimpa konten.
     */
    public function up(): void
    {
        Schema::create('custom_system_services', function (Blueprint $table) {
            $table->id();
            $table->string('icon')->nullable()->comment('kelas CSS font-awesome, mis. fa-database');
            $table->string('title');
            $table->integer('order_index')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('custom_system_services');
    }
};
