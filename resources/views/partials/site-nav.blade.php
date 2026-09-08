{{-- Navbar — struktur & markup disamakan persis dengan navbar landing page
     (resources/views/home.blade.php): logo, promo marquee, dropdown menu
     "Layanan" & "Info", language switcher, tombol WhatsApp, dan toggle mobile.
     Link jangkar (#about, #services, dst) diarahkan kembali ke route('home')
     karena halaman ini bukan halaman utama. --}}
<nav class="site-nav blog-nav" id="site-nav">
  <div class="container site-nav_inner">
    <a href="{{ route('home') }}" class="site-nav_brand">
      <img src="{{ $setting->logo ? asset('storage/'.$setting->logo) : asset('images/logo.png') }}" alt="{{ $setting->site_title ?? 'Asa Production' }}"/>
      <span>{{ $setting->site_title ?? 'Asa Production' }}</span>
    </a>

    @if($setting->promo_enabled && $setting->promo_text)
    <div class="site-nav_marquee" aria-label="Promo">
      <div class="site-nav_marquee-track">
        <span>{{ $setting->promo_text }}</span>
        <span>{{ $setting->promo_text }}</span>
      </div>
    </div>
    @endif

    <ul class="site-nav_menu" id="navMenu">
      <li><a href="{{ route('home') }}" data-i18n="nav.home">Home</a></li>
      <li class="has-dropdown">
        <button type="button" class="dropdown-toggle"><span data-i18n="nav.servicesToggle">Layanan</span> <i class="fa fa-chevron-down" aria-hidden="true"></i></button>
        <ul class="dropdown-menu">
          <li><a href="{{ route('home') }}#services" data-i18n="nav.servicesItem">Layanan</a></li>
        </ul>
      </li>
      <li class="has-dropdown">
        <button type="button" class="dropdown-toggle"><span data-i18n="nav.infoToggle">Info</span> <i class="fa fa-chevron-down" aria-hidden="true"></i></button>
        <ul class="dropdown-menu">
          <li><a href="{{ route('blog.index') }}" data-i18n="nav.blog">Blog</a></li>
          <li><a href="{{ route('portfolio.index') }}" data-i18n="nav.portfolio">Portofolio</a></li>
          <li><a href="{{ route('about') }}" data-i18n="nav.about">Tentang Kami</a></li>
          <li><a href="{{ route('contact') }}" data-i18n="nav.contact">Kontak</a></li>
        </ul>
      </li>
    </ul>

    <div class="site-nav_utility">
      {{-- Language switcher: dropdown, tampilan bendera SVG — sama seperti landing page --}}
      <div class="site-nav_lang has-dropdown" id="langSwitcher">
        <button type="button" class="dropdown-toggle lang-toggle" id="langToggle" aria-haspopup="true" aria-expanded="false" aria-label="Change language">
          <span class="lang-flag-icon" id="langCurrentFlag" aria-hidden="true">
            <svg viewBox="0 0 3 2" xmlns="http://www.w3.org/2000/svg"><rect width="3" height="1" fill="#CE1126"/><rect y="1" width="3" height="1" fill="#FFFFFF"/></svg>
          </span>
          <i class="fa fa-chevron-down" aria-hidden="true"></i>
        </button>
        <ul class="dropdown-menu lang-menu" role="listbox" aria-label="Choose language">
          <li role="presentation">
            <button type="button" class="lang-option is-active" data-lang="id" role="option" aria-checked="true" aria-label="Bahasa Indonesia">
              <span class="lang-flag-icon" aria-hidden="true">
                <svg viewBox="0 0 3 2" xmlns="http://www.w3.org/2000/svg"><rect width="3" height="1" fill="#CE1126"/><rect y="1" width="3" height="1" fill="#FFFFFF"/></svg>
              </span>
              <span class="lang-option-label" aria-hidden="true">Indonesia</span>
            </button>
          </li>
          <li role="presentation">
            <button type="button" class="lang-option" data-lang="en" role="option" aria-checked="false" aria-label="English">
              <span class="lang-flag-icon" aria-hidden="true">
                <svg viewBox="0 0 60 30" xmlns="http://www.w3.org/2000/svg">
                  <rect width="60" height="30" fill="#00247d"/>
                  <path d="M0,0 L60,30 M60,0 L0,30" stroke="#fff" stroke-width="6"/>
                  <path d="M0,0 L60,30 M60,0 L0,30" stroke="#cf142b" stroke-width="2"/>
                  <path d="M30,0 V30 M0,15 H60" stroke="#fff" stroke-width="10"/>
                  <path d="M30,0 V30 M0,15 H60" stroke="#cf142b" stroke-width="6"/>
                </svg>
              </span>
              <span class="lang-option-label" aria-hidden="true">English</span>
            </button>
          </li>
        </ul>
      </div>

      <button class="site-nav_toggle" id="navToggle" data-i18n-aria-label="nav.toggleLabel" aria-label="Toggle menu">
        <span></span><span></span><span></span>
      </button>
    </div>

    <a href="https://wa.me/{{ $setting->whatsapp_number }}?text={{ urlencode($setting->whatsapp_message) }}"
       target="_blank" rel="noopener" class="site-nav_cta" style="display:inline-flex;align-items:center;gap:8px;">
      <svg viewBox="0 0 32 32" width="18" height="18" fill="currentColor" style="flex-shrink:0;">
        <path d="M16.001 3C9.373 3 4 8.373 4 15c0 2.386.7 4.607 1.906 6.475L4 29l7.72-1.867A11.94 11.94 0 0 0 16.001 27C22.628 27 28 21.627 28 15S22.628 3 16.001 3zm0 21.818a9.77 9.77 0 0 1-4.98-1.363l-.357-.212-4.583 1.108 1.127-4.47-.233-.367A9.78 9.78 0 0 1 6.182 15c0-5.415 4.404-9.818 9.819-9.818S25.818 9.585 25.818 15 21.415 24.818 16.001 24.818zm5.396-7.34c-.296-.148-1.75-.864-2.021-.963-.271-.099-.469-.148-.667.148-.198.296-.766.963-.939 1.161-.173.198-.346.222-.642.074-.296-.148-1.249-.46-2.379-1.467-.879-.784-1.472-1.753-1.645-2.049-.173-.296-.018-.456.13-.604.134-.133.296-.346.444-.519.148-.173.198-.297.296-.494.099-.198.05-.371-.025-.519-.074-.148-.667-1.607-.914-2.202-.24-.577-.485-.499-.667-.508l-.568-.01c-.198 0-.519.074-.79.371-.271.297-1.037 1.014-1.037 2.472s1.062 2.868 1.21 3.066c.148.198 2.089 3.19 5.062 4.474.707.305 1.259.487 1.689.623.71.226 1.355.194 1.866.118.569-.085 1.75-.716 1.997-1.407.247-.692.247-1.284.173-1.407-.074-.123-.271-.198-.568-.346z"/>
      </svg>
      WhatsApp
    </a>
  </div>
</nav>
