<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('site_title')->default('Asa Production');
            $table->string('brand_slogan')->default('IT Solution');
            $table->string('logo')->nullable();
            $table->string('favicon')->nullable();

            // Hero section
            $table->string('hero_title')->default('Professional web performance');
            $table->string('hero_subtitle')->default('Сreating something special for each customer');
            $table->string('hero_video')->nullable();

            // About section
            $table->string('about_title')->default('Our creative team consists of the experts skilled in all areas of web design');
            $table->text('about_description')->nullable();

            // Services / parallax section
            $table->string('services_title')->default('Best IT Solutions for your business');
            $table->text('services_description')->nullable();
            $table->string('services_bg')->nullable();

            // Contact / subscribe
            $table->string('whatsapp_number')->default('62812xxxxxxx');
            $table->string('whatsapp_message')->default('Halo Asa Production, saya ingin bertanya tentang layanan IT Solution');
            $table->string('subscribe_title')->default('Subscribe');

            // Footer
            $table->string('footer_title')->default('Professional web performance');
            $table->string('footer_subtitle')->default('Сreating something special for each customer');
            $table->string('footer_bg')->nullable();
            $table->string('footer_cta_text')->default('Get Started Now!');
            $table->string('footer_cta_link')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
