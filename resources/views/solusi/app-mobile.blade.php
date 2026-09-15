<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="format-detection" content="telephone=no"/>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Jasa Pembuatan Aplikasi Mobile - {{ $setting->site_title ?? 'Asa Production' }}</title>
  <meta name="description" content="{{ $page->meta_description ?? 'Jasa pembuatan aplikasi mobile Android, iOS, dan cross-platform oleh '.($setting->site_title ?? 'Asa Production').'.' }}">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="icon" href="{{ $setting->favicon ? asset('storage/'.$setting->favicon) : asset('images/favicon.ico') }}" type="image/x-icon">

  {{-- Stylesheet yang sama dengan halaman lain, agar warna, font, dan komponen (navbar, tombol, footer) konsisten --}}
  <link rel="stylesheet" href="{{ asset('css/grid.css') }}">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('css/site-nav-shared.css') }}">
  <link rel="stylesheet" href="{{ asset('css/blog-theme.css') }}">
  {{-- Stylesheet khusus halaman ini (masthead, benefit grid, proses, dst) --}}
  <link rel="stylesheet" href="{{ asset('css/solusi-theme.css') }}">
</head>
<body class="blog-body">

  @include('partials.site-nav')

  @include('partials.breadcrumb', ['items' => [
    ['label' => 'Jasa Pembuatan App Mobile', 'i18n' => 'nav.servicesAppMobile'],
  ]])

  {{-- ======================== MASTHEAD ======================== --}}
  {{-- Seluruh teks di bawah ini dikelola dari Admin > Jasa App Mobile --}}
  <div class="solusi-masthead" style="background-image: linear-gradient(180deg, rgba(0, 20, 46, 0.6) 0%, rgba(0, 20, 46, 0.88) 100%), url('{{ $page->hero_background ? asset('storage/'.$page->hero_background) : asset('images/parallax2.jpg') }}');">
    <div class="container">
      <span class="eyebrow">{{ $page->hero_eyebrow }}</span>
      <h1>{{ $page->hero_title }}</h1>
      <p>{{ $page->hero_description }}</p>
      <div class="solusi-masthead_actions">
        <a href="https://wa.me/{{ $setting->whatsapp_number }}?text={{ urlencode($page->whatsapp_message) }}"
           target="_blank" rel="noopener" class="btn btn-whatsapp" style="font-size:16px;padding:15px 26px;">
          <svg viewBox="0 0 32 32" width="22" height="22" fill="currentColor" style="vertical-align:middle;flex-shrink:0;">
            <path d="M16.001 3C9.373 3 4 8.373 4 15c0 2.386.7 4.607 1.906 6.475L4 29l7.72-1.867A11.94 11.94 0 0 0 16.001 27C22.628 27 28 21.627 28 15S22.628 3 16.001 3zm0 21.818a9.77 9.77 0 0 1-4.98-1.363l-.357-.212-4.583 1.108 1.127-4.47-.233-.367A9.78 9.78 0 0 1 6.182 15c0-5.415 4.404-9.818 9.819-9.818S25.818 9.585 25.818 15 21.415 24.818 16.001 24.818zm5.396-7.34c-.296-.148-1.75-.864-2.021-.963-.271-.099-.469-.148-.667.148-.198.296-.766.963-.939 1.161-.173.198-.346.222-.642.074-.296-.148-1.249-.46-2.379-1.467-.879-.784-1.472-1.753-1.645-2.049-.173-.296-.018-.456.13-.604.134-.133.296-.346.444-.519.148-.173.198-.297.296-.494.099-.198.05-.371-.025-.519-.074-.148-.667-1.607-.914-2.202-.24-.577-.485-.499-.667-.508l-.568-.01c-.198 0-.519.074-.79.371-.271.297-1.037 1.014-1.037 2.472s1.062 2.868 1.21 3.066c.148.198 2.089 3.19 5.062 4.474.707.305 1.259.487 1.689.623.71.226 1.355.194 1.866.118.569-.085 1.75-.716 1.997-1.407.247-.692.247-1.284.173-1.407-.074-.123-.271-.198-.568-.346z"/>
          </svg>
          <span data-i18n="solusi.ctaFreeConsult">Konsultasi Gratis</span>
        </a>
        <a href="{{ route('portfolio.index') }}" class="btn btn-outline" style="font-size:16px;padding:15px 26px;" data-i18n="solusi.ctaViewPortfolio">Lihat Portofolio</a>
      </div>
    </div>
  </div>

  {{-- ======================== STAT STRIP ======================== --}}
  {{-- Dikelola dari Admin > Jasa App Mobile > Kelola Statistik --}}
  @if($stats->count())
  <div class="solusi-stats">
    <div class="solusi-stats_inner">
      @foreach($stats as $stat)
      <div class="solusi-stat">
        <span class="solusi-stat_num">{{ $stat->value }}</span>
        <span class="solusi-stat_label">{{ $stat->label }}</span>
      </div>
      @endforeach
    </div>
  </div>
  @endif

  {{-- ======================== KENAPA PILIH KAMI ======================== --}}
  {{-- Dikelola dari Admin > Jasa App Mobile > Kelola Poin Keunggulan --}}
  @if($benefits->count())
  <section class="solusi-section">
    <div class="solusi-section_head">
      <span class="solusi-section_eyebrow">{{ $page->why_us_eyebrow }}</span>
      <h2>{{ $page->why_us_title }}</h2>
      <p>{{ $page->why_us_description }}</p>
    </div>
    <div class="benefit-grid">
      @foreach($benefits as $benefit)
      <div class="benefit-card">
        <div class="benefit-card_icon"><i class="fa {{ $benefit->icon }}" aria-hidden="true"></i></div>
        <h3>{{ $benefit->title }}</h3>
        <p>{{ $benefit->description }}</p>
      </div>
      @endforeach
    </div>
  </section>
  @endif

  {{-- ======================== LAYANAN YANG KAMI TAWARKAN ======================== --}}
  {{-- Dikelola dari Admin > Jasa App Mobile > Kelola Daftar Layanan --}}
  @if($appServices->count())
  <section class="solusi-section" style="background:#f9fafc;max-width:100%;">
    <div class="solusi-section_head">
      <span class="solusi-section_eyebrow">{{ $page->services_eyebrow }}</span>
      <h2>{{ $page->services_title }}</h2>
      <p>{{ $page->services_description }}</p>
    </div>
    <div class="service-grid" style="max-width:1140px;margin:0 auto;">
      @foreach($appServices as $item)
      <div class="service-card">
        <div class="service-card_icon"><i class="fa {{ $item->icon }}" aria-hidden="true"></i></div>
        <h3>{{ $item->title }}</h3>
      </div>
      @endforeach
    </div>
  </section>
  @endif

  {{-- ======================== PROSES PENGEMBANGAN ======================== --}}
  {{-- Dikelola dari Admin > Jasa App Mobile > Kelola Langkah Proses --}}
  @if($processSteps->count())
  <section class="solusi-section">
    <div class="solusi-section_head">
      <span class="solusi-section_eyebrow">{{ $page->process_eyebrow }}</span>
      <h2>{{ $page->process_title }}</h2>
      <p>{{ $page->process_description }}</p>
    </div>
    <div class="process-steps">
      @foreach($processSteps as $index => $step)
      <div class="process-step">
        <div class="process-step_num">{{ $index + 1 }}</div>
        <h3>{{ $step->title }}</h3>
        <p>{{ $step->description }}</p>
      </div>
      @endforeach
    </div>
  </section>
  @endif

  {{-- ======================== TEKNOLOGI YANG KAMI GUNAKAN ======================== --}}
  {{-- Dikelola dari Admin > Jasa App Mobile > Kelola Badge Teknologi --}}
  @if($techBadges->count())
  <section class="solusi-section solusi-section--tight" style="background:#f9fafc;max-width:100%;">
    <div class="solusi-section_head" style="margin-bottom:30px;">
      <span class="solusi-section_eyebrow">{{ $page->tech_eyebrow }}</span>
      <h2>{{ $page->tech_title }}</h2>
    </div>
    <div class="tech-badges">
      @foreach($techBadges as $tech)
      <span class="tech-badge"><i class="fa {{ $tech->icon }}" aria-hidden="true"></i> {{ $tech->label }}</span>
      @endforeach
    </div>
  </section>
  @endif

  {{-- ======================== PORTOFOLIO PREVIEW ======================== --}}
  {{-- Judul dikelola dari Admin > Jasa App Mobile; isi diambil dari menu Portofolio --}}
  @if($showcasePortfolios->count())
  <section class="solusi-section">
    <div class="solusi-section_head">
      <span class="solusi-section_eyebrow">{{ $page->portfolio_eyebrow }}</span>
      <h2>{{ $page->portfolio_title }}</h2>
      <p>{{ $page->portfolio_description }}</p>
    </div>
    <div class="solusi-portfolio-grid">
      @foreach($showcasePortfolios as $item)
      <a class="solusi-portfolio-card" href="{{ route('portfolio.index') }}">
        <img src="{{ asset('storage/'.$item->thumbnail) }}" alt="{{ $item->title }}" loading="lazy"/>
        <span class="solusi-portfolio-card_overlay"><span>{{ $item->title }}</span></span>
      </a>
      @endforeach
    </div>
    <div class="center" style="text-align:center;margin-top:40px;">
      <a href="{{ route('portfolio.index') }}" class="btn btn-sm" data-i18n="solusi.ctaViewAllPortfolio">Lihat Semua Portofolio</a>
    </div>
  </section>
  @endif

  {{-- ======================== FAQ ======================== --}}
  {{-- Dikelola dari Admin > Jasa App Mobile > Kelola Daftar FAQ --}}
  @if($appFaqs->count())
  <section class="solusi-section" style="background:#f9fafc;max-width:100%;">
    <div class="solusi-section_head">
      <span class="solusi-section_eyebrow">{{ $page->faq_eyebrow }}</span>
      <h2>{{ $page->faq_title }}</h2>
    </div>
    <div class="solusi-faq-list">
      @foreach($appFaqs as $index => $faq)
      <details class="solusi-faq-item" @if($index === 0) open @endif>
        <summary>{{ $faq->question }}<i class="fa fa-chevron-right" aria-hidden="true"></i></summary>
        <div class="solusi-faq-answer"><p>{{ $faq->answer }}</p></div>
      </details>
      @endforeach
    </div>
  </section>
  @endif

  {{-- ======================== CTA BANNER ======================== --}}
  {{-- Dikelola dari Admin > Jasa App Mobile --}}
  <section style="padding:0 20px;">
    <div class="solusi-cta">
      <h2>{{ $page->cta_title }}</h2>
      <p>{{ $page->cta_description }}</p>
      <div class="solusi-cta_actions">
        <a href="https://wa.me/{{ $setting->whatsapp_number }}?text={{ urlencode($page->whatsapp_message) }}"
           target="_blank" rel="noopener" class="btn btn-whatsapp" style="font-size:16px;padding:15px 26px;">
          <svg viewBox="0 0 32 32" width="22" height="22" fill="currentColor" style="vertical-align:middle;flex-shrink:0;">
            <path d="M16.001 3C9.373 3 4 8.373 4 15c0 2.386.7 4.607 1.906 6.475L4 29l7.72-1.867A11.94 11.94 0 0 0 16.001 27C22.628 27 28 21.627 28 15S22.628 3 16.001 3zm0 21.818a9.77 9.77 0 0 1-4.98-1.363l-.357-.212-4.583 1.108 1.127-4.47-.233-.367A9.78 9.78 0 0 1 6.182 15c0-5.415 4.404-9.818 9.819-9.818S25.818 9.585 25.818 15 21.415 24.818 16.001 24.818zm5.396-7.34c-.296-.148-1.75-.864-2.021-.963-.271-.099-.469-.148-.667.148-.198.296-.766.963-.939 1.161-.173.198-.346.222-.642.074-.296-.148-1.249-.46-2.379-1.467-.879-.784-1.472-1.753-1.645-2.049-.173-.296-.018-.456.13-.604.134-.133.296-.346.444-.519.148-.173.198-.297.296-.494.099-.198.05-.371-.025-.519-.074-.148-.667-1.607-.914-2.202-.24-.577-.485-.499-.667-.508l-.568-.01c-.198 0-.519.074-.79.371-.271.297-1.037 1.014-1.037 2.472s1.062 2.868 1.21 3.066c.148.198 2.089 3.19 5.062 4.474.707.305 1.259.487 1.689.623.71.226 1.355.194 1.866.118.569-.085 1.75-.716 1.997-1.407.247-.692.247-1.284.173-1.407-.074-.123-.271-.198-.568-.346z"/>
          </svg>
          <span data-i18n="solusi.ctaWhatsapp">Chat via WhatsApp</span>
        </a>
        <a href="{{ route('contact') }}" class="btn btn-outline" style="font-size:16px;padding:15px 26px;" data-i18n="solusi.ctaContactForm">Isi Form Kontak</a>
      </div>
    </div>
  </section>

  @include('partials.site-footer')

  <script src="{{ asset('js/i18n-data.js') }}"></script>
  <script src="{{ asset('js/i18n-lib.js') }}"></script>
  <script src="{{ asset('js/site-nav.js') }}"></script>
  <script>
    window.__siteLang = function () { return window.I18n ? window.I18n.getLang() : 'id'; };
    window.__t = function (key) { return window.I18n ? window.I18n.t(key) : key; };
  </script>

  @include('partials.chatbot-widget')
</body>
</html>
