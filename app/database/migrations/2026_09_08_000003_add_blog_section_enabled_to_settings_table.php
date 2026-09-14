<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            // Toggle untuk menampilkan/menyembunyikan bagian "Artikel Terbaru" (maks 3 artikel) di landing page.
            $table->boolean('blog_section_enabled')->default(true)->after('subscribe_title');
        });
    }

    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn('blog_section_enabled');
        });
    }
};
