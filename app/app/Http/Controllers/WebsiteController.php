<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Models\Portfolio;
use App\Models\Service;
use App\Models\Setting;
use App\Models\WebsiteBenefit;
use App\Models\WebsiteFaq;
use App\Models\WebsitePage;
use App\Models\WebsiteProcessStep;
use App\Models\WebsiteService;
use App\Models\WebsiteStat;
use App\Models\WebsiteTechBadge;

class WebsiteController extends Controller
{
    public function index()
    {
        $setting = Setting::current();
        $page = WebsitePage::current();

        // Beberapa portofolio ditampilkan sebagai contoh hasil kerja.
        // Kalau kategori "Website" / "Web" ada, prioritaskan itu; kalau
        // tidak ada, tetap tampilkan portofolio apa saja yang aktif.
        $portfolios = Portfolio::active()->ordered()->get();
        $webPortfolios = $portfolios
            ->filter(fn ($p) => $p->category && str_contains(strtolower($p->category), 'web'))
            ->values();
        $showcasePortfolios = ($webPortfolios->count() ? $webPortfolios : $portfolios)->take(4);

        // Dibutuhkan supaya footer di halaman ini sama persis dengan footer landing page.
        $services = Service::active()->ordered()->get();
        $certificates = Certificate::active()->ordered()->get();

        // Konten dinamis khusus halaman ini, bisa diedit lewat halaman admin.
        $stats = WebsiteStat::active()->ordered()->get();
        $benefits = WebsiteBenefit::active()->ordered()->get();
        $websiteServices = WebsiteService::active()->ordered()->get();
        $processSteps = WebsiteProcessStep::active()->ordered()->get();
        $techBadges = WebsiteTechBadge::active()->ordered()->get();
        $websiteFaqs = WebsiteFaq::active()->ordered()->get();

        return view('solusi.website', compact(
            'setting', 'page', 'showcasePortfolios', 'services', 'certificates',
            'stats', 'benefits', 'websiteServices', 'processSteps', 'techBadges', 'websiteFaqs'
        ));
    }
}
