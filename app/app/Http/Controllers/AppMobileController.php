<?php

namespace App\Http\Controllers;

use App\Models\AppMobileBenefit;
use App\Models\AppMobileFaq;
use App\Models\AppMobilePage;
use App\Models\AppMobileProcessStep;
use App\Models\AppMobileService;
use App\Models\AppMobileStat;
use App\Models\AppMobileTechBadge;
use App\Models\Certificate;
use App\Models\Portfolio;
use App\Models\Service;
use App\Models\Setting;

class AppMobileController extends Controller
{
    public function index()
    {
        $setting = Setting::current();
        $page = AppMobilePage::current();

        // Beberapa portofolio ditampilkan sebagai contoh hasil kerja.
        // Kalau kategori "Aplikasi" / "App" ada, prioritaskan itu; kalau
        // tidak ada, tetap tampilkan portofolio apa saja yang aktif.
        $portfolios = Portfolio::active()->ordered()->get();
        $appPortfolios = $portfolios
            ->filter(fn ($p) => $p->category && str_contains(strtolower($p->category), 'app'))
            ->values();
        $showcasePortfolios = ($appPortfolios->count() ? $appPortfolios : $portfolios)->take(4);

        // Dibutuhkan supaya footer di halaman ini sama persis dengan footer landing page.
        $services = Service::active()->ordered()->get();
        $certificates = Certificate::active()->ordered()->get();

        // Konten dinamis khusus halaman ini, bisa diedit lewat halaman admin.
        $stats = AppMobileStat::active()->ordered()->get();
        $benefits = AppMobileBenefit::active()->ordered()->get();
        $appServices = AppMobileService::active()->ordered()->get();
        $processSteps = AppMobileProcessStep::active()->ordered()->get();
        $techBadges = AppMobileTechBadge::active()->ordered()->get();
        $appFaqs = AppMobileFaq::active()->ordered()->get();

        return view('solusi.app-mobile', compact(
            'setting', 'page', 'showcasePortfolios', 'services', 'certificates',
            'stats', 'benefits', 'appServices', 'processSteps', 'techBadges', 'appFaqs'
        ));
    }
}
