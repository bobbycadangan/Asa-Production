<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * column => [Blueprint method, "after" column]
     */
    protected function columns(): array
    {
        return [
            'hero_title_en' => ['string', 'hero_title'],
            'hero_subtitle_en' => ['string', 'hero_subtitle'],

            'about_title_en' => ['string', 'about_title'],
            'about_description_en' => ['text', 'about_description'],
            'about_label_en' => ['string', 'about_label'],
            'about_cta_text_en' => ['string', 'about_cta_text'],

            'services_title_en' => ['string', 'services_title'],
            'services_description_en' => ['text', 'services_description'],

            'footer_title_en' => ['string', 'footer_title'],
            'footer_subtitle_en' => ['string', 'footer_subtitle'],
            'footer_cta_text_en' => ['string', 'footer_cta_text'],
        ];
    }

    public function up(): void
    {
        foreach ($this->columns() as $column => [$type, $after]) {
            if (Schema::hasColumn('settings', $column)) {
                continue;
            }

            Schema::table('settings', function (Blueprint $table) use ($column, $type, $after) {
                $table->$type($column)->nullable()->after($after);
            });
        }
    }

    public function down(): void
    {
        $existing = array_filter(
            array_keys($this->columns()),
            fn ($column) => Schema::hasColumn('settings', $column)
        );

        if (empty($existing)) {
            return;
        }

        Schema::table('settings', function (Blueprint $table) use ($existing) {
            $table->dropColumn($existing);
        });
    }
};
