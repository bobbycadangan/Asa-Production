<?php

namespace Database\Seeders;

use App\Models\WebsiteBenefit;
use App\Models\WebsiteFaq;
use App\Models\WebsitePage;
use App\Models\WebsiteProcessStep;
use App\Models\WebsiteService;
use App\Models\WebsiteStat;
use App\Models\WebsiteTechBadge;
use Illuminate\Database\Seeder;

class WebsitePageSeeder extends Seeder
{
    /**
     * Mengisi konten default halaman "Jasa Pembuatan Website" supaya
     * halaman tidak kosong setelah migrasi, dan bisa langsung diedit dari
     * admin. Aman dijalankan berulang kali (idempotent) karena pakai
     * updateOrCreate/cek count().
     */
    public function run(): void
    {
        WebsitePage::updateOrCreate(['id' => 1], [
            'hero_eyebrow' => 'Solusi Kami',
            'hero_title' => 'Jasa Pembuatan Website Profesional untuk Bisnis Anda',
            'hero_description' => 'Wujudkan website perusahaan, landing page, atau toko online yang cepat, aman, dan mudah dikelola. Tim kami membantu Anda dari tahap konsultasi, desain, development, hingga website Anda live.',
            'whatsapp_message' => 'Halo, saya ingin konsultasi pembuatan website',
            'why_us_eyebrow' => 'Kenapa Pilih Kami',
            'why_us_title' => 'Partner Terpercaya untuk Website Bisnis Anda',
            'why_us_description' => 'Kami membantu proses pembuatan website dari nol sampai live, dengan komunikasi yang transparan di setiap tahap.',
            'services_eyebrow' => 'Layanan Kami',
            'services_title' => 'Apa Saja yang Kami Kerjakan',
            'services_description' => 'Cakupan layanan pembuatan website, dari desain sampai website tayang secara online.',
            'process_eyebrow' => 'Cara Kerja',
            'process_title' => 'Proses Pembuatan Website Kami',
            'process_description' => 'Alur kerja yang jelas dari awal konsultasi hingga website Anda siap digunakan.',
            'tech_eyebrow' => 'Teknologi',
            'tech_title' => 'Teknologi yang Kami Gunakan',
            'portfolio_eyebrow' => 'Hasil Kerja',
            'portfolio_title' => 'Contoh Website yang Pernah Kami Buat',
            'portfolio_description' => 'Sebagian portofolio website yang sudah kami kerjakan untuk klien kami.',
            'faq_eyebrow' => 'F.A.Q',
            'faq_title' => 'Pertanyaan yang Sering Diajukan',
            'cta_title' => 'Siap Membuat Website Anda?',
            'cta_description' => 'Ceritakan kebutuhan website Anda, tim kami siap membantu mewujudkannya dari konsep hingga live.',
            'meta_description' => 'Jasa pembuatan website perusahaan, landing page, dan toko online. Dari konsultasi, desain, development, hingga website Anda live.',
        ]);

        if (WebsiteStat::count() === 0) {
            $stats = [
                ['value' => '120+', 'label' => 'Website Diluncurkan'],
                ['value' => 'Responsive', 'label' => 'Tampil Rapi di HP & Desktop'],
                ['value' => '100%', 'label' => 'Source Code Milik Anda'],
                ['value' => 'Gratis', 'label' => 'Konsultasi Awal'],
            ];
            foreach ($stats as $i => $row) {
                WebsiteStat::create($row + ['order_index' => $i]);
            }
        }

        if (WebsiteBenefit::count() === 0) {
            $benefits = [
                ['icon' => 'fa-users', 'title' => 'Tim Berpengalaman', 'description' => 'Dikerjakan oleh developer & desainer yang terbiasa membangun website untuk berbagai jenis bisnis.'],
                ['icon' => 'fa-paint-brush', 'title' => 'Desain Modern & Responsif', 'description' => 'Tampilan website dirancang rapi di berbagai ukuran layar, dari HP sampai desktop.'],
                ['icon' => 'fa-money', 'title' => 'Harga Transparan', 'description' => 'Estimasi biaya dan timeline disampaikan di awal, tanpa biaya tersembunyi di tengah jalan.'],
                ['icon' => 'fa-clock-o', 'title' => 'Tepat Waktu', 'description' => 'Progress dikerjakan sesuai rencana & dilaporkan secara berkala hingga website selesai.'],
                ['icon' => 'fa-life-ring', 'title' => 'Support Purna Jual', 'description' => 'Kami tetap mendampingi setelah website live untuk perbaikan, update, dan pengembangan lanjutan.'],
                ['icon' => 'fa-code', 'title' => 'Source Code & Dokumentasi', 'description' => 'Source code dan dokumentasi diserahkan sepenuhnya menjadi milik Anda setelah proyek selesai.'],
            ];
            foreach ($benefits as $i => $row) {
                WebsiteBenefit::create($row + ['order_index' => $i]);
            }
        }

        if (WebsiteService::count() === 0) {
            $services = [
                ['icon' => 'fa-building', 'title' => 'Website Company Profile'],
                ['icon' => 'fa-shopping-cart', 'title' => 'Toko Online / E-Commerce'],
                ['icon' => 'fa-file-text-o', 'title' => 'Landing Page'],
                ['icon' => 'fa-newspaper-o', 'title' => 'Website Berita & Blog'],
                ['icon' => 'fa-cogs', 'title' => 'Sistem/Aplikasi Web Custom'],
                ['icon' => 'fa-pencil-square-o', 'title' => 'UI/UX Design Website'],
                ['icon' => 'fa-wrench', 'title' => 'Maintenance & Update'],
                ['icon' => 'fa-line-chart', 'title' => 'Optimasi SEO Dasar'],
            ];
            foreach ($services as $i => $row) {
                WebsiteService::create($row + ['order_index' => $i]);
            }
        }

        if (WebsiteProcessStep::count() === 0) {
            $steps = [
                ['title' => 'Konsultasi & Analisis', 'description' => 'Diskusi kebutuhan & tujuan website Anda.'],
                ['title' => 'UI/UX Design', 'description' => 'Rancang tampilan & alur halaman (mockup).'],
                ['title' => 'Development', 'description' => 'Proses coding website sesuai desain & kebutuhan.'],
                ['title' => 'Testing & QA', 'description' => 'Pengujian fungsi & perbaikan sebelum live.'],
                ['title' => 'Deploy & Maintenance', 'description' => 'Publish website & dukungan berkelanjutan.'],
            ];
            foreach ($steps as $i => $row) {
                WebsiteProcessStep::create($row + ['order_index' => $i]);
            }
        }

        if (WebsiteTechBadge::count() === 0) {
            $tech = [
                ['icon' => 'fa-code', 'label' => 'Laravel'],
                ['icon' => 'fa-code', 'label' => 'PHP'],
                ['icon' => 'fa-html5', 'label' => 'HTML5'],
                ['icon' => 'fa-css3', 'label' => 'CSS3'],
                ['icon' => 'fa-database', 'label' => 'MySQL'],
                ['icon' => 'fa-server', 'label' => 'VPS/Cloud Hosting'],
                ['icon' => 'fa-exchange', 'label' => 'REST API'],
                ['icon' => 'fa-lock', 'label' => 'SSL/HTTPS'],
            ];
            foreach ($tech as $i => $row) {
                WebsiteTechBadge::create($row + ['order_index' => $i]);
            }
        }

        if (WebsiteFaq::count() === 0) {
            $faqs = [
                ['question' => 'Berapa lama waktu pembuatan website?', 'answer' => 'Untuk website profil sederhana biasanya selesai dalam 1-2 minggu. Untuk sistem atau toko online dengan fitur lebih kompleks, waktu pengerjaan sekitar 3-8 minggu tergantung kebutuhan.'],
                ['question' => 'Apakah website yang dibuat responsif di HP?', 'answer' => 'Ya, semua website yang kami buat dirancang responsif sehingga tampil rapi di HP, tablet, maupun desktop.'],
                ['question' => 'Apakah source code website menjadi milik saya?', 'answer' => 'Ya, setelah proyek selesai dan pembayaran diselesaikan, source code beserta dokumentasinya sepenuhnya menjadi milik Anda.'],
                ['question' => 'Apakah saya bisa mengelola konten website sendiri?', 'answer' => 'Bisa. Kami menyediakan panduan penggunaan dan pendampingan singkat agar Anda bisa mengelola konten website sendiri lewat halaman admin, tanpa harus paham coding.'],
                ['question' => 'Apakah ada layanan setelah website live?', 'answer' => 'Ada. Kami menyediakan layanan maintenance, perbaikan bug, dan pengembangan fitur tambahan setelah website Anda diluncurkan.'],
            ];
            foreach ($faqs as $i => $row) {
                WebsiteFaq::create($row + ['order_index' => $i]);
            }
        }
    }
}
