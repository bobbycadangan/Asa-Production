<?php

namespace Database\Seeders;

use App\Models\CustomSystemBenefit;
use App\Models\CustomSystemFaq;
use App\Models\CustomSystemPage;
use App\Models\CustomSystemProcessStep;
use App\Models\CustomSystemService;
use App\Models\CustomSystemStat;
use App\Models\CustomSystemTechBadge;
use Illuminate\Database\Seeder;

class CustomSystemPageSeeder extends Seeder
{
    /**
     * Mengisi konten default halaman "Jasa Pembuatan Sistem Kustom" supaya
     * halaman tidak kosong setelah migrasi, dan bisa langsung diedit dari
     * admin. Aman dijalankan berulang kali (idempotent) karena pakai
     * updateOrCreate/cek count().
     */
    public function run(): void
    {
        CustomSystemPage::updateOrCreate(['id' => 1], [
            'hero_eyebrow' => 'Solusi Kami',
            'hero_title' => 'Jasa Pembuatan Sistem Kustom Sesuai Kebutuhan Bisnis Anda',
            'hero_description' => 'Wujudkan proses bisnis Anda menjadi sistem digital yang rapi, efisien, dan mudah dikelola. Tim kami membantu dari tahap analisis kebutuhan, desain sistem, development, hingga sistem siap dipakai sehari-hari.',
            'whatsapp_message' => 'Halo, saya ingin konsultasi pembuatan sistem kustom',
            'why_us_eyebrow' => 'Kenapa Pilih Kami',
            'why_us_title' => 'Partner Terpercaya untuk Sistem Bisnis Anda',
            'why_us_description' => 'Kami membantu proses pembuatan sistem dari analisis kebutuhan sampai sistem siap pakai, dengan komunikasi yang transparan di setiap tahap.',
            'services_eyebrow' => 'Layanan Kami',
            'services_title' => 'Apa Saja yang Kami Kerjakan',
            'services_description' => 'Cakupan layanan pembuatan sistem kustom, dari analisis kebutuhan sampai sistem siap dipakai dan dilatihkan ke tim Anda.',
            'process_eyebrow' => 'Cara Kerja',
            'process_title' => 'Proses Pengembangan Sistem Kami',
            'process_description' => 'Alur kerja yang jelas dari awal konsultasi hingga sistem Anda siap digunakan.',
            'tech_eyebrow' => 'Teknologi',
            'tech_title' => 'Teknologi yang Kami Gunakan',
            'portfolio_eyebrow' => 'Hasil Kerja',
            'portfolio_title' => 'Contoh Sistem yang Pernah Kami Buat',
            'portfolio_description' => 'Sebagian portofolio sistem kustom yang sudah kami kerjakan untuk klien kami.',
            'faq_eyebrow' => 'F.A.Q',
            'faq_title' => 'Pertanyaan yang Sering Diajukan',
            'cta_title' => 'Siap Membuat Sistem Kustom Anda?',
            'cta_description' => 'Ceritakan proses bisnis dan kebutuhan sistem Anda, tim kami siap membantu mewujudkannya dari konsep hingga sistem siap dipakai.',
            'meta_description' => 'Jasa pembuatan sistem kustom (aplikasi web, dashboard, sistem internal) sesuai kebutuhan bisnis. Dari analisis, desain, development, hingga sistem siap dipakai.',
        ]);

        if (CustomSystemStat::count() === 0) {
            $stats = [
                ['value' => '30+', 'label' => 'Sistem Dibangun'],
                ['value' => 'Web Based', 'label' => 'Bisa Diakses Dari Mana Saja'],
                ['value' => '100%', 'label' => 'Source Code Milik Anda'],
                ['value' => 'Gratis', 'label' => 'Konsultasi Awal'],
            ];
            foreach ($stats as $i => $row) {
                CustomSystemStat::create($row + ['order_index' => $i]);
            }
        }

        if (CustomSystemBenefit::count() === 0) {
            $benefits = [
                ['icon' => 'fa-users', 'title' => 'Tim Berpengalaman', 'description' => 'Dikerjakan oleh developer yang terbiasa membangun sistem untuk berbagai jenis proses bisnis.'],
                ['icon' => 'fa-cogs', 'title' => 'Sesuai Kebutuhan', 'description' => 'Sistem dirancang mengikuti alur kerja Anda, bukan sebaliknya Anda yang menyesuaikan sistem template.'],
                ['icon' => 'fa-money', 'title' => 'Harga Transparan', 'description' => 'Estimasi biaya dan timeline disampaikan di awal, tanpa biaya tersembunyi di tengah jalan.'],
                ['icon' => 'fa-clock-o', 'title' => 'Tepat Waktu', 'description' => 'Progress dikerjakan sesuai rencana & dilaporkan secara berkala hingga sistem selesai.'],
                ['icon' => 'fa-life-ring', 'title' => 'Support Purna Jual', 'description' => 'Kami tetap mendampingi setelah sistem live untuk perbaikan, update, dan pengembangan lanjutan.'],
                ['icon' => 'fa-code', 'title' => 'Source Code & Dokumentasi', 'description' => 'Source code dan dokumentasinya diserahkan sepenuhnya menjadi milik Anda setelah proyek selesai.'],
            ];
            foreach ($benefits as $i => $row) {
                CustomSystemBenefit::create($row + ['order_index' => $i]);
            }
        }

        if (CustomSystemService::count() === 0) {
            $services = [
                ['icon' => 'fa-dashboard', 'title' => 'Dashboard & Sistem Internal'],
                ['icon' => 'fa-database', 'title' => 'Sistem Manajemen Data'],
                ['icon' => 'fa-sitemap', 'title' => 'Sistem Informasi Perusahaan'],
                ['icon' => 'fa-shopping-cart', 'title' => 'Sistem Penjualan & Inventaris'],
                ['icon' => 'fa-plug', 'title' => 'Integrasi API & Sistem Pihak Ketiga'],
                ['icon' => 'fa-lock', 'title' => 'Manajemen Hak Akses & Role'],
                ['icon' => 'fa-line-chart', 'title' => 'Laporan & Analitik Otomatis'],
                ['icon' => 'fa-wrench', 'title' => 'Maintenance & Pengembangan Lanjutan'],
            ];
            foreach ($services as $i => $row) {
                CustomSystemService::create($row + ['order_index' => $i]);
            }
        }

        if (CustomSystemProcessStep::count() === 0) {
            $steps = [
                ['title' => 'Konsultasi & Analisis Kebutuhan', 'description' => 'Diskusi proses bisnis, alur kerja, dan tujuan sistem Anda.'],
                ['title' => 'Perancangan Sistem', 'description' => 'Rancang struktur data, alur fitur, dan tampilan (prototype).'],
                ['title' => 'Development', 'description' => 'Proses coding sistem sesuai rancangan & kebutuhan.'],
                ['title' => 'Testing & QA', 'description' => 'Pengujian fungsi & perbaikan sebelum sistem digunakan.'],
                ['title' => 'Deploy & Maintenance', 'description' => 'Sistem online/siap pakai & dukungan berkelanjutan.'],
            ];
            foreach ($steps as $i => $row) {
                CustomSystemProcessStep::create($row + ['order_index' => $i]);
            }
        }

        if (CustomSystemTechBadge::count() === 0) {
            $tech = [
                ['icon' => 'fa-server', 'label' => 'Laravel'],
                ['icon' => 'fa-database', 'label' => 'MySQL'],
                ['icon' => 'fa-code', 'label' => 'PHP'],
                ['icon' => 'fa-html5', 'label' => 'HTML/CSS'],
                ['icon' => 'fa-bolt', 'label' => 'JavaScript'],
                ['icon' => 'fa-cloud', 'label' => 'VPS / Cloud Hosting'],
                ['icon' => 'fa-exchange', 'label' => 'REST API'],
                ['icon' => 'fa-lock', 'label' => 'Role & Permission'],
            ];
            foreach ($tech as $i => $row) {
                CustomSystemTechBadge::create($row + ['order_index' => $i]);
            }
        }

        if (CustomSystemFaq::count() === 0) {
            $faqs = [
                ['question' => 'Berapa lama waktu pembuatan sistem kustom?', 'answer' => 'Tergantung kompleksitas fitur, namun umumnya proyek sistem kustom membutuhkan waktu beberapa minggu hingga beberapa bulan sejak kebutuhan disepakati.'],
                ['question' => 'Sistem seperti apa saja yang bisa dibuat?', 'answer' => 'Mulai dari sistem manajemen data, dashboard internal, sistem penjualan/inventaris, sistem absensi, hingga sistem informasi khusus sesuai kebutuhan bisnis Anda.'],
                ['question' => 'Apakah source code sistem menjadi milik saya?', 'answer' => 'Ya, setelah proyek selesai dan pembayaran diselesaikan, source code beserta dokumentasinya sepenuhnya menjadi milik Anda.'],
                ['question' => 'Apakah ada pelatihan penggunaan sistem?', 'answer' => 'Ada. Kami memberikan pendampingan dan pelatihan singkat kepada tim Anda agar sistem bisa langsung digunakan dengan lancar.'],
                ['question' => 'Apakah ada layanan setelah sistem selesai?', 'answer' => 'Ada. Kami menyediakan layanan maintenance, perbaikan bug, dan pengembangan fitur tambahan setelah sistem Anda digunakan.'],
            ];
            foreach ($faqs as $i => $row) {
                CustomSystemFaq::create($row + ['order_index' => $i]);
            }
        }
    }
}
