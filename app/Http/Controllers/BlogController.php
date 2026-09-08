<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Models\Post;
use App\Models\Service;
use App\Models\Setting;

class BlogController extends Controller
{
    public function index()
    {
        $setting = Setting::current();
        $posts = Post::published()->latestFirst()->paginate(9);
        // Dibutuhkan supaya footer di halaman blog sama persis dengan footer landing page.
        $services = Service::active()->ordered()->get();
        $certificates = Certificate::active()->ordered()->get();

        return view('blog.index', compact('setting', 'posts', 'services', 'certificates'));
    }

    public function show(string $slug)
    {
        $setting = Setting::current();
        $post = Post::published()->where('slug', $slug)->firstOrFail();

        $related = Post::published()
            ->where('id', '!=', $post->id)
            ->latestFirst()
            ->limit(3)
            ->get();

        // Dibutuhkan supaya footer di halaman blog sama persis dengan footer landing page.
        $services = Service::active()->ordered()->get();
        $certificates = Certificate::active()->ordered()->get();

        return view('blog.show', compact('setting', 'post', 'related', 'services', 'certificates'));
    }

    public function like(Post $post)
    {
        $post->increment('likes');

        return response()->json(['likes' => $post->likes]);
    }
}
