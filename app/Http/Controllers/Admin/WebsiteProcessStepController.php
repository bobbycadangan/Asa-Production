<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WebsiteProcessStep;
use Illuminate\Http\Request;

class WebsiteProcessStepController extends Controller
{
    public function index()
    {
        $items = WebsiteProcessStep::ordered()->get();

        return view('admin.website-process-steps.index', compact('items'));
    }

    public function create()
    {
        return view('admin.website-process-steps.form', ['item' => new WebsiteProcessStep()]);
    }

    public function store(Request $request)
    {
        WebsiteProcessStep::create($this->validated($request));

        return redirect()->route('admin.website-process-steps.index')->with('success', 'Langkah proses berhasil ditambahkan.');
    }

    public function edit(WebsiteProcessStep $websiteProcessStep)
    {
        return view('admin.website-process-steps.form', ['item' => $websiteProcessStep]);
    }

    public function update(Request $request, WebsiteProcessStep $websiteProcessStep)
    {
        $websiteProcessStep->update($this->validated($request));

        return redirect()->route('admin.website-process-steps.index')->with('success', 'Langkah proses berhasil diperbarui.');
    }

    public function destroy(WebsiteProcessStep $websiteProcessStep)
    {
        $websiteProcessStep->delete();

        return back()->with('success', 'Langkah proses berhasil dihapus.');
    }

    private function validated(Request $request): array
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'order_index' => ['nullable', 'integer'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $data['is_active'] = $request->boolean('is_active');

        return $data;
    }
}
