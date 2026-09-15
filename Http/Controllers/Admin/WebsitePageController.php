<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WebsiteBenefit;
use App\Models\WebsiteFaq;
use App\Models\WebsitePage;
use App\Models\WebsiteProcessStep;
use App\Models\WebsiteService;
use App\Models\WebsiteStat;
use App\Models\WebsiteTechBadge;
use Illuminate\Http\Request;

class WebsitePageController extends Controller
{
    /**
     * Halaman utama pengelolaan "Jasa Pembuatan Website": form teks
     * statis (hero, judul section, CTA) + ringkasan tiap daftar konten yang
     * bisa dikelola terpisah (stat, benefit, layanan, proses, teknologi, FAQ).
     */
    public function edit()
    {
        $page = WebsitePage::current();

        $counts = [
            'stats' => WebsiteStat::count(),
            'benefits' => WebsiteBenefit::count(),
            'services' => WebsiteService::count(),
            'process_steps' => WebsiteProcessStep::count(),
            'tech_badges' => WebsiteTechBadge::count(),
            'faqs' => WebsiteFaq::count(),
        ];

        return view('admin.website.edit', compact('page', 'counts'));
    }

    public function update(Request $request)
    {
        $page = WebsitePage::current();

        $data = $request->validate([
            'hero_eyebrow' => ['required', 'string', 'max:255'],
            'hero_title' => ['required', 'string', 'max:255'],
            'hero_description' => ['nullable', 'string'],
            'hero_background' => ['nullable', 'image', 'max:4096'],
            'whatsapp_message' => ['required', 'string', 'max:255'],
            'why_us_eyebrow' => ['required', 'string', 'max:255'],
            'why_us_title' => ['required', 'string', 'max:255'],
            'why_us_description' => ['nullable', 'string'],
            'services_eyebrow' => ['required', 'string', 'max:255'],
            'services_title' => ['required', 'string', 'max:255'],
            'services_description' => ['nullable', 'string'],
            'process_eyebrow' => ['required', 'string', 'max:255'],
            'process_title' => ['required', 'string', 'max:255'],
            'process_description' => ['nullable', 'string'],
            'tech_eyebrow' => ['required', 'string', 'max:255'],
            'tech_title' => ['required', 'string', 'max:255'],
            'portfolio_eyebrow' => ['required', 'string', 'max:255'],
            'portfolio_title' => ['required', 'string', 'max:255'],
            'portfolio_description' => ['nullable', 'string'],
            'faq_eyebrow' => ['required', 'string', 'max:255'],
            'faq_title' => ['required', 'string', 'max:255'],
            'cta_title' => ['required', 'string', 'max:255'],
            'cta_description' => ['nullable', 'string'],
            'meta_description' => ['nullable', 'string', 'max:500'],
        ]);

        if ($request->hasFile('hero_background')) {
            $data['hero_background'] = $request->file('hero_background')->store('website', 'public');
        } else {
            // Tidak ada file baru diupload -> pertahankan gambar lama, jangan ditimpa null.
            unset($data['hero_background']);
        }

        $page->update($data);

        return back()->with('success', 'Konten halaman berhasil disimpan.');
    }
}
