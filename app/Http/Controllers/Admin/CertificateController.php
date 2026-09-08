<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use Illuminate\Http\Request;

class CertificateController extends Controller
{
    public function index()
    {
        $items = Certificate::ordered()->get();

        return view('admin.certificates.index', compact('items'));
    }

    public function create()
    {
        return view('admin.certificates.form', ['item' => new Certificate()]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request, true);
        $data['image'] = $request->file('image')->store('certificates', 'public');

        Certificate::create($data);

        return redirect()->route('admin.certificates.index')->with('success', 'Sertifikat berhasil ditambahkan.');
    }

    public function edit(Certificate $certificate)
    {
        return view('admin.certificates.form', ['item' => $certificate]);
    }

    public function update(Request $request, Certificate $certificate)
    {
        $data = $this->validated($request, false);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('certificates', 'public');
        }

        $certificate->update($data);

        return redirect()->route('admin.certificates.index')->with('success', 'Sertifikat berhasil diperbarui.');
    }

    public function destroy(Certificate $certificate)
    {
        $certificate->delete();

        return back()->with('success', 'Sertifikat berhasil dihapus.');
    }

    private function validated(Request $request, bool $imageRequired): array
    {
        $data = $request->validate([
            'name' => ['nullable', 'string', 'max:255'],
            'order_index' => ['nullable', 'integer'],
            'is_active' => ['nullable', 'boolean'],
            'image' => [$imageRequired ? 'required' : 'nullable', 'image', 'max:2048'],
        ]);

        $data['is_active'] = $request->boolean('is_active');
        unset($data['image']);

        return $data;
    }
}
