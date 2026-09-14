<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CustomSystemProcessStep;
use Illuminate\Http\Request;

class CustomSystemProcessStepController extends Controller
{
    public function index()
    {
        $items = CustomSystemProcessStep::ordered()->get();

        return view('admin.custom-system-process-steps.index', compact('items'));
    }

    public function create()
    {
        return view('admin.custom-system-process-steps.form', ['item' => new CustomSystemProcessStep()]);
    }

    public function store(Request $request)
    {
        CustomSystemProcessStep::create($this->validated($request));

        return redirect()->route('admin.custom-system-process-steps.index')->with('success', 'Langkah proses berhasil ditambahkan.');
    }

    public function edit(CustomSystemProcessStep $customSystemProcessStep)
    {
        return view('admin.custom-system-process-steps.form', ['item' => $customSystemProcessStep]);
    }

    public function update(Request $request, CustomSystemProcessStep $customSystemProcessStep)
    {
        $customSystemProcessStep->update($this->validated($request));

        return redirect()->route('admin.custom-system-process-steps.index')->with('success', 'Langkah proses berhasil diperbarui.');
    }

    public function destroy(CustomSystemProcessStep $customSystemProcessStep)
    {
        $customSystemProcessStep->delete();

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
