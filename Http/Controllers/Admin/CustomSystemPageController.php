<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CustomSystemBenefit;
use App\Models\CustomSystemFaq;
use App\Models\CustomSystemPage;
use App\Models\CustomSystemProcessStep;
use App\Models\CustomSystemService;
use App\Models\CustomSystemStat;
use App\Models\CustomSystemTechBadge;
use Illuminate\Http\Request;

class CustomSystemPageController extends Controller
{
    /**
     * Halaman utama pengelolaan "Jasa Pembuatan Sistem Kustom": form teks
     * statis (hero, judul section, CTA) + ringkasan tiap daftar konten yang
     * bisa dikelola terpisah (stat, benefit, layanan, proses, teknologi, FAQ).
     */
    public function edit()
    {
        $page = CustomSystemPage::current();

        $counts = [
            'stats' => CustomSystemStat::count(),
            'benefits' => CustomSystemBenefit::count(),
            'services' => CustomSystemService::count(),
            'process_steps' => CustomSystemProcessStep::count(),
            'tech_badges' => CustomSystemTechBadge::count(),
            'faqs' => CustomSystemFaq::count(),
        ];

        return view('admin.custom-system.edit', compact('page', 'counts'));
    }

    public function update(Request $request)
    {
        $page = CustomSystemPage::current();

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
            $data['hero_background'] = $request->file('hero_background')->store('custom-system', 'public');
        } else {
            // Tidak ada file baru diupload -> pertahankan gambar lama, jangan ditimpa null.
            unset($data['hero_background']);
        }

        $page->update($data);

        return back()->with('success', 'Konten halaman berhasil disimpan.');
    }
}
