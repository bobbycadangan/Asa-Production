<?php

namespace Database\Seeders;

use App\Models\AppMobileBenefit;
use App\Models\AppMobileFaq;
use App\Models\AppMobilePage;
use App\Models\AppMobileProcessStep;
use App\Models\AppMobileService;
use App\Models\AppMobileStat;
use App\Models\AppMobileTechBadge;
use Illuminate\Database\Seeder;

class AppMobilePageSeeder extends Seeder
{
    /**
     * Mengisi konten default halaman "Jasa Pembuatan Aplikasi Mobile" supaya
     * halaman tidak kosong setelah migrasi (tampilannya sama seperti versi
     * awal/statis), dan bisa langsung diedit dari admin. Aman dijalankan
     * berulang kali (idempotent) karena pakai updateOrCreate/cek count().
     */
    public function run(): void
    {
        AppMobilePage::updateOrCreate(['id' => 1], [
            'hero_eyebrow' => 'Solusi Kami',
            'hero_title' => 'Jasa Pembuatan Aplikasi Mobile Android & iOS',
            'hero_description' => 'Wujudkan ide bisnis Anda menjadi aplikasi mobile yang profesional, cepat, dan siap dipakai. Tim kami membantu Anda dari tahap konsultasi, desain UI/UX, development, hingga rilis ke Play Store & App Store.',
            'whatsapp_message' => 'Halo, saya ingin konsultasi pembuatan aplikasi mobile',
            'why_us_eyebrow' => 'Kenapa Pilih Kami',
            'why_us_title' => 'Partner Terpercaya untuk Aplikasi Mobile Bisnis Anda',
            'why_us_description' => 'Kami membantu proses pembuatan aplikasi dari nol sampai rilis, dengan komunikasi yang transparan di setiap tahap.',
            'services_eyebrow' => 'Layanan Kami',
            'services_title' => 'Apa Saja yang Kami Kerjakan',
            'services_description' => 'Cakupan layanan pembuatan aplikasi mobile, dari desain sampai aplikasi tayang di toko aplikasi.',
            'process_eyebrow' => 'Cara Kerja',
            'process_title' => 'Proses Pengembangan Aplikasi Kami',
            'process_description' => 'Alur kerja yang jelas dari awal konsultasi hingga aplikasi Anda siap digunakan.',
            'tech_eyebrow' => 'Teknologi',
            'tech_title' => 'Teknologi yang Kami Gunakan',
            'portfolio_eyebrow' => 'Hasil Kerja',
            'portfolio_title' => 'Contoh Aplikasi yang Pernah Kami Buat',
            'portfolio_description' => 'Sebagian portofolio yang sudah kami kerjakan untuk klien kami.',
            'faq_eyebrow' => 'F.A.Q',
            'faq_title' => 'Pertanyaan yang Sering Diajukan',
            'cta_title' => 'Siap Membuat Aplikasi Mobile Anda?',
            'cta_description' => 'Ceritakan kebutuhan aplikasi Anda, tim kami siap membantu mewujudkannya dari konsep hingga rilis.',
            'meta_description' => 'Jasa pembuatan aplikasi mobile Android, iOS, dan cross-platform. Dari konsultasi, desain UI/UX, development, hingga rilis ke Play Store & App Store.',
        ]);

        if (AppMobileStat::count() === 0) {
            $stats = [
                ['value' => '50+', 'label' => 'Proyek Selesai'],
                ['value' => 'Android & iOS', 'label' => 'Platform Didukung'],
                ['value' => '100%', 'label' => 'Source Code Milik Anda'],
                ['value' => 'Gratis', 'label' => 'Konsultasi Awal'],
            ];
            foreach ($stats as $i => $row) {
                AppMobileStat::create($row + ['order_index' => $i]);
            }
        }

        if (AppMobileBenefit::count() === 0) {
            $benefits = [
                ['icon' => 'fa-users', 'title' => 'Tim Berpengalaman', 'description' => 'Dikerjakan oleh developer & desainer yang terbiasa membangun aplikasi untuk berbagai jenis bisnis.'],
                ['icon' => 'fa-paint-brush', 'title' => 'Desain UI/UX Modern', 'description' => 'Tampilan aplikasi dirancang agar mudah digunakan dan nyaman dilihat oleh pengguna Anda.'],
                ['icon' => 'fa-money', 'title' => 'Harga Transparan', 'description' => 'Estimasi biaya dan timeline disampaikan di awal, tanpa biaya tersembunyi di tengah jalan.'],
                ['icon' => 'fa-clock-o', 'title' => 'Tepat Waktu', 'description' => 'Progress dikerjakan sesuai rencana & dilaporkan secara berkala hingga aplikasi selesai.'],
                ['icon' => 'fa-life-ring', 'title' => 'Support Purna Jual', 'description' => 'Kami tetap mendampingi setelah aplikasi rilis untuk perbaikan, update, dan pengembangan lanjutan.'],
                ['icon' => 'fa-code', 'title' => 'Source Code & Dokumentasi', 'description' => 'Source code dan dokumentasi diserahkan sepenuhnya menjadi milik Anda setelah proyek selesai.'],
            ];
            foreach ($benefits as $i => $row) {
                AppMobileBenefit::create($row + ['order_index' => $i]);
            }
        }

        if (AppMobileService::count() === 0) {
            $services = [
                ['icon' => 'fa-android', 'title' => 'Aplikasi Android Native'],
                ['icon' => 'fa-apple', 'title' => 'Aplikasi iOS Native'],
                ['icon' => 'fa-mobile', 'title' => 'Aplikasi Cross-Platform'],
                ['icon' => 'fa-pencil-square-o', 'title' => 'UI/UX Design Aplikasi'],
                ['icon' => 'fa-plug', 'title' => 'Integrasi API & Backend'],
                ['icon' => 'fa-wrench', 'title' => 'Maintenance & Update'],
                ['icon' => 'fa-cloud-upload', 'title' => 'Publish ke Play Store & App Store'],
                ['icon' => 'fa-bug', 'title' => 'Testing & Quality Assurance'],
            ];
            foreach ($services as $i => $row) {
                AppMobileService::create($row + ['order_index' => $i]);
            }
        }

        if (AppMobileProcessStep::count() === 0) {
            $steps = [
                ['title' => 'Konsultasi & Analisis', 'description' => 'Diskusi kebutuhan & tujuan aplikasi Anda.'],
                ['title' => 'UI/UX Design', 'description' => 'Rancang tampilan & alur pengguna (prototype).'],
                ['title' => 'Development', 'description' => 'Proses coding aplikasi sesuai desain & kebutuhan.'],
                ['title' => 'Testing & QA', 'description' => 'Pengujian fungsi & perbaikan sebelum rilis.'],
                ['title' => 'Deploy & Maintenance', 'description' => 'Publish ke toko aplikasi & dukungan berkelanjutan.'],
            ];
            foreach ($steps as $i => $row) {
                AppMobileProcessStep::create($row + ['order_index' => $i]);
            }
        }

        if (AppMobileTechBadge::count() === 0) {
            $tech = [
                ['icon' => 'fa-mobile', 'label' => 'Flutter'],
                ['icon' => 'fa-mobile', 'label' => 'React Native'],
                ['icon' => 'fa-android', 'label' => 'Kotlin'],
                ['icon' => 'fa-apple', 'label' => 'Swift'],
                ['icon' => 'fa-fire', 'label' => 'Firebase'],
                ['icon' => 'fa-server', 'label' => 'Laravel'],
                ['icon' => 'fa-database', 'label' => 'MySQL'],
                ['icon' => 'fa-exchange', 'label' => 'REST API'],
            ];
            foreach ($tech as $i => $row) {
                AppMobileTechBadge::create($row + ['order_index' => $i]);
            }
        }

        if (AppMobileFaq::count() === 0) {
            $faqs = [
                ['question' => 'Berapa lama waktu pembuatan aplikasi mobile?', 'answer' => 'Tergantung kompleksitas fitur, namun umumnya proyek aplikasi mobile membutuhkan waktu beberapa minggu hingga beberapa bulan sejak desain disetujui.'],
                ['question' => 'Apakah bisa membuat aplikasi untuk Android dan iOS sekaligus?', 'answer' => 'Bisa. Kami dapat mengembangkan aplikasi native untuk masing-masing platform, atau cross-platform agar satu basis kode berjalan di keduanya.'],
                ['question' => 'Apakah source code aplikasi menjadi milik saya?', 'answer' => 'Ya, setelah proyek selesai dan pembayaran diselesaikan, source code beserta dokumentasinya sepenuhnya menjadi milik Anda.'],
                ['question' => 'Apakah ada layanan setelah aplikasi rilis?', 'answer' => 'Ada. Kami menyediakan layanan maintenance, perbaikan bug, dan pengembangan fitur tambahan setelah aplikasi Anda diluncurkan.'],
            ];
            foreach ($faqs as $i => $row) {
                AppMobileFaq::create($row + ['order_index' => $i]);
            }
        }
    }
}
