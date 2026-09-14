<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tabel single-row (mirip `settings`) untuk teks-teks statis di halaman
     * "Jasa Pembuatan Aplikasi Mobile" (masthead, judul tiap section, CTA, dst)
     * supaya bisa diedit lewat halaman admin tanpa mengubah kode.
     */
    public function up(): void
    {
        Schema::create('app_mobile_pages', function (Blueprint $table) {
            $table->id();

            // Masthead
            $table->string('hero_eyebrow')->default('Solusi Kami');
            $table->string('hero_title')->default('Jasa Pembuatan Aplikasi Mobile Android & iOS');
            $table->text('hero_description')->nullable();

            // Pesan default yang dikirim ke WhatsApp (dipakai di masthead & CTA banner)
            $table->string('whatsapp_message')->default('Halo, saya ingin konsultasi pembuatan aplikasi mobile');

            // Section: Kenapa Pilih Kami
            $table->string('why_us_eyebrow')->default('Kenapa Pilih Kami');
            $table->string('why_us_title')->default('Partner Terpercaya untuk Aplikasi Mobile Bisnis Anda');
            $table->text('why_us_description')->nullable();

            // Section: Layanan yang Kami Tawarkan
            $table->string('services_eyebrow')->default('Layanan Kami');
            $table->string('services_title')->default('Apa Saja yang Kami Kerjakan');
            $table->text('services_description')->nullable();

            // Section: Proses Pengembangan
            $table->string('process_eyebrow')->default('Cara Kerja');
            $table->string('process_title')->default('Proses Pengembangan Aplikasi Kami');
            $table->text('process_description')->nullable();

            // Section: Teknologi
            $table->string('tech_eyebrow')->default('Teknologi');
            $table->string('tech_title')->default('Teknologi yang Kami Gunakan');

            // Section: Portofolio preview
            $table->string('portfolio_eyebrow')->default('Hasil Kerja');
            $table->string('portfolio_title')->default('Contoh Aplikasi yang Pernah Kami Buat');
            $table->text('portfolio_description')->nullable();

            // Section: FAQ
            $table->string('faq_eyebrow')->default('F.A.Q');
            $table->string('faq_title')->default('Pertanyaan yang Sering Diajukan');

            // Section: CTA banner
            $table->string('cta_title')->default('Siap Membuat Aplikasi Mobile Anda?');
            $table->text('cta_description')->nullable();

            // SEO
            $table->string('meta_description', 500)->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('app_mobile_pages');
    }
};
