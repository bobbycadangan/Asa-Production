@extends('layouts.admin')
@section('title', 'Jasa Pembuatan Website')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
  <p class="text-muted mb-0">Kelola isi halaman publik <a href="{{ route('solusi.website') }}" target="_blank" rel="noopener">/solusi/jasa-pembuatan-website</a>.</p>
  <a href="{{ route('solusi.website') }}" target="_blank" rel="noopener" class="btn btn-sm btn-outline-secondary"><i class="bi bi-box-arrow-up-right me-1"></i>Lihat Halaman</a>
</div>

<form method="POST" action="{{ route('admin.website.update') }}" enctype="multipart/form-data">
  @csrf
  @method('PUT')

  <div class="card shadow-sm mb-3">
    <div class="card-header bg-white fw-semibold">Masthead (Bagian Atas)</div>
    <div class="card-body row g-3">
      <div class="col-md-4">
        <label class="form-label">Label Kecil (Eyebrow)</label>
        <input type="text" name="hero_eyebrow" class="form-control" value="{{ old('hero_eyebrow', $page->hero_eyebrow) }}" required>
      </div>
      <div class="col-md-8">
        <label class="form-label">Judul Utama</label>
        <input type="text" name="hero_title" class="form-control" value="{{ old('hero_title', $page->hero_title) }}" required>
      </div>
      <div class="col-12">
        <label class="form-label">Deskripsi</label>
        <textarea name="hero_description" class="form-control" rows="3">{{ old('hero_description', $page->hero_description) }}</textarea>
      </div>
      <div class="col-md-6">
        <label class="form-label">Gambar Background Hero</label>
        <div class="mb-2">
          <img src="{{ $page->hero_background ? asset('storage/'.$page->hero_background) : asset('images/parallax.jpg') }}" class="thumb-preview">
        </div>
        <input type="file" name="hero_background" class="form-control" accept="image/*">
        <div class="form-text">Jika belum pernah diganti, halaman memakai gambar default. Ukuran maksimal 4MB, disarankan gambar landscape lebar.</div>
      </div>
      <div class="col-md-6">
        <label class="form-label">Pesan Default WhatsApp</label>
        <input type="text" name="whatsapp_message" class="form-control" value="{{ old('whatsapp_message', $page->whatsapp_message) }}" required>
        <div class="form-text">Terisi otomatis saat pengunjung klik tombol "Konsultasi Gratis" / "Chat via WhatsApp". Nomor WhatsApp tujuan diatur di menu Pengaturan Situs.</div>
      </div>
    </div>
  </div>

  <div class="card shadow-sm mb-3">
    <div class="card-header bg-white fw-semibold d-flex justify-content-between align-items-center">
      <span>Statistik (Strip Angka)</span>
      <a href="{{ route('admin.website-stats.index') }}" class="btn btn-sm btn-dark">Kelola Statistik ({{ $counts['stats'] }})</a>
    </div>
    <div class="card-body text-muted small">Contoh: "120+ Website Diluncurkan". Dikelola terpisah karena jumlahnya bisa ditambah/dikurangi.</div>
  </div>

  <div class="card shadow-sm mb-3">
    <div class="card-header bg-white fw-semibold">Kenapa Pilih Kami</div>
    <div class="card-body row g-3">
      <div class="col-md-4">
        <label class="form-label">Label Kecil (Eyebrow)</label>
        <input type="text" name="why_us_eyebrow" class="form-control" value="{{ old('why_us_eyebrow', $page->why_us_eyebrow) }}" required>
      </div>
      <div class="col-md-8">
        <label class="form-label">Judul Section</label>
        <input type="text" name="why_us_title" class="form-control" value="{{ old('why_us_title', $page->why_us_title) }}" required>
      </div>
      <div class="col-12">
        <label class="form-label">Deskripsi Section</label>
        <textarea name="why_us_description" class="form-control" rows="2">{{ old('why_us_description', $page->why_us_description) }}</textarea>
      </div>
      <div class="col-12">
        <a href="{{ route('admin.website-benefits.index') }}" class="btn btn-sm btn-dark">Kelola Poin Keunggulan ({{ $counts['benefits'] }})</a>
      </div>
    </div>
  </div>

  <div class="card shadow-sm mb-3">
    <div class="card-header bg-white fw-semibold">Layanan yang Kami Tawarkan</div>
    <div class="card-body row g-3">
      <div class="col-md-4">
        <label class="form-label">Label Kecil (Eyebrow)</label>
        <input type="text" name="services_eyebrow" class="form-control" value="{{ old('services_eyebrow', $page->services_eyebrow) }}" required>
      </div>
      <div class="col-md-8">
        <label class="form-label">Judul Section</label>
        <input type="text" name="services_title" class="form-control" value="{{ old('services_title', $page->services_title) }}" required>
      </div>
      <div class="col-12">
        <label class="form-label">Deskripsi Section</label>
        <textarea name="services_description" class="form-control" rows="2">{{ old('services_description', $page->services_description) }}</textarea>
      </div>
      <div class="col-12">
        <a href="{{ route('admin.website-services.index') }}" class="btn btn-sm btn-dark">Kelola Daftar Layanan ({{ $counts['services'] }})</a>
      </div>
    </div>
  </div>

  <div class="card shadow-sm mb-3">
    <div class="card-header bg-white fw-semibold">Proses Pengerjaan</div>
    <div class="card-body row g-3">
      <div class="col-md-4">
        <label class="form-label">Label Kecil (Eyebrow)</label>
        <input type="text" name="process_eyebrow" class="form-control" value="{{ old('process_eyebrow', $page->process_eyebrow) }}" required>
      </div>
      <div class="col-md-8">
        <label class="form-label">Judul Section</label>
        <input type="text" name="process_title" class="form-control" value="{{ old('process_title', $page->process_title) }}" required>
      </div>
      <div class="col-12">
        <label class="form-label">Deskripsi Section</label>
        <textarea name="process_description" class="form-control" rows="2">{{ old('process_description', $page->process_description) }}</textarea>
      </div>
      <div class="col-12">
        <a href="{{ route('admin.website-process-steps.index') }}" class="btn btn-sm btn-dark">Kelola Langkah Proses ({{ $counts['process_steps'] }})</a>
      </div>
    </div>
  </div>

  <div class="card shadow-sm mb-3">
    <div class="card-header bg-white fw-semibold">Teknologi</div>
    <div class="card-body row g-3">
      <div class="col-md-4">
        <label class="form-label">Label Kecil (Eyebrow)</label>
        <input type="text" name="tech_eyebrow" class="form-control" value="{{ old('tech_eyebrow', $page->tech_eyebrow) }}" required>
      </div>
      <div class="col-md-8">
        <label class="form-label">Judul Section</label>
        <input type="text" name="tech_title" class="form-control" value="{{ old('tech_title', $page->tech_title) }}" required>
      </div>
      <div class="col-12">
        <a href="{{ route('admin.website-tech-badges.index') }}" class="btn btn-sm btn-dark">Kelola Badge Teknologi ({{ $counts['tech_badges'] }})</a>
      </div>
    </div>
  </div>

  <div class="card shadow-sm mb-3">
    <div class="card-header bg-white fw-semibold">Portofolio Preview</div>
    <div class="card-body row g-3">
      <div class="col-md-4">
        <label class="form-label">Label Kecil (Eyebrow)</label>
        <input type="text" name="portfolio_eyebrow" class="form-control" value="{{ old('portfolio_eyebrow', $page->portfolio_eyebrow) }}" required>
      </div>
      <div class="col-md-8">
        <label class="form-label">Judul Section</label>
        <input type="text" name="portfolio_title" class="form-control" value="{{ old('portfolio_title', $page->portfolio_title) }}" required>
      </div>
      <div class="col-12">
        <label class="form-label">Deskripsi Section</label>
        <textarea name="portfolio_description" class="form-control" rows="2">{{ old('portfolio_description', $page->portfolio_description) }}</textarea>
      </div>
      <div class="col-12">
        <div class="form-text">Contoh website yang ditampilkan diambil otomatis dari menu <a href="{{ route('admin.portfolio.index') }}">Portofolio</a> (kategori yang mengandung kata "web" diprioritaskan).</div>
      </div>
    </div>
  </div>

  <div class="card shadow-sm mb-3">
    <div class="card-header bg-white fw-semibold">FAQ</div>
    <div class="card-body row g-3">
      <div class="col-md-4">
        <label class="form-label">Label Kecil (Eyebrow)</label>
        <input type="text" name="faq_eyebrow" class="form-control" value="{{ old('faq_eyebrow', $page->faq_eyebrow) }}" required>
      </div>
      <div class="col-md-8">
        <label class="form-label">Judul Section</label>
        <input type="text" name="faq_title" class="form-control" value="{{ old('faq_title', $page->faq_title) }}" required>
      </div>
      <div class="col-12">
        <a href="{{ route('admin.website-faqs.index') }}" class="btn btn-sm btn-dark">Kelola Daftar FAQ ({{ $counts['faqs'] }})</a>
      </div>
    </div>
  </div>

  <div class="card shadow-sm mb-3">
    <div class="card-header bg-white fw-semibold">CTA Banner (Bagian Bawah)</div>
    <div class="card-body row g-3">
      <div class="col-12">
        <label class="form-label">Judul CTA</label>
        <input type="text" name="cta_title" class="form-control" value="{{ old('cta_title', $page->cta_title) }}" required>
      </div>
      <div class="col-12">
        <label class="form-label">Deskripsi CTA</label>
        <textarea name="cta_description" class="form-control" rows="2">{{ old('cta_description', $page->cta_description) }}</textarea>
      </div>
    </div>
  </div>

  <div class="card shadow-sm mb-3">
    <div class="card-header bg-white fw-semibold">SEO</div>
    <div class="card-body row g-3">
      <div class="col-12">
        <label class="form-label">Meta Description</label>
        <textarea name="meta_description" class="form-control" rows="2" maxlength="500">{{ old('meta_description', $page->meta_description) }}</textarea>
      </div>
    </div>
  </div>

  <div class="mt-3">
    <button type="submit" class="btn btn-dark">Simpan Perubahan</button>
  </div>
</form>
@endsection
