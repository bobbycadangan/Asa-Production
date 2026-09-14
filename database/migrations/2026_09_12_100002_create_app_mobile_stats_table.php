<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Baris statistik di strip angka bawah masthead (mis. "50+ Proyek Selesai").
     */
    public function up(): void
    {
        Schema::create('app_mobile_stats', function (Blueprint $table) {
            $table->id();
            $table->string('value');
            $table->string('label');
            $table->integer('order_index')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('app_mobile_stats');
    }
};
