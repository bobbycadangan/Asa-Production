<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->string('footer_address')->nullable()->after('footer_cta_link');
            $table->string('footer_email')->nullable()->after('footer_address');
            $table->string('social_facebook')->nullable()->after('footer_email');
            $table->string('social_instagram')->nullable()->after('social_facebook');
            $table->string('social_tiktok')->nullable()->after('social_instagram');
            $table->string('social_linkedin')->nullable()->after('social_tiktok');
            $table->string('social_youtube')->nullable()->after('social_linkedin');
            $table->string('social_x')->nullable()->after('social_youtube');
        });
    }

    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn([
                'footer_address', 'footer_email',
                'social_facebook', 'social_instagram', 'social_tiktok',
                'social_linkedin', 'social_youtube', 'social_x',
            ]);
        });
    }
};
