<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AppMobileTechBadge;
use Illuminate\Http\Request;

class AppMobileTechBadgeController extends Controller
{
    public function index()
    {
        $items = AppMobileTechBadge::ordered()->get();

        return view('admin.app-mobile-tech-badges.index', compact('items'));
    }

    public function create()
    {
        return view('admin.app-mobile-tech-badges.form', ['item' => new AppMobileTechBadge()]);
    }

    public function store(Request $request)
    {
        AppMobileTechBadge::create($this->validated($request));

        return redirect()->route('admin.app-mobile-tech-badges.index')->with('success', 'Teknologi berhasil ditambahkan.');
    }

    public function edit(AppMobileTechBadge $appMobileTechBadge)
    {
        return view('admin.app-mobile-tech-badges.form', ['item' => $appMobileTechBadge]);
    }

    public function update(Request $request, AppMobileTechBadge $appMobileTechBadge)
    {
        $appMobileTechBadge->update($this->validated($request));

        return redirect()->route('admin.app-mobile-tech-badges.index')->with('success', 'Teknologi berhasil diperbarui.');
    }

    public function destroy(AppMobileTechBadge $appMobileTechBadge)
    {
        $appMobileTechBadge->delete();

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
