<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('portfolios', function (Blueprint $table) {
            // Kategori dipakai untuk filter tab di halaman /portofolio
            // (mis. "Jasa Pembuatan Website", "Jasa Pembuatan Aplikasi", dst).
            // Nullable supaya data lama tetap tampil di tab "Semua".
            $table->string('category')->nullable()->after('title');
            $table->text('description')->nullable()->after('category');
            $table->string('link')->nullable()->after('image');
        });
    }

    public function down(): void
    {
        Schema::table('portfolios', function (Blueprint $table) {
            $table->dropColumn(['category', 'description', 'link']);
        });
    }
};
