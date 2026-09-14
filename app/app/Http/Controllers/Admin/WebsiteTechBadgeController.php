<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WebsiteTechBadge;
use Illuminate\Http\Request;

class WebsiteTechBadgeController extends Controller
{
    public function index()
    {
        $items = WebsiteTechBadge::ordered()->get();

        return view('admin.website-tech-badges.index', compact('items'));
    }

    public function create()
    {
        return view('admin.website-tech-badges.form', ['item' => new WebsiteTechBadge()]);
    }

    public function store(Request $request)
    {
        WebsiteTechBadge::create($this->validated($request));

        return redirect()->route('admin.website-tech-badges.index')->with('success', 'Teknologi berhasil ditambahkan.');
    }

    public function edit(WebsiteTechBadge $websiteTechBadge)
    {
        return view('admin.website-tech-badges.form', ['item' => $websiteTechBadge]);
    }

    public function update(Request $request, WebsiteTechBadge $websiteTechBadge)
    {
        $websiteTechBadge->update($this->validated($request));

        return redirect()->route('admin.website-tech-badges.index')->with('success', 'Teknologi berhasil diperbarui.');
    }

    public function destroy(WebsiteTechBadge $websiteTechBadge)
    {
        $websiteTechBadge->delete();

        return back()->with('success', 'Teknologi berhasil dihapus.');
    }

    private function validated(Request $request): array
    {
        $data = $request->validate([
            'icon' => ['nullable', 'string', 'max:255'],
            'label' => ['required', 'string', 'max:255'],
            'order_index' => ['nullable', 'integer'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $data['is_active'] = $request->boolean('is_active');

        return $data;
    }
}
