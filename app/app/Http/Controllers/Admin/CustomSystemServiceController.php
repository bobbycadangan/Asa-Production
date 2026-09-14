<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CustomSystemService;
use Illuminate\Http\Request;

class CustomSystemServiceController extends Controller
{
    public function index()
    {
        $items = CustomSystemService::ordered()->get();

        return view('admin.custom-system-services.index', compact('items'));
    }

    public function create()
    {
        return view('admin.custom-system-services.form', ['item' => new CustomSystemService()]);
    }

    public function store(Request $request)
    {
        CustomSystemService::create($this->validated($request));

        return redirect()->route('admin.custom-system-services.index')->with('success', 'Layanan berhasil ditambahkan.');
    }

    public function edit(CustomSystemService $customSystemService)
    {
        return view('admin.custom-system-services.form', ['item' => $customSystemService]);
    }

    public function update(Request $request, CustomSystemService $customSystemService)
    {
        $customSystemService->update($this->validated($request));

        return redirect()->route('admin.custom-system-services.index')->with('success', 'Layanan berhasil diperbarui.');
    }

    public function destroy(CustomSystemService $customSystemService)
    {
        $customSystemService->delete();

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
