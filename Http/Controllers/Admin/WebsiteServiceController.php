<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WebsiteService;
use Illuminate\Http\Request;

class WebsiteServiceController extends Controller
{
    public function index()
    {
        $items = WebsiteService::ordered()->get();

        return view('admin.website-services.index', compact('items'));
    }

    public function create()
    {
        return view('admin.website-services.form', ['item' => new WebsiteService()]);
    }

    public function store(Request $request)
    {
        WebsiteService::create($this->validated($request));

        return redirect()->route('admin.website-services.index')->with('success', 'Layanan berhasil ditambahkan.');
    }

    public function edit(WebsiteService $websiteService)
    {
        return view('admin.website-services.form', ['item' => $websiteService]);
    }

    public function update(Request $request, WebsiteService $websiteService)
    {
        $websiteService->update($this->validated($request));

        return redirect()->route('admin.website-services.index')->with('success', 'Layanan berhasil diperbarui.');
    }

    public function destroy(WebsiteService $websiteService)
    {
        $websiteService->delete();

        return back()->with('success', 'Layanan berhasil dihapus.');
    }

    private function validated(Request $request): array
    {
        $data = $request->validate([
            'icon' => ['nullable', 'string', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'order_index' => ['nullable', 'integer'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $data['is_active'] = $request->boolean('is_active');

        return $data;
    }
}
