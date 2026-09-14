<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AppMobileBenefit;
use App\Models\AppMobileFaq;
use App\Models\AppMobilePage;
use App\Models\AppMobileProcessStep;
use App\Models\AppMobileService;
use App\Models\AppMobileStat;
use App\Models\AppMobileTechBadge;
use Illuminate\Http\Request;

class AppMobilePageController extends Controller
{
    /**
     * Halaman utama pengelolaan "Jasa Pembuatan Aplikasi Mobile": form teks
     * statis (hero, judul section, CTA) + ringkasan tiap daftar konten yang
     * bisa dikelola terpisah (stat, benefit, layanan, proses, teknologi, FAQ).
     */
    public function edit()
    {
        $page = AppMobilePage::current();

        $counts = [
            'stats' => AppMobileStat::count(),
            'benefits' => AppMobileBenefit::count(),
            'services' => AppMobileService::count(),
            'process_steps' => AppMobileProcessStep::count(),
            'tech_badges' => AppMobileTechBadge::count(),
            'faqs' => AppMobileFaq::count(),
        ];

        return view('admin.app-mobile.edit', compact('page', 'counts'));
    }

    public function update(Request $request)
    {
        $page = AppMobilePage::current();

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
            $data['hero_background'] = $request->file('hero_background')->store('app-mobile', 'public');
        } else {
            // Tidak ada file baru diupload -> pertahankan gambar lama, jangan ditimpa null.
            unset($data['hero_background']);
        }

        $page->update($data);

        return back()->with('success', 'Konten halaman berhasil disimpan.');
    }
}
