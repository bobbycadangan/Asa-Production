@extends('layouts.admin')
@section('title', $item->exists ? 'Edit Statistik' : 'Tambah Statistik')

@section('content')
<form method="POST" action="{{ $item->exists ? route('admin.app-mobile-stats.update', $item) : route('admin.app-mobile-stats.store') }}">
  @csrf
  @if($item->exists) @method('PUT') @endif

  <div class="card shadow-sm">
    <div class="card-body row g-3">
      <div class="col-md-6">
        <label class="form-label">Angka/Nilai</label>
        <input type="text" name="value" class="form-control" value="{{ old('value', $item->value) }}" placeholder="50+" required>
      </div>
      <div class="col-md-6">
        <label class="form-label">Label</label>
        <input type="text" name="label" class="form-control" value="{{ old('label', $item->label) }}" placeholder="Proyek Selesai" required>
      </div>
      <div class="col-md-3">
        <label class="form-label">Urutan</label>
        <input type="number" name="order_index" class="form-control" value="{{ old('order_index', $item->order_index ?? 0) }}">
      </div>
      <div class="col-md-3 d-flex align-items-end">
        <div class="form-check">
          <input type="checkbox" name="is_active" value="1" class="form-check-input" id="is_active" {{ old('is_active', $item->is_active ?? true) ? 'checked' : '' }}>
          <label class="form-check-label" for="is_active">Aktif (tampil di situs)</label>
        </div>
      </div>
    </div>
  </div>

  <div class="mt-3">
    <button type="submit" class="btn btn-dark">Simpan</button>
    <a href="{{ route('admin.app-mobile-stats.index') }}" class="btn btn-outline-secondary">Batal</a>
  </div>
</form>
@endsection
