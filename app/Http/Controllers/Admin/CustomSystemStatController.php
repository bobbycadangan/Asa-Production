<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CustomSystemStat;
use Illuminate\Http\Request;

class CustomSystemStatController extends Controller
{
    public function index()
    {
        $items = CustomSystemStat::ordered()->get();

        return view('admin.custom-system-stats.index', compact('items'));
    }

    public function create()
    {
        return view('admin.custom-system-stats.form', ['item' => new CustomSystemStat()]);
    }

    public function store(Request $request)
    {
        CustomSystemStat::create($this->validated($request));

        return redirect()->route('admin.custom-system-stats.index')->with('success', 'Statistik berhasil ditambahkan.');
    }

    public function edit(CustomSystemStat $customSystemStat)
    {
        return view('admin.custom-system-stats.form', ['item' => $customSystemStat]);
    }

    public function update(Request $request, CustomSystemStat $customSystemStat)
    {
        $customSystemStat->update($this->validated($request));

        return redirect()->route('admin.custom-system-stats.index')->with('success', 'Statistik berhasil diperbarui.');
    }

    public function destroy(CustomSystemStat $customSystemStat)
    {
        $customSystemStat->delete();

        return back()->with('success', 'Statistik berhasil dihapus.');
    }

    private function validated(Request $request): array
    {
        $data = $request->validate([
            'value' => ['required', 'string', 'max:255'],
            'label' => ['required', 'string', 'max:255'],
            'order_index' => ['nullable', 'integer'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $data['is_active'] = $request->boolean('is_active');

        return $data;
    }
}
