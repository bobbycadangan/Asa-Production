<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Models\CustomSystemBenefit;
use App\Models\CustomSystemFaq;
use App\Models\CustomSystemPage;
use App\Models\CustomSystemProcessStep;
use App\Models\CustomSystemService;
use App\Models\CustomSystemStat;
use App\Models\CustomSystemTechBadge;
use App\Models\Portfolio;
use App\Models\Service;
use App\Models\Setting;

class CustomSystemController extends Controller
{
    public function index()
    {
        $setting = Setting::current();
        $page = CustomSystemPage::current();

        // Beberapa portofolio ditampilkan sebagai contoh hasil kerja.
        // Kalau kategori "Sistem" / "System" / "Kustom" ada, prioritaskan itu;
        // kalau tidak ada, tetap tampilkan portofolio apa saja yang aktif.
        $portfolios = Portfolio::active()->ordered()->get();
        $systemPortfolios = $portfolios
            ->filter(fn ($p) => $p->category && (str_contains(strtolower($p->category), 'sistem') || str_contains(strtolower($p->category), 'system') || str_contains(strtolower($p->category), 'kustom')))
            ->values();
        $showcasePortfolios = ($systemPortfolios->count() ? $systemPortfolios : $portfolios)->take(4);

        // Dibutuhkan supaya footer di halaman ini sama persis dengan footer landing page.
        $services = Service::active()->ordered()->get();
        $certificates = Certificate::active()->ordered()->get();

        // Konten dinamis khusus halaman ini, bisa diedit lewat halaman admin.
        $stats = CustomSystemStat::active()->ordered()->get();
        $benefits = CustomSystemBenefit::active()->ordered()->get();
        $systemServices = CustomSystemService::active()->ordered()->get();
        $processSteps = CustomSystemProcessStep::active()->ordered()->get();
        $techBadges = CustomSystemTechBadge::active()->ordered()->get();
        $systemFaqs = CustomSystemFaq::active()->ordered()->get();

        return view('solusi.custom-system', compact(
            'setting', 'page', 'showcasePortfolios', 'services', 'certificates',
            'stats', 'benefits', 'systemServices', 'processSteps', 'techBadges', 'systemFaqs'
        ));
    }
}
