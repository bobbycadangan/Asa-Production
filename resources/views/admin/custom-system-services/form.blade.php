@extends('layouts.admin')
@section('title', $item->exists ? 'Edit Layanan' : 'Tambah Layanan')

@section('content')
<form method="POST" action="{{ $item->exists ? route('admin.custom-system-services.update', $item) : route('admin.custom-system-services.store') }}">
  @csrf
  @if($item->exists) @method('PUT') @endif

  <div class="card shadow-sm">
    <div class="card-body row g-3">
      <div class="col-md-6">
        <label class="form-label">Judul</label>
        <input type="text" name="title" class="form-control" value="{{ old('title', $item->title) }}" required>
      </div>
      <div class="col-md-6">
        <label class="form-label">Ikon (kelas CSS font-awesome)</label>
        <input type="text" name="icon" class="form-control" value="{{ old('icon', $item->icon) }}" placeholder="fa-database">
        <div class="form-text">Lihat daftar ikon di <a href="https://fontawesome.com/v4/icons/" target="_blank" rel="noopener">fontawesome.com/v4/icons</a>, salin nama kelasnya (mis. fa-database).</div>
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
    <a href="{{ route('admin.custom-system-services.index') }}" class="btn btn-outline-secondary">Batal</a>
  </div>
</form>
@endsection
