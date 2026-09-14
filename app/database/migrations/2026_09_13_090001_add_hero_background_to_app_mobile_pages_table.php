<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Menambahkan kolom untuk gambar background masthead (hero) halaman
     * "Jasa Pembuatan Aplikasi Mobile" supaya bisa diganti lewat admin.
     * Kalau kosong (belum pernah upload), halaman tetap pakai gambar
     * default (public/images/parallax2.jpg) seperti sebelumnya.
     */
    public function up(): void
    {
        Schema::table('app_mobile_pages', function (Blueprint $table) {
            $table->string('hero_background')->nullable()->after('hero_description');
        });
    }

    public function down(): void
    {
        Schema::table('app_mobile_pages', function (Blueprint $table) {
            $table->dropColumn('hero_background');
        });
    }
};
