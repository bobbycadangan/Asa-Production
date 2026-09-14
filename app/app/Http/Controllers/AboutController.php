<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Models\Service;
use App\Models\Setting;
use App\Models\TeamMember;

class AboutController extends Controller
{
    public function index()
    {
        $setting = Setting::current();
        $team = TeamMember::active()->ordered()->get();

        // Dibutuhkan supaya footer di halaman ini sama persis dengan footer landing page.
        $services = Service::active()->ordered()->get();
        $certificates = Certificate::active()->ordered()->get();

        return view('about', compact('setting', 'team', 'services', 'certificates'));
    }
}
