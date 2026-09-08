<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->string('about_image')->nullable()->after('about_description');
            $table->string('about_label')->default('Tentang Kami')->after('about_image');
            $table->string('about_cta_text')->default('Pelajari Lebih Lanjut')->after('about_label');
            $table->string('about_cta_link')->default('#services')->after('about_cta_text');
        });
    }

    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn(['about_image', 'about_label', 'about_cta_text', 'about_cta_link']);
        });
    }
};
