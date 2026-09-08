@extends('layouts.admin')
@section('title', 'Tim Kami')

@section('content')
<div class="d-flex justify-content-end mb-3">
  <a href="{{ route('admin.team.create') }}" class="btn btn-dark"><i class="bi bi-plus-lg me-1"></i>Tambah Anggota</a>
</div>

<div class="card shadow-sm">
  <div class="card-body p-0">
    <table class="table mb-0 align-middle">
      <thead><tr><th class="ps-3">Foto</th><th>Nama</th><th>Peran</th><th>Urutan</th><th>Status</th><th class="text-end pe-3">Aksi</th></tr></thead>
      <tbody>
        @forelse($items as $item)
        <tr>
          <td class="ps-3">
            @if($item->photo)<img src="{{ asset('storage/'.$item->photo) }}" class="thumb-preview">@else <span class="text-muted">-</span>@endif
          </td>
          <td>{{ $item->name }}</td>
          <td>{{ $item->role }}</td>
          <td>{{ $item->order_index }}</td>
          <td>@if($item->is_active)<span class="badge bg-success">Aktif</span>@else<span class="badge bg-secondary">Nonaktif</span>@endif</td>
          <td class="text-end pe-3">
            <a href="{{ route('admin.team.edit', $item) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
            <form action="{{ route('admin.team.destroy', $item) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus anggota ini?');">
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
