<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WebsiteFaq;
use Illuminate\Http\Request;

class WebsiteFaqController extends Controller
{
    public function index()
    {
        $items = WebsiteFaq::ordered()->get();

        return view('admin.website-faqs.index', compact('items'));
    }

    public function create()
    {
        return view('admin.website-faqs.form', ['item' => new WebsiteFaq()]);
    }

    public function store(Request $request)
    {
        WebsiteFaq::create($this->validated($request));

        return redirect()->route('admin.website-faqs.index')->with('success', 'FAQ berhasil ditambahkan.');
    }

    public function edit(WebsiteFaq $websiteFaq)
    {
        return view('admin.website-faqs.form', ['item' => $websiteFaq]);
    }

    public function update(Request $request, WebsiteFaq $websiteFaq)
    {
        $websiteFaq->update($this->validated($request));

        return redirect()->route('admin.website-faqs.index')->with('success', 'FAQ berhasil diperbarui.');
    }

    public function destroy(WebsiteFaq $websiteFaq)
    {
        $websiteFaq->delete();

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
