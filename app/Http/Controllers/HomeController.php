<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Models\Faq;
use App\Models\Partner;
use App\Models\Portfolio;
use App\Models\Post;
use App\Models\Service;
use App\Models\Setting;
use App\Models\TeamMember;
use App\Models\Testimonial;

class HomeController extends Controller
{
    public function index()
    {
        $setting = Setting::current();
        $team = TeamMember::active()->ordered()->get();
        $services = Service::active()->ordered()->get();
        // Landing page hanya menampilkan 5 portofolio terbaik (sesuai urutan admin).
        $portfolios = Portfolio::active()->ordered()->take(5)->get();
        $testimonials = Testimonial::active()->ordered()->get();
        $partners = Partner::active()->ordered()->get();
        $certificates = Certificate::active()->ordered()->get();
        $faqs = Faq::active()->ordered()->get();

        // Bagian "Artikel Terbaru" di landing page: maks 3 artikel, hanya jika diaktifkan di admin.
        $latestPosts = $setting->blog_section_enabled
            ? Post::published()->latestFirst()->take(3)->get()
            : collect();

        return view('home', compact(
            'setting', 'team', 'services', 'portfolios', 'testimonials', 'partners', 'certificates', 'faqs', 'latestPosts'
        ));
    }
}
