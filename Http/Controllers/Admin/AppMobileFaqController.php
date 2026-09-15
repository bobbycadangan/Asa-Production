<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AppMobileFaq;
use Illuminate\Http\Request;

class AppMobileFaqController extends Controller
{
    public function index()
    {
        $items = AppMobileFaq::ordered()->get();

        return view('admin.app-mobile-faqs.index', compact('items'));
    }

    public function create()
    {
        return view('admin.app-mobile-faqs.form', ['item' => new AppMobileFaq()]);
    }

    public function store(Request $request)
    {
        AppMobileFaq::create($this->validated($request));

        return redirect()->route('admin.app-mobile-faqs.index')->with('success', 'FAQ berhasil ditambahkan.');
    }

    public function edit(AppMobileFaq $appMobileFaq)
    {
        return view('admin.app-mobile-faqs.form', ['item' => $appMobileFaq]);
    }

    public function update(Request $request, AppMobileFaq $appMobileFaq)
    {
        $appMobileFaq->update($this->validated($request));

        return redirect()->route('admin.app-mobile-faqs.index')->with('success', 'FAQ berhasil diperbarui.');
    }

    public function destroy(AppMobileFaq $appMobileFaq)
    {
        $appMobileFaq->delete();

        return back()->with('success', 'FAQ berhasil dihapus.');
    }

    private function validated(Request $request): array
    {
        $data = $request->validate([
            'question' => ['required', 'string', 'max:255'],
            'answer' => ['required', 'string'],
            'order_index' => ['nullable', 'integer'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $data['is_active'] = $request->boolean('is_active');

        return $data;
    }
}
