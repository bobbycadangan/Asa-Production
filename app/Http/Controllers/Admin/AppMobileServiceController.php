<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AppMobileService;
use Illuminate\Http\Request;

class AppMobileServiceController extends Controller
{
    public function index()
    {
        $items = AppMobileService::ordered()->get();

        return view('admin.app-mobile-services.index', compact('items'));
    }

    public function create()
    {
        return view('admin.app-mobile-services.form', ['item' => new AppMobileService()]);
    }

    public function store(Request $request)
    {
        AppMobileService::create($this->validated($request));

        return redirect()->route('admin.app-mobile-services.index')->with('success', 'Layanan berhasil ditambahkan.');
    }

    public function edit(AppMobileService $appMobileService)
    {
        return view('admin.app-mobile-services.form', ['item' => $appMobileService]);
    }

    public function update(Request $request, AppMobileService $appMobileService)
    {
        $appMobileService->update($this->validated($request));

        return redirect()->route('admin.app-mobile-services.index')->with('success', 'Layanan berhasil diperbarui.');
    }

    public function destroy(AppMobileService $appMobileService)
    {
        $appMobileService->delete();

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
