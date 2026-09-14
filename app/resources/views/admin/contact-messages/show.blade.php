@extends('layouts.admin')
@section('title', 'Detail Pesan')

@section('content')
<div class="mb-3">
  <a href="{{ route('admin.contact-messages.index') }}" class="btn btn-outline-secondary btn-sm">
    <i class="bi bi-arrow-left"></i> Kembali ke Daftar Pesan
  </a>
</div>

<div class="card shadow-sm">
  <div class="card-body">
    <div class="row g-3 mb-3">
      <div class="col-md-4">
        <div class="text-muted small">Nama</div>
        <div class="fw-semibold">{{ $item->name }}</div>
      </div>
      <div class="col-md-4">
        <div class="text-muted small">Email</div>
        <div class="fw-semibold">
          <a href="mailto:{{ $item->email }}">{{ $item->email }}</a>
        </div>
      </div>
      <div class="col-md-4">
        <div class="text-muted small">Diterima</div>
        <div class="fw-semibold">{{ $item->created_at?->translatedFormat('d M Y, H:i') }}</div>
      </div>
    </div>

    <div class="mb-3">
      <div class="text-muted small">Subjek</div>
      <div class="fw-semibold">{{ $item->subject ?: '(Tanpa subjek)' }}</div>
    </div>

    <div>
      <div class="text-muted small mb-1">Pesan</div>
      <div class="border rounded-3 p-3 bg-light" style="white-space:pre-line;">{{ $item->message }}</div>
    </div>
  </div>
</div>

<div class="mt-3 d-flex gap-2">
  <a href="mailto:{{ $item->email }}?subject=RE: {{ $item->subject ?: 'Pesan Anda di Asa Production' }}" class="btn btn-dark">
    <i class="bi bi-reply-fill"></i> Balas via Email
  </a>
  <form action="{{ route('admin.contact-messages.destroy', $item) }}" method="POST" onsubmit="return confirm('Hapus pesan ini?');">
    @csrf @method('DELETE')
    <button class="btn btn-outline-danger">Hapus Pesan</button>
  </form>
</div>
@endsection
