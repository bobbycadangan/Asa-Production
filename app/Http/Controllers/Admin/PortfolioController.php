<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function index()
    {
        $items = Portfolio::ordered()->get();

        return view('admin.portfolio.index', compact('items'));
    }

    public function create()
    {
        return view('admin.portfolio.form', ['item' => new Portfolio()]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request, true);

        $data['thumbnail'] = $request->file('thumbnail')->store('portfolio', 'public');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('portfolio', 'public');
        } else {
            $data['image'] = $data['thumbnail'];
        }

        Portfolio::create($data);

        return redirect()->route('admin.portfolio.index')->with('success', 'Portofolio berhasil ditambahkan.');
    }

    public function edit(Portfolio $portfolio)
    {
        return view('admin.portfolio.form', ['item' => $portfolio]);
    }

    public function update(Request $request, Portfolio $portfolio)
    {
        $data = $this->validated($request, false);

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('portfolio', 'public');
        }

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('portfolio', 'public');
        }

        $portfolio->update($data);

        return redirect()->route('admin.portfolio.index')->with('success', 'Portofolio berhasil diperbarui.');
    }

    public function destroy(Portfolio $portfolio)
    {
        $portfolio->delete();

        return back()->with('success', 'Portofolio berhasil dihapus.');
    }

    private function validated(Request $request, bool $thumbnailRequired): array
    {
        $data = $request->validate([
            'title' => ['nullable', 'string', 'max:255'],
            'category' => ['nullable', 'string', 'max:100'],
            'description' => ['nullable', 'string', 'max:500'],
            'link' => ['nullable', 'url', 'max:255'],
            'order_index' => ['nullable', 'integer'],
            'is_active' => ['nullable', 'boolean'],
            'thumbnail' => [$thumbnailRequired ? 'required' : 'nullable', 'image', 'max:4096'],
            'image' => ['nullable', 'image', 'max:6144'],
        ]);

        $data['is_active'] = $request->boolean('is_active');
        unset($data['thumbnail'], $data['image']);

        return $data;
    }
}
