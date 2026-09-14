<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CustomSystemFaq;
use Illuminate\Http\Request;

class CustomSystemFaqController extends Controller
{
    public function index()
    {
        $items = CustomSystemFaq::ordered()->get();

        return view('admin.custom-system-faqs.index', compact('items'));
    }

    public function create()
    {
        return view('admin.custom-system-faqs.form', ['item' => new CustomSystemFaq()]);
    }

    public function store(Request $request)
    {
        CustomSystemFaq::create($this->validated($request));

        return redirect()->route('admin.custom-system-faqs.index')->with('success', 'FAQ berhasil ditambahkan.');
    }

    public function edit(CustomSystemFaq $customSystemFaq)
    {
        return view('admin.custom-system-faqs.form', ['item' => $customSystemFaq]);
    }

    public function update(Request $request, CustomSystemFaq $customSystemFaq)
    {
        $customSystemFaq->update($this->validated($request));

        return redirect()->route('admin.custom-system-faqs.index')->with('success', 'FAQ berhasil diperbarui.');
    }

    public function destroy(CustomSystemFaq $customSystemFaq)
    {
        $customSystemFaq->delete();

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
