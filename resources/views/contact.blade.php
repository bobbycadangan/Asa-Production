<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="format-detection" content="telephone=no"/>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Kontak - {{ $setting->site_title ?? 'Asa Production' }}</title>
  <meta name="description" content="Hubungi {{ $setting->site_title ?? 'Asa Production' }} untuk konsultasi jasa pembuatan website, aplikasi, dan sistem custom untuk bisnis Anda.">

  <link rel="icon" href="{{ $setting->favicon ? asset('storage/'.$setting->favicon) : asset('images/favicon.ico') }}" type="image/x-icon">

  {{-- Stylesheet yang sama dengan landing page & halaman lain, agar warna, font, dan komponen (navbar, tombol, footer) konsisten --}}
  <link rel="stylesheet" href="{{ asset('css/grid.css') }}">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('css/site-nav-shared.css') }}">
  <link rel="stylesheet" href="{{ asset('css/blog-theme.css') }}">
</head>
<body class="blog-body">

  @include('partials.site-nav')

  {{-- ======================== MASTHEAD ======================== --}}
  <div class="contact-masthead">
    <div class="container">
      <span class="eyebrow" data-i18n="contactPage.eyebrow">Kontak</span>
      <h1 data-i18n="contactPage.mastheadTitle">Hubungi Kami, dan Mari Mulai Cerita Baru</h1>
      <p data-i18n="contactPage.mastheadDesc" data-i18n-var-site="{{ $setting->site_title ?? 'Asa Production' }}">Punya pertanyaan atau ingin konsultasi proyek website, aplikasi, atau sistem custom? Tim {{ $setting->site_title ?? 'Asa Production' }} siap membantu Anda.</p>
    </div>
  </div>

  {{-- ======================== INFO + FORM ======================== --}}
  <div class="contact-wrap">
    <div class="contact-info-grid">
      <div class="contact-info-card">
        <div class="contact-info-card_icon">
          <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
        </div>
        <h3 data-i18n="contactPage.addressTitle">Address</h3>
        <p>{{ $setting->footer_address ?: 'Sidoarjo, Jawa Timur, Indonesia' }}</p>
      </div>

      <div class="contact-info-card">
        <div class="contact-info-card_icon">
          <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.362 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.338 1.85.573 2.81.7A2 2 0 0 1 22 16.92Z"/></svg>
        </div>
        <h3 data-i18n="contactPage.callTitle">Call Us</h3>
        <p>{{ $setting->whatsapp_number }}</p>
      </div>

      @if($setting->footer_email)
      <div class="contact-info-card">
        <div class="contact-info-card_icon">
          <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
        </div>
        <h3 data-i18n="contactPage.emailTitle">Email Us</h3>
        <p>{{ $setting->footer_email }}</p>
      </div>
      @endif

      <div class="contact-info-card">
        <div class="contact-info-card_icon">
          <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
        </div>
        <h3 data-i18n="contactPage.hoursTitle">Open Hours</h3>
        <p><span data-i18n="contactPage.hoursWeekday">Senin - Jumat</span><br>09:00 - 17:00</p>
      </div>
    </div>

    <div class="contact-form-card">
      @if(session('success'))
      <div class="contact-form-alert">{{ session('success') }}</div>
      @endif

      @if($errors->any())
      <div class="contact-form-errors">
        <ul>
          @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
      @endif

      <form method="POST" action="{{ route('contact.store') }}">
        @csrf
        <div class="contact-form-row">
          <div class="contact-form-field">
            <label for="name" data-i18n="contactPage.formNameLabel">Your Name</label>
            <input type="text" id="name" name="name" placeholder="Your Name" data-i18n-placeholder="contactPage.formNameLabel" value="{{ old('name') }}" required>
          </div>
          <div class="contact-form-field">
            <label for="email" data-i18n="contactPage.formEmailLabel">Your Email</label>
            <input type="email" id="email" name="email" placeholder="Your Email" data-i18n-placeholder="contactPage.formEmailLabel" value="{{ old('email') }}" required>
          </div>
        </div>
        <div class="contact-form-field">
          <label for="subject" data-i18n="contactPage.formSubjectLabel">Subject</label>
          <input type="text" id="subject" name="subject" placeholder="Subject" data-i18n-placeholder="contactPage.formSubjectLabel" value="{{ old('subject') }}">
        </div>
        <div class="contact-form-field">
          <label for="message" data-i18n="contactPage.formMessageLabel">Message</label>
          <textarea id="message" name="message" placeholder="Message" data-i18n-placeholder="contactPage.formMessageLabel" required>{{ old('message') }}</textarea>
        </div>
        <div style="text-align:center; margin-top:10px;">
          <button type="submit" class="btn contact-form-submit" data-i18n="contactPage.formSubmit">Send Message</button>
        </div>
      </form>
    </div>
  </div>

  @include('partials.site-footer')

  <script src="{{ asset('js/i18n-data.js') }}"></script>
  <script src="{{ asset('js/i18n-lib.js') }}"></script>
  <script src="{{ asset('js/site-nav.js') }}"></script>
  <script>
    {{-- site-nav.js sudah memanggil I18n.init & bindLangSwitcher;
         di sini cukup expose helper yang dipakai chatbot widget --}}
    window.__siteLang = function () { return window.I18n ? window.I18n.getLang() : 'id'; };
    window.__t = function (key) { return window.I18n ? window.I18n.t(key) : key; };
  </script>

  @include('partials.chatbot-widget')
</body>
</html>
