@extends('layouts.admin')
@section('title', 'Proses Pengembangan - Jasa App Mobile')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
  <a href="{{ route('admin.app-mobile.edit') }}" class="btn btn-sm btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>Kembali ke Halaman App Mobile</a>
  <a href="{{ route('admin.app-mobile-process-steps.create') }}" class="btn btn-dark"><i class="bi bi-plus-lg me-1"></i>Tambah Langkah</a>
</div>

<p class="text-muted small">Nomor langkah (1, 2, 3, ...) di halaman otomatis mengikuti urutan tampil di bawah, jadi cukup atur kolom "Urutan".</p>

<div class="card shadow-sm">
  <div class="card-body p-0">
    <table class="table mb-0 align-middle">
      <thead><tr><th class="ps-3">#</th><th>Judul</th><th>Deskripsi</th><th>Urutan</th><th>Status</th><th class="text-end pe-3">Aksi</th></tr></thead>
      <tbody>
        @forelse($items as $i => $item)
        <tr>
          <td class="ps-3">{{ $i + 1 }}</td>
          <td>{{ $item->title }}</td>
          <td>{{ \Illuminate\Support\Str::limit($item->description, 60) }}</td>
          <td>{{ $item->order_index }}</td>
          <td>@if($item->is_active)<span class="badge bg-success">Aktif</span>@else<span class="badge bg-secondary">Nonaktif</span>@endif</td>
          <td class="text-end pe-3">
            <a href="{{ route('admin.app-mobile-process-steps.edit', $item) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
            <form action="{{ route('admin.app-mobile-process-steps.destroy', $item) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus langkah ini?');">
              @csrf @method('DELETE')
              <button class="btn btn-sm btn-outline-danger">Hapus</button>
            </form>
          </td>
        </tr>
        @empty
        <tr><td colspan="6" class="text-muted p-3">Belum ada data.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection
