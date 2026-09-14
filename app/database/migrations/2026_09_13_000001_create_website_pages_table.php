<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('website_pages', function (Blueprint $table) {
            $table->id();

            $table->string('hero_eyebrow')->nullable();
            $table->string('hero_title')->nullable();
            $table->text('hero_description')->nullable();
            $table->string('hero_background')->nullable();
            $table->string('whatsapp_message')->nullable();

            $table->string('why_us_eyebrow')->nullable();
            $table->string('why_us_title')->nullable();
            $table->text('why_us_description')->nullable();

            $table->string('services_eyebrow')->nullable();
            $table->string('services_title')->nullable();
            $table->text('services_description')->nullable();

            $table->string('process_eyebrow')->nullable();
            $table->string('process_title')->nullable();
            $table->text('process_description')->nullable();

            $table->string('tech_eyebrow')->nullable();
            $table->string('tech_title')->nullable();

            $table->string('portfolio_eyebrow')->nullable();
            $table->string('portfolio_title')->nullable();
            $table->text('portfolio_description')->nullable();

            $table->string('faq_eyebrow')->nullable();
            $table->string('faq_title')->nullable();

            $table->string('cta_title')->nullable();
            $table->text('cta_description')->nullable();

            $table->string('meta_description', 500)->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('website_pages');
    }
};
