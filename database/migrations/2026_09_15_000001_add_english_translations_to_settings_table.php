<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Kolom "_en" ini adalah padanan bahasa Inggris dari teks yang sama
     * yang sudah ada di tabel settings (hero, about/"Tentang Kami",
     * services, footer). Semuanya nullable — kalau admin tidak mengisi
     * versi EN, tampilan saat bahasa Inggris dipilih akan otomatis
     * fallback ke teks bahasa Indonesia (lihat home.blade.php).
     */
    public function up(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->string('hero_title_en')->nullable()->after('hero_title');
            $table->string('hero_subtitle_en')->nullable()->after('hero_subtitle');

            $table->string('about_label_en')->nullable()->after('about_label');
            $table->string('about_title_en')->nullable()->after('about_title');
            $table->text('about_description_en')->nullable()->after('about_description');
            $table->string('about_cta_text_en')->nullable()->after('about_cta_text');

            $table->string('services_title_en')->nullable()->after('services_title');
            $table->text('services_description_en')->nullable()->after('services_description');

            $table->string('footer_title_en')->nullable()->after('footer_title');
            $table->string('footer_subtitle_en')->nullable()->after('footer_subtitle');
            $table->string('footer_cta_text_en')->nullable()->after('footer_cta_text');
        });
    }

    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn([
                'hero_title_en', 'hero_subtitle_en',
                'about_label_en', 'about_title_en', 'about_description_en', 'about_cta_text_en',
                'services_title_en', 'services_description_en',
                'footer_title_en', 'footer_subtitle_en', 'footer_cta_text_en',
            ]);
        });
    }
};
