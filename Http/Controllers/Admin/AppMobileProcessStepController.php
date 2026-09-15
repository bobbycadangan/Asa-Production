<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AppMobileProcessStep;
use Illuminate\Http\Request;

class AppMobileProcessStepController extends Controller
{
    public function index()
    {
        $items = AppMobileProcessStep::ordered()->get();

        return view('admin.app-mobile-process-steps.index', compact('items'));
    }

    public function create()
    {
        return view('admin.app-mobile-process-steps.form', ['item' => new AppMobileProcessStep()]);
    }

    public function store(Request $request)
    {
        AppMobileProcessStep::create($this->validated($request));

        return redirect()->route('admin.app-mobile-process-steps.index')->with('success', 'Langkah proses berhasil ditambahkan.');
    }

    public function edit(AppMobileProcessStep $appMobileProcessStep)
    {
        return view('admin.app-mobile-process-steps.form', ['item' => $appMobileProcessStep]);
    }

    public function update(Request $request, AppMobileProcessStep $appMobileProcessStep)
    {
        $appMobileProcessStep->update($this->validated($request));

        return redirect()->route('admin.app-mobile-process-steps.index')->with('success', 'Langkah proses berhasil diperbarui.');
    }

    public function destroy(AppMobileProcessStep $appMobileProcessStep)
    {
        $appMobileProcessStep->delete();

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
