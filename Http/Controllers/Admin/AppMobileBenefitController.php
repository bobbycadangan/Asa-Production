<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AppMobileBenefit;
use Illuminate\Http\Request;

class AppMobileBenefitController extends Controller
{
    public function index()
    {
        $items = AppMobileBenefit::ordered()->get();

        return view('admin.app-mobile-benefits.index', compact('items'));
    }

    public function create()
    {
        return view('admin.app-mobile-benefits.form', ['item' => new AppMobileBenefit()]);
    }

    public function store(Request $request)
    {
        AppMobileBenefit::create($this->validated($request));

        return redirect()->route('admin.app-mobile-benefits.index')->with('success', 'Poin keunggulan berhasil ditambahkan.');
    }

    public function edit(AppMobileBenefit $appMobileBenefit)
    {
        return view('admin.app-mobile-benefits.form', ['item' => $appMobileBenefit]);
    }

    public function update(Request $request, AppMobileBenefit $appMobileBenefit)
    {
        $appMobileBenefit->update($this->validated($request));

        return redirect()->route('admin.app-mobile-benefits.index')->with('success', 'Poin keunggulan berhasil diperbarui.');
    }

    public function destroy(AppMobileBenefit $appMobileBenefit)
    {
        $appMobileBenefit->delete();

        return back()->with('success', 'Poin keunggulan berhasil dihapus.');
    }

    private function validated(Request $request): array
    {
        $data = $request->validate([
            'icon' => ['nullable', 'string', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'order_index' => ['nullable', 'integer'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $data['is_active'] = $request->boolean('is_active');

        return $data;
    }
}
