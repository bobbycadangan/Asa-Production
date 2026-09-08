@extends('layouts.admin')
@section('title', 'Sertifikat')

@section('content')
<div class="d-flex justify-content-end mb-3">
  <a href="{{ route('admin.certificates.create') }}" class="btn btn-dark"><i class="bi bi-plus-lg me-1"></i>Tambah Sertifikat</a>
</div>

<div class="card shadow-sm">
  <div class="card-body p-0">
    <table class="table mb-0 align-middle">
      <thead><tr><th class="ps-3">Logo</th><th>Nama</th><th>Urutan</th><th>Status</th><th class="text-end pe-3">Aksi</th></tr></thead>
      <tbody>
        @forelse($items as $item)
        <tr>
          <td class="ps-3"><img src="{{ asset('storage/'.$item->image) }}" class="thumb-preview"></td>
          <td>{{ $item->name }}</td>
          <td>{{ $item->order_index }}</td>
          <td>@if($item->is_active)<span class="badge bg-success">Aktif</span>@else<span class="badge bg-secondary">Nonaktif</span>@endif</td>
          <td class="text-end pe-3">
            <a href="{{ route('admin.certificates.edit', $item) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
            <form action="{{ route('admin.certificates.destroy', $item) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus sertifikat ini?');">
              @csrf @method('DELETE')
              <button class="btn btn-sm btn-outline-danger">Hapus</button>
            </form>
          </td>
        </tr>
        @empty
        <tr><td colspan="5" class="text-muted p-3">Belum ada data.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection
