<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AppMobileStat;
use Illuminate\Http\Request;

class AppMobileStatController extends Controller
{
    public function index()
    {
        $items = AppMobileStat::ordered()->get();

        return view('admin.app-mobile-stats.index', compact('items'));
    }

    public function create()
    {
        return view('admin.app-mobile-stats.form', ['item' => new AppMobileStat()]);
    }

    public function store(Request $request)
    {
        AppMobileStat::create($this->validated($request));

        return redirect()->route('admin.app-mobile-stats.index')->with('success', 'Statistik berhasil ditambahkan.');
    }

    public function edit(AppMobileStat $appMobileStat)
    {
        return view('admin.app-mobile-stats.form', ['item' => $appMobileStat]);
    }

    public function update(Request $request, AppMobileStat $appMobileStat)
    {
        $appMobileStat->update($this->validated($request));

        return redirect()->route('admin.app-mobile-stats.index')->with('success', 'Statistik berhasil diperbarui.');
    }

    public function destroy(AppMobileStat $appMobileStat)
    {
        $appMobileStat->delete();

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
