<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WebsiteStat;
use Illuminate\Http\Request;

class WebsiteStatController extends Controller
{
    public function index()
    {
        $items = WebsiteStat::ordered()->get();

        return view('admin.website-stats.index', compact('items'));
    }

    public function create()
    {
        return view('admin.website-stats.form', ['item' => new WebsiteStat()]);
    }

    public function store(Request $request)
    {
        WebsiteStat::create($this->validated($request));

        return redirect()->route('admin.website-stats.index')->with('success', 'Statistik berhasil ditambahkan.');
    }

    public function edit(WebsiteStat $websiteStat)
    {
        return view('admin.website-stats.form', ['item' => $websiteStat]);
    }

    public function update(Request $request, WebsiteStat $websiteStat)
    {
        $websiteStat->update($this->validated($request));

        return redirect()->route('admin.website-stats.index')->with('success', 'Statistik berhasil diperbarui.');
    }

    public function destroy(WebsiteStat $websiteStat)
    {
        $websiteStat->delete();

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
