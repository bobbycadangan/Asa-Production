<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Kartu "Kenapa Pilih Kami" (ikon + judul + deskripsi singkat).
     */
    public function up(): void
    {
        Schema::create('custom_system_benefits', function (Blueprint $table) {
            $table->id();
            $table->string('icon')->nullable()->comment('kelas CSS font-awesome, mis. fa-cogs');
            $table->string('title');
            $table->text('description')->nullable();
            $table->integer('order_index')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('custom_system_benefits');
    }
};
