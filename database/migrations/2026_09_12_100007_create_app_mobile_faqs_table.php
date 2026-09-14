<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * FAQ khusus halaman app-mobile. Tabel terpisah dari `faqs` (yang
     * dipakai di homepage & chatbot) supaya kontennya independen.
     */
    public function up(): void
    {
        Schema::create('app_mobile_faqs', function (Blueprint $table) {
            $table->id();
            $table->string('question');
            $table->text('answer');
            $table->integer('order_index')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('app_mobile_faqs');
    }
};
