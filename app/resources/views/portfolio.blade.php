<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="format-detection" content="telephone=no"/>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Portofolio - {{ $setting->site_title ?? 'Asa Production' }}</title>
  <meta name="description" content="Kumpulan hasil proyek website, aplikasi, dan sistem custom yang telah dikerjakan {{ $setting->site_title ?? 'Asa Production' }}.">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="icon" href="{{ $setting->favicon ? asset('storage/'.$setting->favicon) : asset('images/favicon.ico') }}" type="image/x-icon">

  {{-- Stylesheet yang sama dengan landing page & halaman lain, agar warna, font, dan komponen (navbar, tombol, footer) konsisten --}}
  <link rel="stylesheet" href="{{ asset('css/grid.css') }}">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('css/site-nav-shared.css') }}">
  <link rel="stylesheet" href="{{ asset('css/blog-theme.css') }}">
  <link rel="stylesheet" href="{{ asset('css/portfolio-theme.css') }}">
</head>
<body class="blog-body">

  @include('partials.site-nav')

  {{-- ======================== MASTHEAD ======================== --}}
  <div class="portfolio-masthead">
    <div class="container">
      <span class="eyebrow" data-i18n="portfolioPage.eyebrow">Portofolio</span>
      <h1 data-i18n="portfolioPage.mastheadTitle">Temukan Inspirasimu</h1>
      <p data-i18n="portfolioPage.mastheadDesc" data-i18n-var-site="{{ $setting->site_title ?? 'Asa Production' }}">Kumpulan proyek website, aplikasi, dan sistem custom yang telah dikerjakan tim {{ $setting->site_title ?? 'Asa Production' }} untuk berbagai klien.</p>
    </div>
  </div>

  {{-- ======================== FILTER TABS ======================== --}}
  @if($categories->count())
  <div class="portfolio-filter-wrap">
    <div class="container">
      <div class="portfolio-filter" id="portfolioFilter" role="tablist">
        <button type="button" class="portfolio-filter_tab is-active" data-category="all" role="tab" aria-selected="true" data-i18n="portfolioPage.filterAll">All</button>
        @foreach($categories as $category)
        <button type="button" class="portfolio-filter_tab" data-category="{{ $category }}" role="tab" aria-selected="false">{{ $category }}</button>
        @endforeach
      </div>
    </div>
  </div>
  @endif

  {{-- ======================== GRID ======================== --}}
  <div class="portfolio-wrap">
    <div class="container">
      @if($portfolios->count())
      <div class="portfolio-grid" id="portfolioGrid">
        @foreach($portfolios as $item)
        <div class="portfolio-card" data-category="{{ $item->category ?: 'all' }}">
          <button type="button" class="portfolio-card_thumb" data-full="{{ asset('storage/'.$item->image) }}" data-title="{{ $item->title }}" aria-label="{{ $item->title ?: 'Lihat detail proyek' }}">
            <img src="{{ asset('storage/'.$item->thumbnail) }}" alt="{{ $item->title }}" loading="lazy"/>
          </button>
          <div class="portfolio-card_body">
            @if($item->category)
            <span class="portfolio-card_tag">{{ $item->category }}</span>
            @endif
            @if($item->title)
            <h3 class="portfolio-card_title">{{ $item->title }}</h3>
            @endif
            @if($item->description)
            <p class="portfolio-card_desc">{{ $item->description }}</p>
            @endif
            @if($item->link)
            <a href="{{ $item->link }}" target="_blank" rel="noopener" class="portfolio-card_link" data-i18n="portfolioPage.viewProject">Lihat Proyek &rarr;</a>
            @endif
          </div>
        </div>
        @endforeach
      </div>
      <p class="portfolio-empty-filtered" id="portfolioEmptyFiltered" hidden data-i18n="portfolioPage.emptyFiltered">Belum ada proyek pada kategori ini.</p>
      @else
      <div class="blog-empty" data-i18n="portfolioPage.empty">Belum ada portofolio yang dipublikasikan.</div>
      @endif
    </div>
  </div>

  {{-- ======================== LIGHTBOX ======================== --}}
  <div class="portfolio-lightbox" id="portfolioLightbox">
    <button type="button" class="portfolio-lightbox_close" id="portfolioLightboxClose" aria-label="Tutup">
      <svg viewBox="0 0 24 24" width="26" height="26" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
    </button>
    <figure class="portfolio-lightbox_content">
      <img src="" alt="" id="portfolioLightboxImg"/>
      <figcaption id="portfolioLightboxCaption"></figcaption>
    </figure>
  </div>

  @include('partials.site-footer')

  <script src="{{ asset('js/i18n-data.js') }}"></script>
  <script src="{{ asset('js/i18n-lib.js') }}"></script>
  <script src="{{ asset('js/site-nav.js') }}"></script>
  <script src="{{ asset('js/portfolio-filter.js') }}"></script>
  <script>
    {{-- site-nav.js sudah memanggil I18n.init & bindLangSwitcher;
         di sini cukup expose helper yang dipakai chatbot widget --}}
    window.__siteLang = function () { return window.I18n ? window.I18n.getLang() : 'id'; };
    window.__t = function (key) { return window.I18n ? window.I18n.t(key) : key; };
  </script>

  @include('partials.chatbot-widget')
</body>
</html>
