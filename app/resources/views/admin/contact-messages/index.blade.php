@extends('layouts.admin')
@section('title', 'Pesan Kontak')

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
  <form method="GET" class="d-flex gap-2">
    <input type="text" name="q" value="{{ $search }}" class="form-control" placeholder="Cari nama, email, atau subjek..." style="min-width:280px;">
    @if($search)
      <a href="{{ route('admin.contact-messages.index') }}" class="btn btn-outline-secondary"><i class="bi bi-x-lg"></i></a>
    @endif
    <button class="btn btn-outline-secondary"><i class="bi bi-search"></i></button>
  </form>
</div>

<div class="row g-3 mb-3">
  <div class="col-md-4">
    <div class="card shadow-sm h-100">
      <div class="card-body">
        <i class="bi bi-envelope-paper-fill fs-3 text-dark"></i>
        <h3 class="mt-2 mb-0">{{ $total }}</h3>
        <div class="text-muted small">Total Pesan</div>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="card shadow-sm h-100">
      <div class="card-body">
        <i class="bi bi-envelope-exclamation-fill fs-3 text-primary"></i>
        <h3 class="mt-2 mb-0">{{ $unread }}</h3>
        <div class="text-muted small">Belum Dibaca</div>
      </div>
    </div>
  </div>
</div>

<div class="card shadow-sm">
  <div class="card-body p-0">
    <table class="table mb-0 align-middle">
      <thead>
        <tr>
          <th class="ps-3">Pengirim</th>
          <th>Subjek</th>
          <th>Diterima</th>
          <th class="text-end pe-3">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse($items as $item)
        <tr class="{{ $item->is_read ? '' : 'fw-semibold' }}">
          <td class="ps-3">
            @if(!$item->is_read)
              <span class="badge bg-primary-subtle text-primary me-1">Baru</span>
            @endif
            {{ $item->name }}
            <div class="text-muted small fw-normal">{{ $item->email }}</div>
          </td>
          <td>{{ $item->subject ?: '(Tanpa subjek)' }}</td>
          <td class="fw-normal">{{ $item->created_at?->translatedFormat('d M Y, H:i') }}</td>
          <td class="text-end pe-3">
            <a href="{{ route('admin.contact-messages.show', $item) }}" class="btn btn-sm btn-outline-dark me-1">Lihat</a>
            <form action="{{ route('admin.contact-messages.destroy', $item) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus pesan ini?');">
              @csrf @method('DELETE')
              <button class="btn btn-sm btn-outline-danger">Hapus</button>
            </form>
          </td>
        </tr>
        @empty
        <tr><td colspan="4" class="text-muted p-4 text-center">Belum ada pesan masuk.</td></tr>
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

@push('scripts')
<script>
  // Auto-refresh halaman ini saat ada pesan baru masuk, supaya admin tidak
  // perlu menekan reload manual untuk melihat pesan terbaru.
  (function autoRefreshOnNewMessage() {
    const pollUrl = @json(route('admin.contact-messages.poll-status'));
    let latestKnownId = {{ $items->first()->id ?? 'null' }};

    async function check() {
      try {
        const res = await fetch(pollUrl, { headers: { 'Accept': 'application/json' } });
        if (!res.ok) return;
        const data = await res.json();

        if (data.latest_id && latestKnownId !== null && data.latest_id > latestKnownId) {
          window.location.reload();
        } else if (data.latest_id && latestKnownId === null) {
          window.location.reload();
        }
      } catch (e) {
        // Diamkan — koneksi terputus sesaat tidak perlu mengganggu admin.
      }
    }

    setInterval(check, 15000);
  })();
</script>
@endpush
@endsection
