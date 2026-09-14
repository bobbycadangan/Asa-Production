@extends('layouts.admin')
@section('title', 'Subscriber')

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
  <form method="GET" class="d-flex gap-2">
    <input type="text" name="q" value="{{ $search }}" class="form-control" placeholder="Cari email..." style="min-width:240px;">
    @if($search)
      <a href="{{ route('admin.subscribers.index') }}" class="btn btn-outline-secondary"><i class="bi bi-x-lg"></i></a>
    @endif
    <button class="btn btn-outline-secondary"><i class="bi bi-search"></i></button>
  </form>
  <a href="{{ route('admin.subscribers.export') }}" class="btn btn-dark">
    <i class="bi bi-download me-1"></i> Export CSV
  </a>
</div>

<div class="row g-3 mb-3">
  <div class="col-md-4">
    <div class="card shadow-sm h-100">
      <div class="card-body">
        <i class="bi bi-envelope-paper-fill fs-3 text-dark"></i>
        <h3 class="mt-2 mb-0">{{ $total }}</h3>
        <div class="text-muted small">Total Subscriber</div>
      </div>
    </div>
  </div>
</div>

<div class="card shadow-sm">
  <div class="card-body p-0">
    <table class="table mb-0 align-middle">
      <thead>
        <tr>
          <th class="ps-3">Email</th>
          <th>Terdaftar Pada</th>
          <th class="text-end pe-3">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse($items as $item)
        <tr>
          <td class="ps-3">{{ $item->email }}</td>
          <td>{{ $item->created_at?->translatedFormat('d M Y, H:i') }}</td>
          <td class="text-end pe-3">
            <form action="{{ route('admin.subscribers.destroy', $item) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus subscriber ini?');">
              @csrf @method('DELETE')
              <button class="btn btn-sm btn-outline-danger">Hapus</button>
            </form>
          </td>
        </tr>
        @empty
        <tr><td colspan="3" class="text-muted p-4 text-center">Belum ada subscriber.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
  @if($items->hasPages())
    <div class="card-footer bg-white">
      {{ $items->links() }}
    </div>
  @endif
</div>
@endsection
