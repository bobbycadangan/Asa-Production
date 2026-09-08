<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->boolean('promo_enabled')->default(true)->after('brand_slogan');
            $table->string('promo_text')->nullable()->default('🔥 Promo spesial bulan ini — diskon hingga 20% untuk semua paket jasa!')->after('promo_enabled');
        });
    }

    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn(['promo_enabled', 'promo_text']);
        });
    }
};
