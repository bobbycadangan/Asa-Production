@extends('layouts.admin')
@section('title', 'Pengaturan Situs')

@section('content')
<form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data">
  @csrf
  @method('PUT')

  <div class="card shadow-sm mb-3">
    <div class="card-header bg-white fw-semibold">Umum</div>
    <div class="card-body row g-3">
      <div class="col-md-6">
        <label class="form-label">Nama Situs</label>
        <input type="text" name="site_title" class="form-control" value="{{ old('site_title', $setting->site_title) }}" required>
      </div>
      <div class="col-md-6">
        <label class="form-label">Slogan / Brand</label>
        <input type="text" name="brand_slogan" class="form-control" value="{{ old('brand_slogan', $setting->brand_slogan) }}">
      </div>
      <div class="col-md-6">
        <label class="form-label">Logo (gambar atau video mp4/webm)</label>
        @if($setting->logo)
          <div class="mb-2">
            @if(\Illuminate\Support\Str::endsWith($setting->logo, ['.mp4', '.webm']))
              <video src="{{ asset('storage/'.$setting->logo) }}" class="thumb-preview" autoplay muted loop playsinline></video>
            @else
              <img src="{{ asset('storage/'.$setting->logo) }}" class="thumb-preview">
            @endif
          </div>
        @endif
        <input type="file" name="logo" class="form-control" accept="image/*,video/mp4,video/webm">
        <div class="form-text">Jika upload video, logo di hero akan otomatis tampil sebagai video (autoplay, loop, tanpa suara).</div>
      </div>
      <div class="col-md-6">
        <label class="form-label">Favicon</label>
        @if($setting->favicon)<div class="mb-2"><img src="{{ asset('storage/'.$setting->favicon) }}" class="thumb-preview"></div>@endif
        <input type="file" name="favicon" class="form-control" accept="image/*">
      </div>
      <div class="col-md-6">
        <label class="form-label">Nomor WhatsApp (format 62...)</label>
        <input type="text" name="whatsapp_number" class="form-control" value="{{ old('whatsapp_number', $setting->whatsapp_number) }}" required>
      </div>
      <div class="col-md-6">
        <label class="form-label">Pesan Default WhatsApp</label>
        <input type="text" name="whatsapp_message" class="form-control" value="{{ old('whatsapp_message', $setting->whatsapp_message) }}">
      </div>
    </div>
  </div>

  <div class="card shadow-sm mb-3">
    <div class="card-header bg-white fw-semibold">Teks Berjalan (Promo)</div>
    <div class="card-body row g-3">
      <div class="col-12">
        <div class="form-check form-switch">
          <input type="hidden" name="promo_enabled" value="0">
          <input type="checkbox" name="promo_enabled" id="promo_enabled" class="form-check-input" value="1" {{ old('promo_enabled', $setting->promo_enabled) ? 'checked' : '' }}>
          <label class="form-check-label" for="promo_enabled">Tampilkan teks berjalan promo di atas navbar</label>
        </div>
      </div>
      <div class="col-12">
        <label class="form-label">Teks Promo</label>
        <input type="text" name="promo_text" class="form-control" maxlength="255" value="{{ old('promo_text', $setting->promo_text) }}" placeholder="Contoh: 🔥 Promo spesial bulan ini — diskon hingga 20% untuk semua paket jasa!">
        <div class="form-text">Teks ini akan berjalan (marquee) di bar promo bagian paling atas halaman, sebelum menu navigasi. Kosongkan atau matikan toggle di atas untuk menyembunyikannya.</div>
      </div>
    </div>
  </div>

  <div class="card shadow-sm mb-3">
    <div class="card-header bg-white fw-semibold">Bagian Hero (Header)</div>
    <div class="card-body row g-3">
      <div class="col-md-6">
        <label class="form-label">Judul Hero</label>
        <input type="text" name="hero_title" class="form-control" value="{{ old('hero_title', $setting->hero_title) }}" required>
      </div>
      <div class="col-md-6">
        <label class="form-label">Sub Judul Hero</label>
        <input type="text" name="hero_subtitle" class="form-control" value="{{ old('hero_subtitle', $setting->hero_subtitle) }}">
      </div>
      <div class="col-md-6">
        <label class="form-label">Video Latar (mp4/webm, opsional)</label>
        @if($setting->hero_video)<div class="mb-2 small text-muted">{{ basename($setting->hero_video) }}</div>@endif
        <input type="file" name="hero_video" class="form-control" accept="video/*">
      </div>
    </div>
  </div>

  <div class="card shadow-sm mb-3">
    <div class="card-header bg-white fw-semibold">Tentang Kami</div>
    <div class="card-body row g-3">
      <div class="col-12">
        <label class="form-label">Judul</label>
        <input type="text" name="about_title" class="form-control" value="{{ old('about_title', $setting->about_title) }}" required>
      </div>
      <div class="col-12">
        <label class="form-label">Deskripsi</label>
        <textarea name="about_description" class="form-control" rows="3">{{ old('about_description', $setting->about_description) }}</textarea>
      </div>
      <div class="col-md-6">
        <label class="form-label">Label Kecil (di atas judul)</label>
        <input type="text" name="about_label" class="form-control" value="{{ old('about_label', $setting->about_label) }}" placeholder="Tentang Kami">
      </div>
      <div class="col-md-6">
        <label class="form-label">Gambar</label>
        @if($setting->about_image)
          <div class="mb-2"><img src="{{ asset('storage/'.$setting->about_image) }}" class="thumb-preview"></div>
        @endif
        <input type="file" name="about_image" class="form-control" accept="image/*">
      </div>
      <div class="col-md-6">
        <label class="form-label">Teks Tombol</label>
        <input type="text" name="about_cta_text" class="form-control" value="{{ old('about_cta_text', $setting->about_cta_text) }}" placeholder="Pelajari Lebih Lanjut">
      </div>
      <div class="col-md-6">
        <label class="form-label">Link Tombol</label>
        <input type="text" name="about_cta_link" class="form-control" value="{{ old('about_cta_link', $setting->about_cta_link) }}" placeholder="#services">
      </div>
    </div>
  </div>

  <div class="card shadow-sm mb-3">
    <div class="card-header bg-white fw-semibold">Bagian Layanan</div>
    <div class="card-body row g-3">
      <div class="col-12">
        <label class="form-label">Judul</label>
        <input type="text" name="services_title" class="form-control" value="{{ old('services_title', $setting->services_title) }}" required>
      </div>
      <div class="col-12">
        <label class="form-label">Deskripsi</label>
        <textarea name="services_description" class="form-control" rows="3">{{ old('services_description', $setting->services_description) }}</textarea>
      </div>
      <div class="col-md-6">
        <label class="form-label">Gambar Latar (parallax)</label>
        @if($setting->services_bg)<div class="mb-2"><img src="{{ asset('storage/'.$setting->services_bg) }}" class="thumb-preview"></div>@endif
        <input type="file" name="services_bg" class="form-control" accept="image/*">
      </div>
    </div>
  </div>

  <div class="card shadow-sm mb-3">
    <div class="card-header bg-white fw-semibold">Bagian Blog (Landing Page)</div>
    <div class="card-body row g-3">
      <div class="col-12">
        <div class="form-check form-switch">
          <input type="hidden" name="blog_section_enabled" value="0">
          <input type="checkbox" name="blog_section_enabled" id="blog_section_enabled" class="form-check-input" value="1" {{ old('blog_section_enabled', $setting->blog_section_enabled) ? 'checked' : '' }}>
          <label class="form-check-label" for="blog_section_enabled">Tampilkan bagian "Artikel Terbaru" di landing page</label>
        </div>
        <div class="form-text">
          Jika aktif, landing page akan menampilkan maksimal 3 artikel terbaru yang sudah dipublikasikan (diambil otomatis, urut dari yang terbaru).
          Kelola artikel di menu <a href="{{ route('admin.posts.index') }}">Artikel</a>.
        </div>
      </div>
    </div>
  </div>

  <div class="card shadow-sm mb-3">
    <div class="card-header bg-white fw-semibold">Footer</div>
    <div class="card-body row g-3">
      <div class="col-md-6">
        <label class="form-label">Judul Footer</label>
        <input type="text" name="footer_title" class="form-control" value="{{ old('footer_title', $setting->footer_title) }}" required>
      </div>
      <div class="col-md-6">
        <label class="form-label">Sub Judul Footer</label>
        <input type="text" name="footer_subtitle" class="form-control" value="{{ old('footer_subtitle', $setting->footer_subtitle) }}">
      </div>
      <div class="col-md-6">
        <label class="form-label">Teks Tombol CTA</label>
        <input type="text" name="footer_cta_text" class="form-control" value="{{ old('footer_cta_text', $setting->footer_cta_text) }}">
      </div>
      <div class="col-md-6">
        <label class="form-label">Link Tombol CTA (opsional, default ke WhatsApp)</label>
        <input type="text" name="footer_cta_link" class="form-control" value="{{ old('footer_cta_link', $setting->footer_cta_link) }}">
      </div>
      <div class="col-md-6">
        <label class="form-label">Gambar Latar Footer (parallax)</label>
        @if($setting->footer_bg)<div class="mb-2"><img src="{{ asset('storage/'.$setting->footer_bg) }}" class="thumb-preview"></div>@endif
        <input type="file" name="footer_bg" class="form-control" accept="image/*">
      </div>
    </div>
  </div>

  <div class="card shadow-sm mb-3">
    <div class="card-header bg-white fw-semibold">Kontak &amp; Sosial Media (Footer)</div>
    <div class="card-body row g-3">
      <div class="col-md-6">
        <label class="form-label">Alamat</label>
        <input type="text" name="footer_address" class="form-control" value="{{ old('footer_address', $setting->footer_address) }}" placeholder="Kemiri Lor, Kepuhkemiri, Sidoarjo, Jawa Timur">
      </div>
      <div class="col-md-6">
        <label class="form-label">Email</label>
        <input type="email" name="footer_email" class="form-control" value="{{ old('footer_email', $setting->footer_email) }}" placeholder="info@domain.com">
      </div>
      <div class="col-md-4">
        <label class="form-label">Facebook (URL)</label>
        <input type="text" name="social_facebook" class="form-control" value="{{ old('social_facebook', $setting->social_facebook) }}" placeholder="https://facebook.com/...">
      </div>
      <div class="col-md-4">
        <label class="form-label">Instagram (URL)</label>
        <input type="text" name="social_instagram" class="form-control" value="{{ old('social_instagram', $setting->social_instagram) }}" placeholder="https://instagram.com/...">
      </div>
      <div class="col-md-4">
        <label class="form-label">TikTok (URL)</label>
        <input type="text" name="social_tiktok" class="form-control" value="{{ old('social_tiktok', $setting->social_tiktok) }}" placeholder="https://tiktok.com/@...">
      </div>
      <div class="col-md-4">
        <label class="form-label">LinkedIn (URL)</label>
        <input type="text" name="social_linkedin" class="form-control" value="{{ old('social_linkedin', $setting->social_linkedin) }}" placeholder="https://linkedin.com/company/...">
      </div>
      <div class="col-md-4">
        <label class="form-label">YouTube (URL)</label>
        <input type="text" name="social_youtube" class="form-control" value="{{ old('social_youtube', $setting->social_youtube) }}" placeholder="https://youtube.com/@...">
      </div>
      <div class="col-md-4">
        <label class="form-label">X / Twitter (URL)</label>
        <input type="text" name="social_x" class="form-control" value="{{ old('social_x', $setting->social_x) }}" placeholder="https://x.com/...">
      </div>
      <div class="col-12">
        <div class="form-text">Setiap ikon sosial media hanya muncul di footer jika URL-nya diisi.</div>
      </div>
    </div>
  </div>

  <button type="submit" class="btn btn-dark">Simpan Pengaturan</button>
</form>
@endsection
