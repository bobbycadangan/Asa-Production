<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use App\Models\ContactMessage;
use App\Models\Faq;
use App\Models\Partner;
use App\Models\Portfolio;
use App\Models\Post;
use App\Models\Service;
use App\Models\TeamMember;
use App\Models\Testimonial;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'team' => TeamMember::count(),
            'services' => Service::count(),
            'portfolios' => Portfolio::count(),
            'posts' => Post::count(),
            'testimonials' => Testimonial::count(),
            'partners' => Partner::count(),
            'certificates' => Certificate::count(),
            'faqs' => Faq::count(),
            'contact_messages' => ContactMessage::count(),
            'unread_contact_messages' => ContactMessage::unread()->count(),
        ];

        $recentTestimonials = Testimonial::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentTestimonials'));
    }
}
