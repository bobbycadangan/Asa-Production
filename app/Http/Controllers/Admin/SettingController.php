<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function edit()
    {
        $setting = Setting::current();

        return view('admin.settings.edit', compact('setting'));
    }

    public function update(Request $request)
    {
        $setting = Setting::current();

        $data = $request->validate([
            'site_title' => ['required', 'string', 'max:255'],
            'brand_slogan' => ['nullable', 'string', 'max:255'],
            'promo_enabled' => ['nullable', 'boolean'],
            'promo_text' => ['nullable', 'string', 'max:255'],
            'blog_section_enabled' => ['nullable', 'boolean'],
            'hero_title' => ['required', 'string', 'max:255'],
            'hero_subtitle' => ['nullable', 'string', 'max:255'],
            'about_title' => ['required', 'string', 'max:255'],
            'about_description' => ['nullable', 'string'],
            'about_label' => ['nullable', 'string', 'max:255'],
            'about_cta_text' => ['nullable', 'string', 'max:255'],
            'about_cta_link' => ['nullable', 'string', 'max:255'],
            'services_title' => ['required', 'string', 'max:255'],
            'services_description' => ['nullable', 'string'],
            'whatsapp_number' => ['required', 'string', 'max:50'],
            'whatsapp_message' => ['nullable', 'string', 'max:255'],
            'footer_title' => ['required', 'string', 'max:255'],
            'footer_subtitle' => ['nullable', 'string', 'max:255'],
            'footer_cta_text' => ['nullable', 'string', 'max:255'],
            'footer_cta_link' => ['nullable', 'string', 'max:255'],
            'footer_address' => ['nullable', 'string', 'max:255'],
            'footer_email' => ['nullable', 'email', 'max:255'],
            'social_facebook' => ['nullable', 'string', 'max:255'],
            'social_instagram' => ['nullable', 'string', 'max:255'],
            'social_tiktok' => ['nullable', 'string', 'max:255'],
            'social_linkedin' => ['nullable', 'string', 'max:255'],
            'social_youtube' => ['nullable', 'string', 'max:255'],
            'social_x' => ['nullable', 'string', 'max:255'],
            'logo' => ['nullable', 'file', 'mimetypes:image/png,image/jpeg,image/gif,image/webp,image/svg+xml,video/mp4,video/webm', 'max:10240'],
            'favicon' => ['nullable', 'image', 'max:1024'],
            'services_bg' => ['nullable', 'image', 'max:4096'],
            'footer_bg' => ['nullable', 'image', 'max:4096'],
            'hero_video' => ['nullable', 'file', 'mimetypes:video/mp4,video/webm', 'max:51200'],
            'about_image' => ['nullable', 'image', 'max:4096'],
        ]);

        $data['promo_enabled'] = $request->boolean('promo_enabled');
        $data['blog_section_enabled'] = $request->boolean('blog_section_enabled');

        foreach (['logo', 'favicon', 'services_bg', 'footer_bg', 'hero_video', 'about_image'] as $file) {
            if ($request->hasFile($file)) {
                $data[$file] = $request->file($file)->store('settings', 'public');
            } else {
                unset($data[$file]);
            }
        }

        $setting->update($data);

        return back()->with('success', 'Pengaturan berhasil disimpan.');
    }
}
