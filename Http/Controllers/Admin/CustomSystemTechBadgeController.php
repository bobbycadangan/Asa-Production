<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CustomSystemTechBadge;
use Illuminate\Http\Request;

class CustomSystemTechBadgeController extends Controller
{
    public function index()
    {
        $items = CustomSystemTechBadge::ordered()->get();

        return view('admin.custom-system-tech-badges.index', compact('items'));
    }

    public function create()
    {
        return view('admin.custom-system-tech-badges.form', ['item' => new CustomSystemTechBadge()]);
    }

    public function store(Request $request)
    {
        CustomSystemTechBadge::create($this->validated($request));

        return redirect()->route('admin.custom-system-tech-badges.index')->with('success', 'Teknologi berhasil ditambahkan.');
    }

    public function edit(CustomSystemTechBadge $customSystemTechBadge)
    {
        return view('admin.custom-system-tech-badges.form', ['item' => $customSystemTechBadge]);
    }

    public function update(Request $request, CustomSystemTechBadge $customSystemTechBadge)
    {
        $customSystemTechBadge->update($this->validated($request));

        return redirect()->route('admin.custom-system-tech-badges.index')->with('success', 'Teknologi berhasil diperbarui.');
    }

    public function destroy(CustomSystemTechBadge $customSystemTechBadge)
    {
        $customSystemTechBadge->delete();

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
