<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Langkah-langkah di section "Proses Pengembangan Aplikasi Kami".
     * Nomor langkah (1, 2, 3, ...) ditentukan otomatis dari urutan tampil,
     * jadi admin tidak perlu isi nomor manual.
     */
    public function up(): void
    {
        Schema::create('app_mobile_process_steps', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->integer('order_index')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('app_mobile_process_steps');
    }
};
