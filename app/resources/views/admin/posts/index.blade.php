@extends('layouts.admin')
@section('title', 'Blog')

@section('content')
<div class="d-flex justify-content-end mb-3">
  <a href="{{ route('admin.posts.create') }}" class="btn btn-dark"><i class="bi bi-plus-lg me-1"></i>Tulis Artikel</a>
</div>

<div class="card shadow-sm">
  <div class="card-body p-0">
    <table class="table mb-0 align-middle">
      <thead><tr><th class="ps-3">Thumbnail</th><th>Judul</th><th>Penulis</th><th>Meta Description</th><th>Status</th><th class="text-end pe-3">Aksi</th></tr></thead>
      <tbody>
        @forelse($items as $item)
        <tr>
          <td class="ps-3">
            @if($item->thumbnail)
              <img src="{{ asset('storage/'.$item->thumbnail) }}" class="thumb-preview">
            @else
              <span class="text-muted small">—</span>
            @endif
          </td>
          <td>
            {{ $item->title }}
            <div class="text-muted small">/blog/{{ $item->slug }}</div>
          </td>
          <td class="small">{{ $item->author ?: 'Admin' }}</td>
          <td class="small text-muted" style="max-width:320px;">{{ Str::limit($item->meta_description, 90) }}</td>
          <td>@if($item->is_active)<span class="badge bg-success">Aktif</span>@else<span class="badge bg-secondary">Nonaktif</span>@endif</td>
          <td class="text-end pe-3">
            <a href="{{ route('admin.posts.edit', $item) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
            <form action="{{ route('admin.posts.destroy', $item) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus artikel ini?');">
              @csrf @method('DELETE')
              <button class="btn btn-sm btn-outline-danger">Hapus</button>
            </form>
          </td>
        </tr>
        @empty
        <tr><td colspan="6" class="text-muted p-3">Belum ada artikel.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection
