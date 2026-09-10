<!DOCTYPE html>
<html lang="id">
<head>
  <title>{{ $setting->site_title }} - {{ $setting->brand_slogan }}</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="format-detection" content="telephone=no"/>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="icon" href="{{ $setting->favicon ? asset('storage/'.$setting->favicon) : asset('images/favicon.ico') }}" type="image/x-icon">
  <link rel="stylesheet" href="{{ asset('css/grid.css') }}">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('css/jquery.fancybox.css') }}"/>
  <link rel="stylesheet" href="{{ asset('css/owl-carousel.css') }}"/>

  <script src="{{ asset('js/jquery.js') }}"></script>
  <script src="{{ asset('js/jquery-migrate-1.2.1.js') }}"></script>
  <script src='{{ asset('js/device.min.js') }}'></script>
  <script src="{{ asset('js/i18n-data.js') }}"></script>
  <script src="{{ asset('js/i18n-lib.js') }}"></script>

  <style>
    /* ===== Hero section fix ===== */
    header.vide .vide_content{
      padding-top: 80px;
      padding-bottom: 80px;
    }
    header.vide .hero-text h2{
      font-size: clamp(24px, 4vw, 40px);
      line-height: 1.25;
      font-weight: 700;
    }
    header.vide .hero-text h3{
      font-size: clamp(15px, 2vw, 18px);
      line-height: 1.5;
      font-weight: 400;
      opacity: .9;
    }
    header.vide .brand_name{
      font-size: clamp(18px, 2.2vw, 22px);
    }
    header.vide .brand_slogan{
      font-size: clamp(12px, 1.4vw, 14px);
      opacity: .85;
    }

    /* ===== Subtle hover micro-interactions ===== */
    .well__ins1 .grid_4{
      transition: transform .35s cubic-bezier(.22,1,.36,1);
    }
    .well__ins1 .grid_4:hover{
      transform: translateY(-6px);
    }
    .faq-item{
      transition: box-shadow .3s ease, transform .3s ease;
    }
    .faq-item:hover{
      transform: translateY(-2px);
    }

    /* ===== Hero load-in animation ===== */
    .hero-fade-in_item{
      opacity: 0;
      transform: translateY(22px);
      animation: hero-fade-in-up .9s cubic-bezier(.22,1,.36,1) forwards;
    }
    .hero-fade-in_item:nth-child(1){ animation-delay: .15s; }
    .hero-fade-in_item:nth-child(2){ animation-delay: .32s; }
    .hero-fade-in_item:nth-child(3){ animation-delay: .5s; }
    @keyframes hero-fade-in-up{
      to{ opacity: 1; transform: translateY(0); }
    }
    @media (prefers-reduced-motion: reduce){
      .hero-fade-in_item{ animation: none; opacity: 1; transform: none; }
    }

    /* ===== Navbar running text (marquee) ===== */
    .site-nav_marquee{
      flex: 1 1 auto;
      min-width: 0;
      overflow: hidden;
      max-width: 260px;
      margin: 0 4px;
      white-space: nowrap;
      position: relative;
    }
    .site-nav_marquee::before,
    .site-nav_marquee::after{
      content: "";
      position: absolute;
      top: 0;
      bottom: 0;
      width: 20px;
      z-index: 2;
      pointer-events: none;
    }
    .site-nav_marquee::before{
      left: 0;
      background: linear-gradient(to right, rgba(0,20,46,1), rgba(0,20,46,0));
    }
    .site-nav_marquee::after{
      right: 0;
      background: linear-gradient(to left, rgba(0,20,46,1), rgba(0,20,46,0));
    }
    .site-nav_marquee-track{
      display: inline-block;
      white-space: nowrap;
      padding-left: 100%;
      animation: site-nav-marquee 14s linear infinite;
    }
    .site-nav_marquee-track span{
      display: inline-block;
      padding: 0 40px;
      font-size: 13px;
      font-weight: 600;
      color: #ffd166;
    }
    @keyframes site-nav-marquee{
      0%   { transform: translateX(0); }
      100% { transform: translateX(-100%); }
    }
    @media (max-width: 991px){
      .site-nav_marquee{
        display: none;
      }
    }
    @media (max-width: 768px){
      header.vide .vide_content{
        flex-direction: column-reverse;
        text-align: center;
        gap: 24px;
        padding-top: 60px;
        padding-bottom: 60px;
      }
      header.vide .brand{
        align-items: center !important;
        text-align: center !important;
      }
      header.vide .hero-text{
        text-align: center;
      }
    }

    /* ===== ABOUT / WHO WE ARE — split full-bleed 2 kolom (referensi: kreasiai.com) ===== */
    .about-split{
      display: grid;
      grid-template-columns: 1fr 1fr;
      align-items: stretch;
    }
    .about-split_col--text{
      background: #f4f6fb;
      display: flex;
      align-items: center;
    }
    .about-split_inner{
      max-width: 560px;
      margin: 0 auto;
      padding: 90px 60px;
    }
    .about-split_eyebrow{
      display: block;
      text-transform: uppercase;
      letter-spacing: 1px;
      font-weight: 700;
      font-size: 13px;
      color: var(--brand-accent, #2E8BFF);
      margin-bottom: 14px;
    }
    .about-split_title{
      text-align: left;
      margin: 0 0 20px;
      font-size: clamp(24px, 3vw, 32px);
      line-height: 1.3;
      color: #1a2340;
    }
    .about-split_desc{
      color: #6b7280;
      font-size: 15.5px;
      line-height: 1.75;
      margin: 0 0 30px;
    }
    .about-split_col--photo{
      overflow: hidden;
    }
    .about-split_col--photo img{
      width: 100%;
      height: 100%;
      object-fit: cover;
      display: block;
      min-height: 420px;
    }
    @media (max-width: 900px){
      .about-split{
        grid-template-columns: 1fr;
      }
      .about-split_inner{
        padding: 60px 24px;
        text-align: center;
      }
      .about-split_title,
      .about-split_eyebrow{
        text-align: center;
      }
      .about-split_col--photo img{
        min-height: 280px;
      }
    }

    /* ===== Partner marquee: geser mulus per-logo lalu berhenti sejenak, loop presisi tanpa skip ===== */
    @php
      $partnerTotal   = $partners->count();
      $rightCount     = (int) ceil($partnerTotal / 2);
      $leftCount      = (int) floor($partnerTotal / 2);
      // porsi waktu per logo: sebagian untuk geser (move), sisanya untuk diam (hold)
      $moveFraction   = 0.55; // 55% dari waktu tiap step dipakai untuk geser, 45% untuk diam
      $rightDuration  = max(8, $rightCount * 1.8);
      $leftDuration   = max(8, $leftCount * 1.8);
    @endphp
    @if($rightCount > 0)
    .partner-marquee--right .partner-marquee_track {
      animation: partner-marquee-right {{ $rightDuration }}s ease-in-out infinite;
    }
    @keyframes partner-marquee-right {
      @for($s = 0; $s <= $rightCount; $s++)
        @php
          // posisi pecahan eksak (bukan dibulatkan) supaya step terakhir jatuh TEPAT di -50%
          $posPct     = -50 * ($s / $rightCount);
          $stepStart  = ($s / $rightCount) * 100;
          $stepMoveEnd = $s < $rightCount
            ? $stepStart + (100 / $rightCount) * $moveFraction
            : $stepStart;
        @endphp
        {{ round($stepStart, 4) }}% { transform: translateX({{ round($posPct, 6) }}%); }
        @if($s < $rightCount)
          {{ round($stepMoveEnd, 4) }}% { transform: translateX({{ round(-50 * (($s+1) / $rightCount), 6) }}%); }
        @endif
      @endfor
    }
    @endif
    @if($leftCount > 0)
    .partner-marquee--left .partner-marquee_track {
      animation: partner-marquee-left {{ $leftDuration }}s ease-in-out infinite;
    }
    @keyframes partner-marquee-left {
      @for($s = 0; $s <= $leftCount; $s++)
        @php
          $posPct      = -50 + 50 * ($s / $leftCount);
          $stepStart   = ($s / $leftCount) * 100;
          $stepMoveEnd = $s < $leftCount
            ? $stepStart + (100 / $leftCount) * $moveFraction
            : $stepStart;
        @endphp
        {{ round($stepStart, 4) }}% { transform: translateX({{ round($posPct, 6) }}%); }
        @if($s < $leftCount)
          {{ round($stepMoveEnd, 4) }}% { transform: translateX({{ round(-50 + 50 * (($s+1) / $leftCount), 6) }}%); }
        @endif
      @endfor
    }
    @endif

    /* Footer columns dipindah ke public/css/style.css (dipakai bersama semua halaman) */

    /* ===== FAQ list, 2 kolom (kreasiai.com style) ===== */
    .faq-section .container.center + .container{
      margin-top: 40px;
    }
    .faq-list{
      max-width: 1100px;
      margin: 0 auto;
      display: grid;
      grid-template-columns: 1fr 1fr;
      column-gap: 60px;
      align-items: start;
    }
    .faq-item{
      border-bottom: 1px solid #e6e8ec;
      background: transparent;
    }
    .faq-item summary{
      list-style: none;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 16px;
      padding: 18px 4px;
      font-size: 15px;
      font-weight: 400;
      color: #2b2d33;
      text-transform: none;
      transition: color .2s ease;
    }
    .faq-item summary:hover{
      color: var(--brand-accent);
    }
    .faq-item summary::-webkit-details-marker{
      display: none;
    }
    .faq-item summary i{
      color: #b7bcc6;
      font-size: 13px;
      transition: transform .25s ease;
      flex-shrink: 0;
    }
    .faq-item[open] summary i{
      transform: rotate(90deg);
    }
    .faq-answer{
      padding: 0 4px 18px;
    }
    .faq-answer p{
      margin: 0;
      font-size: 14px;
      line-height: 24px;
      color: #808289;
    }
    @media (max-width: 767px){
      .faq-list{
        grid-template-columns: 1fr;
        column-gap: 0;
      }
    }
    @media (max-width: 479px){
      .faq-item summary{
        padding: 14px 2px;
        font-size: 14px;
      }
      .faq-answer{
        padding: 0 2px 14px;
      }
    }
    /* ===== Navbar dropdown groups (kreasiai.com style, lebih ringkas) ===== */
    .site-nav_menu .has-dropdown{
      position: relative;
    }
    .dropdown-toggle{
      background: none;
      border: none;
      color: #FFF;
      font-family: inherit;
      font-size: 15px;
      font-weight: 500;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      display: flex;
      align-items: center;
      gap: 6px;
      cursor: pointer;
      padding: 0 0 4px;
    }
    .dropdown-toggle:hover{
      color: var(--brand-accent);
    }
    .dropdown-toggle i{
      font-size: 11px;
      transition: transform .2s ease;
    }
    .has-dropdown:hover .dropdown-toggle i,
    .has-dropdown.is-open .dropdown-toggle i{
      transform: rotate(180deg);
    }
    .dropdown-menu{
      list-style: none;
      margin: 0;
      padding: 10px 0;
      position: absolute;
      top: 100%;
      left: 50%;
      min-width: 190px;
      background: #0d1f36;
      border-radius: 10px;
      box-shadow: 0 12px 30px rgba(0,0,0,.35);
      opacity: 0;
      visibility: hidden;
      transform: translateX(-50%) translateY(8px);
      transition: opacity .2s ease, transform .2s ease, visibility .2s ease;
      z-index: 20;
    }
    .dropdown-menu li + li{
      margin-top: 2px;
    }
    .dropdown-menu a{
      display: block;
      padding: 10px 20px;
      color: #cfd6e2;
      font-size: 14px;
      font-weight: 400;
      text-transform: none;
      letter-spacing: 0;
      white-space: nowrap;
    }
    .dropdown-menu a::after{
      display: none;
    }
    .dropdown-menu a:hover{
      color: var(--brand-accent);
      background: rgba(255,255,255,.06);
    }
    .has-dropdown:hover .dropdown-menu,
    .has-dropdown.is-open .dropdown-menu{
      opacity: 1;
      visibility: visible;
      transform: translateX(-50%) translateY(0);
    }
    @media (max-width: 991px){
      .site-nav_menu .has-dropdown{
        width: 100%;
      }
      .dropdown-toggle{
        width: 100%;
        padding: 16px 24px;
        justify-content: space-between;
      }
      .dropdown-menu{
        position: static;
        transform: none;
        opacity: 1;
        visibility: visible;
        box-shadow: none;
        background: rgba(255,255,255,.03);
        border-radius: 0;
        padding: 0;
        max-height: 0;
        overflow: hidden;
        transition: max-height .25s ease;
      }
      .has-dropdown.is-open .dropdown-menu{
        max-height: 300px;
        /* Tanpa baris ini, transform: translateX(-50%) translateY(0) dari
           .has-dropdown.is-open .dropdown-menu (versi desktop) menang lewat
           urutan CSS dan mendorong seluruh submenu (isi teksnya) keluar layar
           ke kiri saat dibuka di mobile — itu sebabnya teks dropdown terlihat
           hilang. */
        transform: none;
      }
      .dropdown-menu a{
        padding: 14px 40px;
      }
    }

    /* ===== Language switcher (dropdown, tampilan bendera SVG) ===== */
    .site-nav_utility{
      display: flex;
      align-items: center;
      gap: 14px;
      flex: 0 0 auto;
    }
    .site-nav_lang{
      position: relative;
    }
    .lang-toggle{
      display: flex;
      align-items: center;
      gap: 7px;
      background: rgba(255,255,255,.08);
      border: 1px solid rgba(255,255,255,.16);
      color: #FFF;
      font-family: inherit;
      text-transform: none;
      padding: 6px 10px;
      border-radius: 30px;
      cursor: pointer;
      line-height: 1;
    }
    .lang-toggle:hover{
      background: rgba(255,255,255,.16);
    }
    .lang-toggle i{
      font-size: 9px;
      opacity: .8;
    }
    .lang-flag-icon{
      display: block;
      width: 22px;
      height: 15px;
      border-radius: 3px;
      overflow: hidden;
      box-shadow: 0 0 0 1px rgba(255,255,255,.3);
      flex-shrink: 0;
    }
    .lang-flag-icon svg{
      display: block;
      width: 100%;
      height: 100%;
    }
    #langSwitcher .dropdown-menu.lang-menu{
      left: auto;
      right: 0;
      min-width: 140px;
      padding: 8px;
      transform: translateY(8px);
    }
    #langSwitcher.is-open .dropdown-menu.lang-menu,
    #langSwitcher:hover .dropdown-menu.lang-menu{
      transform: translateY(0);
    }
    .lang-menu li + li{
      margin-top: 4px !important;
    }
    .lang-option{
      display: flex;
      align-items: center;
      gap: 8px;
      width: 100%;
      height: 32px;
      background: none;
      border: 2px solid transparent;
      border-radius: 6px;
      padding: 0 10px 0 6px;
      cursor: pointer;
    }
    .lang-option:hover{
      background: rgba(255,255,255,.06);
    }
    .lang-option.is-active{
      border-color: var(--brand-accent);
      background: rgba(255,255,255,.06);
    }
    .lang-option-label{
      color: #fff;
      font-size: 12px;
      line-height: 1;
      white-space: nowrap;
    }
    @media (max-width: 991px){
      .site-nav_utility{
        gap: 10px;
      }
      .lang-toggle{
        padding: 5px 8px;
      }
      .lang-flag-icon{
        width: 20px;
        height: 14px;
      }
    }

    /* ===== Language switcher dipindah ke dalam dropdown hamburger (mobile
       saja). #navLangSlot adalah slot <li> kosong di akhir #navMenu; JS di
       bawah memindahkan #langSwitcher ke situ saat lebar layar <= 991px, dan
       mengembalikannya ke .site-nav_utility saat tampilan desktop — jadi
       markup & tampilan desktop sama sekali tidak berubah. ===== */
    #navLangSlot:empty{
      display: none;
    }
    @media (max-width: 991px){
      #navLangSlot{
        border-top: 1px solid rgba(255,255,255,.08);
      }
      #navLangSlot .lang-toggle{
        width: 100%;
        background: none;
        border: none;
        border-radius: 0;
        padding: 16px 24px;
        justify-content: space-between;
      }
      #navLangSlot .lang-toggle:hover{
        background: rgba(255,255,255,.06);
      }
      #langSwitcher .dropdown-menu.lang-menu{
        position: static;
        left: auto;
        right: auto;
        transform: none;
        min-width: 0;
        width: 100%;
        padding: 0;
        box-shadow: none;
        background: rgba(255,255,255,.03);
        border-radius: 0;
        max-height: 0;
        overflow: hidden;
        opacity: 1;
        visibility: visible;
        transition: max-height .25s ease;
      }
      #langSwitcher.is-open .dropdown-menu.lang-menu{
        max-height: 200px;
      }
      #navLangSlot .lang-option{
        width: 100%;
        height: auto;
        border-radius: 0;
        padding: 12px 40px;
      }
    }

    /* ===== Blog / Artikel Terbaru (landing page) ===== */
    .blog-section{
      background: #ffffff;
    }
    .blog-section h2{
      color: var(--brand-dark);
    }
    .blog-section hr{
      border-color: rgba(0, 34, 76, 0.15);
    }
    .blog-section .container.center + .container{
      margin-top: 0;
    }
    .blog-section_grid{
      margin-top: 46px;
    }
    .blog-card{
      display: block;
      background: #fff;
      border: 1px solid #edeef4;
      border-radius: 16px;
      overflow: hidden;
      height: 100%;
      transition: transform .3s cubic-bezier(.22,1,.36,1), box-shadow .3s ease;
    }
    .blog-card:hover{
      transform: translateY(-6px);
      box-shadow: 0 20px 36px -18px rgba(0, 34, 76, 0.28);
    }
    .blog-card_thumb{
      aspect-ratio: 16/9;
      background: linear-gradient(135deg, var(--brand-light), var(--brand-dark));
      overflow: hidden;
    }
    .blog-card_thumb img{
      width: 100%;
      height: 100%;
      object-fit: cover;
      display: block;
      transition: transform .4s cubic-bezier(.22,1,.36,1);
    }
    .blog-card:hover .blog-card_thumb img{
      transform: scale(1.08);
    }
    .blog-card_body{
      padding: 22px;
    }
    .blog-card_meta{
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 10px;
    }
    .blog-card_date{
      font-size: 12px;
      font-weight: 700;
      letter-spacing: .05em;
      text-transform: uppercase;
      color: var(--brand-light);
    }
    .blog-card_likes{
      display: inline-flex;
      align-items: center;
      gap: 4px;
      flex-shrink: 0;
      font-size: 12.5px;
      font-weight: 700;
      color: #9aa5b5;
    }
    .blog-card_likes svg{
      color: var(--brand-accent);
    }
    .blog-card_title{
      font-size: 18px;
      line-height: 1.4;
      margin: 10px 0 8px;
      color: #1a2233;
      text-transform: none;
      letter-spacing: normal;
      font-weight: 700;
      transition: color .2s ease;
    }
    .blog-card:hover .blog-card_title{
      color: var(--brand-light);
    }
    .blog-card_excerpt{
      font-size: 14px;
      line-height: 1.6;
      color: #6b7280;
      margin: 0 0 14px;
    }
    .blog-card_readmore{
      display: inline-flex;
      align-items: center;
      gap: 6px;
      font-size: 13px;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: .04em;
      color: var(--brand-accent);
      transition: gap .2s ease;
    }
    .blog-card:hover .blog-card_readmore{
      gap: 10px;
    }
    .btn-sm{
      padding: 11px 22px;
      font-size: 14px;
      letter-spacing: .04em;
    }
    @media (max-width: 767px){
      .blog-section_grid .grid_4 + .grid_4{
        margin-top: 28px;
      }
    }
  </style>
</head>

<body>
<div class="page">
  {{-- ======================== NAVBAR ======================== --}}
  <nav class="site-nav" id="site-nav">
    <div class="container site-nav_inner">
      <a href="#" class="site-nav_brand">
        <img src="{{ $setting->logo ? asset('storage/'.$setting->logo) : asset('images/logo.png') }}" alt="{{ $setting->site_title }}"/>
        <span>{{ $setting->site_title }}</span>
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
        <li><a href="#home" data-i18n="nav.home">Home</a></li>
        <li class="has-dropdown">
          <button type="button" class="dropdown-toggle"><span data-i18n="nav.servicesToggle">Layanan</span> <i class="fa fa-chevron-down" aria-hidden="true"></i></button>
          <ul class="dropdown-menu">
            <li><a href="#services" data-i18n="nav.servicesItem">Layanan</a></li>
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
        {{-- Slot kosong: JS di bawah memindahkan #langSwitcher ke sini saat
             tampilan mobile, supaya ganti bahasa jadi bagian dari dropdown
             hamburger. Kosong = tersembunyi otomatis (di desktop). --}}
        <li class="site-nav_lang-item" id="navLangSlot"></li>
      </ul>

      <div class="site-nav_utility">
        {{-- Language switcher: dropdown, tampilan bendera SVG (bukan emoji, supaya tampil konsisten di semua OS/browser) --}}
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
                <span class="lang-option-label" aria-hidden="true">Indonesia</span>
                <span class="lang-flag-icon" aria-hidden="true">
                  <svg viewBox="0 0 3 2" xmlns="http://www.w3.org/2000/svg"><rect width="3" height="1" fill="#CE1126"/><rect y="1" width="3" height="1" fill="#FFFFFF"/></svg>
                </span>
              </button>
            </li>
            <li role="presentation">
              <button type="button" class="lang-option" data-lang="en" role="option" aria-checked="false" aria-label="English">
                <span class="lang-option-label" aria-hidden="true">English</span>
                <span class="lang-flag-icon" aria-hidden="true">
                  <svg viewBox="0 0 60 30" xmlns="http://www.w3.org/2000/svg">
                    <rect width="60" height="30" fill="#00247d"/>
                    <path d="M0,0 L60,30 M60,0 L0,30" stroke="#fff" stroke-width="6"/>
                    <path d="M0,0 L60,30 M60,0 L0,30" stroke="#cf142b" stroke-width="2"/>
                    <path d="M30,0 V30 M0,15 H60" stroke="#fff" stroke-width="10"/>
                    <path d="M30,0 V30 M0,15 H60" stroke="#cf142b" stroke-width="6"/>
                  </svg>
                </span>
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

  {{-- ======================== HEADER ======================== --}}
  @php
    $heroVideoIsWebm = $setting->hero_video && \Illuminate\Support\Str::endsWith(strtolower($setting->hero_video), '.webm');
  @endphp
  <header class="vide" id="home">
    <video class="hero-bg-video" autoplay muted loop playsinline preload="auto"
           poster="{{ asset('video/video-bg.jpg') }}">
      @if($setting->hero_video)
        <source src="{{ asset('storage/'.$setting->hero_video) }}" type="{{ $heroVideoIsWebm ? 'video/webm' : 'video/mp4' }}">
      @else
        <source src="{{ asset('video/video-bg.mp4') }}" type="video/mp4">
        <source src="{{ asset('video/video-bg.webm') }}" type="video/webm">
        <source src="{{ asset('video/video-bg.ogv') }}" type="video/ogg">
      @endif
    </video>
    <div class="container vide_content" style="display:flex;flex-wrap:wrap;align-items:center;justify-content:space-between;gap:40px;">
      <div class="hero-text hero-fade-in" style="flex:1 1 320px;align-self:center;max-width:560px;">
        <h2 class="hero-fade-in_item" style="margin:0 0 16px 0;">{{ $setting->hero_title }}</h2>
        <h3 class="hero-fade-in_item" style="margin:0 0 20px 0;">{{ $setting->hero_subtitle }}</h3>

        <a href="https://wa.me/{{ $setting->whatsapp_number }}?text={{ urlencode($setting->whatsapp_message) }}"
           target="_blank" rel="noopener" class="btn btn-whatsapp hero-fade-in_item" style="display:inline-flex;align-items:center;gap:8px;font-size:17px;padding:16px 28px;margin-top:0;">
          <svg viewBox="0 0 32 32" width="30" height="30" fill="currentColor" style="vertical-align:middle;flex-shrink:0;">
            <path d="M16.001 3C9.373 3 4 8.373 4 15c0 2.386.7 4.607 1.906 6.475L4 29l7.72-1.867A11.94 11.94 0 0 0 16.001 27C22.628 27 28 21.627 28 15S22.628 3 16.001 3zm0 21.818a9.77 9.77 0 0 1-4.98-1.363l-.357-.212-4.583 1.108 1.127-4.47-.233-.367A9.78 9.78 0 0 1 6.182 15c0-5.415 4.404-9.818 9.819-9.818S25.818 9.585 25.818 15 21.415 24.818 16.001 24.818zm5.396-7.34c-.296-.148-1.75-.864-2.021-.963-.271-.099-.469-.148-.667.148-.198.296-.766.963-.939 1.161-.173.198-.346.222-.642.074-.296-.148-1.249-.46-2.379-1.467-.879-.784-1.472-1.753-1.645-2.049-.173-.296-.018-.456.13-.604.134-.133.296-.346.444-.519.148-.173.198-.297.296-.494.099-.198.05-.371-.025-.519-.074-.148-.667-1.607-.914-2.202-.24-.577-.485-.499-.667-.508l-.568-.01c-.198 0-.519.074-.79.371-.271.297-1.037 1.014-1.037 2.472s1.062 2.868 1.21 3.066c.148.198 2.089 3.19 5.062 4.474.707.305 1.259.487 1.689.623.71.226 1.355.194 1.866.118.569-.085 1.75-.716 1.997-1.407.247-.692.247-1.284.173-1.407-.074-.123-.271-.198-.568-.346z"/>
          </svg>
          <span data-i18n="hero.ctaWhatsapp">Chat via WhatsApp</span>
        </a>
      </div>

      <div class="brand hero-fade-in_item" style="flex:0 1 280px;text-align:right;display:flex;flex-direction:column;align-items:flex-end;align-self:center;animation-delay:.5s;">
        @if($setting->logo && \Illuminate\Support\Str::endsWith($setting->logo, ['.mp4', '.webm']))
          <video src="{{ asset('storage/'.$setting->logo) }}" class="brand_logo-video" style="width:140px;height:140px;max-width:100%;object-fit:contain;margin:0 0 6px 0;" autoplay muted loop playsinline></video>
        @else
          <img src="{{ $setting->logo ? asset('storage/'.$setting->logo) : asset('images/logo.png') }}" alt="{{ $setting->site_title }}" style="width:140px;height:140px;max-width:100%;object-fit:contain;margin:0 0 6px 0;"/>
        @endif
        <h1 class="brand_name" style="margin:0 0 6px 0;">
          <a href="./">{{ $setting->site_title }}</a>
        </h1>
        <p class="brand_slogan" style="margin:0;">{{ $setting->brand_slogan }}</p>
      </div>
    </div>
  </header>

  {{-- ======================== CONTENT ======================== --}}
  <main>
    {{-- CLIENTS / PARTNERS --}}
    @if($partners->count())
    <section class="well2 center">
      <div class="container wow fadeInUp" data-wow-duration="0.9s">
        <h2 data-i18n="clients.title">Clients</h2>
        <hr/>
        <p data-i18n="clients.subtitle">Telah dipercaya oleh berbagai bisnis</p>
      </div>
      <div class="partner-marquee-wrap">
        <div class="partner-marquee partner-marquee--right">
          <ul class="partner-marquee_track">
            @foreach($partners as $i => $partner)
              @if($i % 2 === 0)
                <li><img src="{{ asset('storage/'.$partner->logo) }}" alt="{{ $partner->name }}"/></li>
              @endif
            @endforeach
            @foreach($partners as $i => $partner)
              @if($i % 2 === 0)
                <li><img src="{{ asset('storage/'.$partner->logo) }}" alt="{{ $partner->name }}"/></li>
              @endif
            @endforeach
          </ul>
        </div>
        @if($partners->count() > 1)
        <div class="partner-marquee partner-marquee--left">
          <ul class="partner-marquee_track">
            @foreach($partners as $i => $partner)
              @if($i % 2 === 1)
                <li><img src="{{ asset('storage/'.$partner->logo) }}" alt="{{ $partner->name }}"/></li>
              @endif
            @endforeach
            @foreach($partners as $i => $partner)
              @if($i % 2 === 1)
                <li><img src="{{ asset('storage/'.$partner->logo) }}" alt="{{ $partner->name }}"/></li>
              @endif
            @endforeach
          </ul>
        </div>
        @endif
      </div>
    </section>
    @endif

    {{-- TESTIMONIALS --}}
    @if($testimonials->count())
    <section class="well testimonial-section">
      <div class="container center">
        <div class="wow fadeInUp" data-wow-duration="0.9s">
          <h2 data-i18n="testimonials.title">testimonials</h2>
          <hr/>
          <p data-i18n="testimonials.subtitle">Apa kata mereka yang sudah menggunakan layanan kami</p>
        </div>
        <div class="owl-carousel testimonial-carousel wow fadeInUp" data-wow-delay="0.15s" data-wow-duration="0.9s">
          @foreach($testimonials as $t)
          <div class="item">
            <blockquote class="testimonial-card">
              @if($t->company)
              <h3 class="testimonial-card_company">{{ $t->company }}</h3>
              @endif
              <p class="testimonial-card_quote">{{ $t->message }}</p>
              <img class="testimonial-card_photo" src="{{ $t->photo ? asset('storage/'.$t->photo) : asset('images/page-1_img13.jpg') }}" alt="{{ $t->name }}"/>
              <cite class="testimonial-card_name">{{ $t->name }}</cite>
              @if($t->title)
              <p class="testimonial-card_role">{{ $t->title }}</p>
              @endif
            </blockquote>
          </div>
          @endforeach
        </div>
      </div>
    </section>
    @endif

    {{-- ABOUT / WHO WE ARE — layout disamakan dengan referensi (kreasiai.com):
         split 2 kolom sama lebar, kiri background abu-abu muda berisi teks +
         tombol solid biru, kanan foto full-bleed tanpa rounded corner.
         Tombol mengarah ke halaman "Tentang Asa Production". --}}
    <section class="about-split" id="about">
      <div class="about-split_col about-split_col--photo wow fadeInLeft" data-wow-duration="0.9s">
        <img src="{{ $setting->about_image ? asset('storage/'.$setting->about_image) : asset('images/parallax.jpg') }}" alt="{{ $setting->site_title }}"/>
      </div>
      <div class="about-split_col about-split_col--text wow fadeInRight" data-wow-delay="0.15s" data-wow-duration="0.9s">
        <div class="about-split_inner">
          <span class="about-split_eyebrow">{{ $setting->about_label ?: 'Who We Are' }}</span>
          <h2 class="about-split_title">{!! nl2br(e($setting->about_title)) !!}</h2>
          @if($setting->about_description)
          <p class="about-split_desc">{{ $setting->about_description }}</p>
          @endif
          <a href="{{ route('about') }}" class="btn">
            {{ $setting->about_cta_text ?: 'Pelajari Lebih Lanjut' }}
          </a>
        </div>
      </div>
    </section>


    {{-- SERVICES INTRO / PARALLAX --}}
    <section class="parallax center bg-secondary2" id="services" data-url="{{ $setting->services_bg ? asset('storage/'.$setting->services_bg) : asset('images/parallax.jpg') }}" data-mobile="true" data-speed="0.5">
      <div class="well3">
        <div class="container wow zoomIn" data-wow-duration="0.9s">
          <h2>{{ $setting->services_title }}</h2>
          <hr/>
          <p>{{ $setting->services_description }}</p>
        </div>
      </div>
    </section>

    {{-- SERVICES FEATURES --}}
    @if($services->count())
    <section class="well well__ins1 center">
      <div class="container">
        <div class="row">
          @foreach($services as $service)
          <div class="grid_4 wow fadeInUp" data-wow-delay="{{ 0.1 * ($loop->index % 3) }}s" data-wow-duration="0.8s">
            @if($service->icon && !str_contains($service->icon, '/'))
              <div class="{{ $service->icon }}"></div>
            @elseif($service->icon)
              <img src="{{ asset('storage/'.$service->icon) }}" alt="{{ $service->title }}" loading="lazy" style="max-width:120px;margin:0 auto;"/>
            @endif
            <hr/>
            <h3>{{ $service->title }}</h3>
            <p>{{ $service->description }}</p>
          </div>
          @endforeach
        </div>
      </div>
    </section>
    @endif

    {{-- PORTFOLIO / GALLERY --}}
    @if($portfolios->count())
    <section class="thumb-container" id="gallery">
      @foreach($portfolios as $item)
      <div class="item wow zoomIn" data-wow-delay="{{ 0.08 * ($loop->index % 6) }}s" data-wow-duration="0.7s">
        <a class="portfolio-thumb thumb" style="padding-bottom:73.17073170731707%;" href="{{ asset('storage/'.$item->image) }}">
          <img src="{{ asset('storage/'.$item->thumbnail) }}" alt="{{ $item->title }}" loading="lazy"/>
          <span class="thumb_overlay"></span>
        </a>
      </div>
      @endforeach
    </section>
    @endif

    {{-- ARTIKEL TERBARU (BLOG) --}}
    @if($setting->blog_section_enabled && $latestPosts->count())
    <section class="well blog-section" id="blog">
      <div class="container center wow fadeInUp" data-wow-duration="0.9s">
        <h2 data-i18n="blog.title">Artikel Terbaru</h2>
        <hr/>
        <p data-i18n="blog.subtitle">Tips dan wawasan seputar dunia produksi kreatif</p>
      </div>
      <div class="container">
        <div class="row blog-section_grid">
          @foreach($latestPosts as $post)
          <div class="grid_4 wow fadeInUp" data-wow-delay="{{ 0.1 * $loop->index }}s" data-wow-duration="0.8s">
            <a href="{{ route('blog.show', $post->slug) }}" class="blog-card">
              <div class="blog-card_thumb">
                @if($post->thumbnail)
                  <img src="{{ asset('storage/'.$post->thumbnail) }}" alt="{{ $post->title }}" loading="lazy"/>
                @endif
              </div>
              <div class="blog-card_body">
                <div class="blog-card_meta">
                  <span class="blog-card_date">{{ $post->author ?: 'Admin' }} &bull; {{ optional($post->published_at)->translatedFormat('d M Y, H:i') }}</span>
                  <span class="blog-card_likes" data-likes-for="{{ $post->slug }}">
                    <svg viewBox="0 0 24 24" width="13" height="13" fill="currentColor" aria-hidden="true"><path d="M20.8 4.6a5.5 5.5 0 0 0-7.8 0L12 5.6l-1-1a5.5 5.5 0 0 0-7.8 7.8l1 1L12 21l7.8-7.6 1-1a5.5 5.5 0 0 0 0-7.8Z"/></svg>
                    {{ $post->likes }}
                  </span>
                </div>
                <h3 class="blog-card_title">{{ $post->title }}</h3>
                <p class="blog-card_excerpt">{{ $post->excerpt ?: \Illuminate\Support\Str::limit(strip_tags($post->content), 100) }}</p>
                <span class="blog-card_readmore" data-i18n="blog.readmore">Baca Selengkapnya →</span>
              </div>
            </a>
          </div>
          @endforeach
        </div>
        <div class="center" style="margin-top:44px;">
          <a href="{{ route('blog.index') }}" class="btn btn-sm" data-i18n="blog.cta">Lihat Semua Artikel</a>
        </div>
      </div>
    </section>
    @endif

    {{-- FAQ --}}
    @if($faqs->count())
    <section class="well faq-section" id="faq">
      <div class="container center wow fadeInUp" data-wow-duration="0.9s">
        <h2 data-i18n="faq.title">F.A.Q</h2>
        <hr/>
        <p data-i18n="faq.subtitle">Pertanyaan yang sering diajukan</p>
      </div>
      <div class="container">
        <div class="faq-list">
          @foreach($faqs as $faq)
          <details class="faq-item wow fadeInUp" data-wow-delay="{{ 0.08 * ($loop->index % 6) }}s" data-wow-duration="0.7s">
            <summary>
              <span>{{ $faq->question }}</span>
              <i class="fa fa-angle-right" aria-hidden="true"></i>
            </summary>
            <div class="faq-answer">
              <p>{{ $faq->answer }}</p>
            </div>
          </details>
          @endforeach
        </div>
      </div>
    </section>
    @endif
  </main>

  {{-- ======================== FOOTER ======================== --}}
  <footer id="contact">
    @php($footerBgUrl = $setting->footer_bg ? asset('storage/'.$setting->footer_bg) : asset('images/parallax2.jpg'))
    <div class="parallax" data-url="{{ $footerBgUrl }}" data-mobile="true" data-speed="0.5 " data-direction="inverted" style="background-image:url('{{ $footerBgUrl }}');background-size:cover;background-position:center center;">
      <div class="well4">
        <div class="container center wow fadeInUp" data-wow-delay="0.2s">
          <hr/>
          <h2>{{ $setting->footer_title }}</h2>
          <h3>{{ $setting->footer_subtitle }}</h3>
          <a class="btn" href="{{ $setting->footer_cta_link ?: 'https://wa.me/'.$setting->whatsapp_number }}">{{ $setting->footer_cta_text }}</a>
        </div>
      </div>
    </div>

    {{-- FOOTER COLUMNS --}}
    <div class="footer-columns">
      <div class="container">
        <div class="row wow fadeInUp" data-wow-duration="0.9s">
          <div class="grid_3 footer-col footer-col--brand">
            <a href="./" class="footer-brand">
              <img src="{{ $setting->logo ? asset('storage/'.$setting->logo) : asset('images/logo.png') }}" alt="{{ $setting->site_title }}"/>
              <span>{{ $setting->site_title }}</span>
            </a>
            @if($setting->footer_address)
            <p>{{ $setting->footer_address }}</p>
            @endif
            <p><strong data-i18n="footer.phoneLabel">Phone:</strong> {{ $setting->whatsapp_number }}</p>
            @if($setting->footer_email)
            <p><strong data-i18n="footer.emailLabel">Email:</strong> {{ $setting->footer_email }}</p>
            @endif
          </div>

          <div class="grid_2 footer-col footer-col--nav">
            <h4 data-i18n="footer.navTitle">Navigasi</h4>
            <ul class="footer-links">
              <li><a href="{{ route('blog.index') }}" data-i18n="nav.blog">Blog</a></li>
              <li><a href="{{ route('portfolio.index') }}" data-i18n="nav.portfolio">Portofolio</a></li>
              <li><a href="{{ route('about') }}" data-i18n="nav.about">Tentang Kami</a></li>
              <li><a href="{{ route('contact') }}" data-i18n="nav.contact">Kontak</a></li>
            </ul>
          </div>

          @if($services->count())
          <div class="grid_2 footer-col footer-col--services">
            <h4 data-i18n="footer.servicesTitle">Layanan</h4>
            <ul class="footer-links">
              @foreach($services->take(6) as $service)
              <li><a href="#services">{{ $service->title }}</a></li>
              @endforeach
            </ul>
          </div>
          @endif

          <div class="grid_2 footer-col footer-col--company">
            <h4 data-i18n="footer.companyTitle">Perusahaan</h4>
            <ul class="footer-links">
              <li><a href="#about" data-i18n="footer.aboutUs">Tentang Kami</a></li>
              <li><a href="#services" data-i18n="footer.ourServices">Layanan Kami</a></li>
              <li><a href="{{ route('contact') }}" data-i18n="footer.contactUs">Hubungi Kami</a></li>
            </ul>
          </div>

          <div class="grid_3 footer-col">
            @if($certificates->count())
            <h4 data-i18n="footer.certTitle">Sertifikat</h4>
            <div class="footer-badges">
              @foreach($certificates as $cert)
              <img src="{{ asset('storage/'.$cert->image) }}" alt="{{ $cert->name ?? 'Sertifikat' }}" loading="lazy"/>
              @endforeach
            </div>
            @endif
            <h4 style="margin-top:24px;" data-i18n="footer.findUsTitle">Temukan Kami</h4>
            <div class="footer-social">
              @if($setting->social_instagram)<a href="{{ $setting->social_instagram }}" target="_blank" rel="noopener" aria-label="Instagram"><i class="fa fa-instagram" aria-hidden="true"></i></a>@endif
              @if($setting->social_facebook)<a href="{{ $setting->social_facebook }}" target="_blank" rel="noopener" aria-label="Facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a>@endif
              @if($setting->social_tiktok)<a href="{{ $setting->social_tiktok }}" target="_blank" rel="noopener" aria-label="TikTok"><svg viewBox="0 0 24 24" width="15" height="15" fill="currentColor" style="vertical-align:middle;"><path d="M16.6 5.82s.51.5 0 0A4.278 4.278 0 0 1 15.54 3h-3.09v12.4a2.592 2.592 0 0 1-2.59 2.5c-1.42 0-2.6-1.16-2.6-2.6c0-1.72 1.66-3.01 3.37-2.48V9.66c-3.45-.46-6.47 2.22-6.47 5.64c0 3.33 2.76 5.7 5.69 5.7c3.14 0 5.69-2.55 5.69-5.7V9.01a7.35 7.35 0 0 0 4.3 1.38V7.3s-1.88.09-3.24-1.48z"/></svg></a>@endif
              @if($setting->social_linkedin)<a href="{{ $setting->social_linkedin }}" target="_blank" rel="noopener" aria-label="LinkedIn"><i class="fa fa-linkedin" aria-hidden="true"></i></a>@endif
              @if($setting->social_youtube)<a href="{{ $setting->social_youtube }}" target="_blank" rel="noopener" aria-label="YouTube"><i class="fa fa-youtube-play" aria-hidden="true"></i></a>@endif
              @if($setting->social_x)<a href="{{ $setting->social_x }}" target="_blank" rel="noopener" aria-label="X"><i class="fa fa-twitter" aria-hidden="true"></i></a>@endif
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="well5 center">
      <div class="container">
        <div class="copyright">
          © <span id="copyright-year"></span> {{ $setting->site_title }}. <span data-i18n="footer.rights">All Rights Reserved</span>
        </div>
      </div>
    </div>
  </footer>
</div>

@include('partials.chatbot-widget')

<script src="{{ asset('js/script.js') }}"></script>
{{-- script.js otomatis meng-include jquery.fancybox, owl-carousel, wow.js,
     jquery.vide.js, dan library lain lewat document.write(), sesuai
     struktur asli template. Jangan load ulang manual di sini. --}}
<script>
  (function () {
    // ===== Language switcher (ID / EN) =====
    // Dictionary + apply/persist logic now live in the shared
    // library (js/i18n-lib.js + js/i18n-data.js, loaded in <head>)
    // so home, about, contact and blog pages all share one
    // implementation instead of each keeping its own copy.
    if (window.I18n && window.SITE_I18N) {
      window.I18n.init(window.SITE_I18N);
      window.I18n.bindLangSwitcher();
    }

    window.__siteLang = function () { return window.I18n ? window.I18n.getLang() : 'id'; };
    window.__t = function (key) { return window.I18n ? window.I18n.t(key) : key; };

    var nav = document.getElementById('site-nav');
    var toggle = document.getElementById('navToggle');
    var menu = document.getElementById('navMenu');

    if (toggle && menu) {
      toggle.addEventListener('click', function () {
        menu.classList.toggle('is-open');
        toggle.classList.toggle('is-open');
      });
      menu.querySelectorAll('a').forEach(function (link) {
        link.addEventListener('click', function () {
          menu.classList.remove('is-open');
          toggle.classList.remove('is-open');
        });
      });
    }

    document.querySelectorAll('.dropdown-toggle').forEach(function (btn) {
      btn.addEventListener('click', function (e) {
        e.preventDefault();
        var parent = btn.closest('.has-dropdown');
        var wasOpen = parent.classList.contains('is-open');
        document.querySelectorAll('.has-dropdown.is-open').forEach(function (li) {
          li.classList.remove('is-open');
        });
        if (!wasOpen) { parent.classList.add('is-open'); }
      });
    });
    document.addEventListener('click', function (e) {
      if (!e.target.closest('.has-dropdown')) {
        document.querySelectorAll('.has-dropdown.is-open').forEach(function (li) {
          li.classList.remove('is-open');
        });
      }
    });

    // ===== Pindahkan tombol ganti bahasa ke dalam dropdown hamburger =====
    // Di layar mobile (<=991px) #langSwitcher dipindah jadi item terakhir
    // #navMenu (lewat slot kosong #navLangSlot) supaya jadi bagian dari
    // dropdown hamburger. Di layar desktop, elemen yang sama dikembalikan
    // ke posisi semula di .site-nav_utility — jadi tampilan desktop tidak
    // berubah sama sekali.
    (function () {
      var MOBILE_QUERY = '(max-width: 991px)';

      function placeLangSwitcher() {
        var lang = document.getElementById('langSwitcher');
        var slot = document.getElementById('navLangSlot');
        var utility = document.querySelector('.site-nav_utility');
        if (!lang || !slot || !utility) { return; }

        var isMobile = window.matchMedia(MOBILE_QUERY).matches;
        if (isMobile) {
          if (lang.parentElement !== slot) { slot.appendChild(lang); }
        } else if (lang.parentElement !== utility) {
          var toggleBtn = document.getElementById('navToggle');
          utility.insertBefore(lang, toggleBtn || null);
        }
      }

      placeLangSwitcher();

      var mq = window.matchMedia(MOBILE_QUERY);
      if (mq.addEventListener) {
        mq.addEventListener('change', placeLangSwitcher);
      } else if (mq.addListener) { // Safari lama
        mq.addListener(placeLangSwitcher);
      }
      window.addEventListener('resize', placeLangSwitcher);
    })();

    if (nav) {
      var hero = document.getElementById('home');

      function updateNavBackground() {
        var threshold = hero ? (hero.offsetTop + hero.offsetHeight - nav.offsetHeight) : 20;
        if (window.scrollY >= threshold) {
          nav.classList.add('is-scrolled');
        } else {
          nav.classList.remove('is-scrolled');
        }
      }

      window.addEventListener('scroll', updateNavBackground);
      window.addEventListener('resize', updateNavBackground);
      updateNavBackground();
    }

    var year = document.getElementById('copyright-year');
    if (year) { year.textContent = new Date().getFullYear(); }

    // Fallback: some browsers/embedded previews ignore the autoplay
    // attribute (or block it entirely inside an iframe without an
    // "allow=autoplay" permission), so we nudge playback multiple ways.
    var heroVideo = document.querySelector('.hero-bg-video');
    if (heroVideo) {
      heroVideo.muted = true; // some browsers only honor the JS property, not the attribute
      heroVideo.playsInline = true;

      var tryPlay = function () {
        var p = heroVideo.play();
        if (p && typeof p.catch === 'function') { p.catch(function () {}); }
      };

      ['loadedmetadata', 'loadeddata', 'canplay'].forEach(function (evt) {
        heroVideo.addEventListener(evt, tryPlay);
      });
      tryPlay();

      // Last-resort fallback: if autoplay was blocked by the browser,
      // the very first tap/scroll/click anywhere on the page resumes it.
      var resumeOnInteraction = function () {
        if (heroVideo.paused) { tryPlay(); }
        ['click', 'touchstart', 'scroll', 'keydown'].forEach(function (evt) {
          document.removeEventListener(evt, resumeOnInteraction);
        });
      };
      ['click', 'touchstart', 'scroll', 'keydown'].forEach(function (evt) {
        document.addEventListener(evt, resumeOnInteraction, { once: true, passive: true });
      });
    }
  })();
</script>
</body>
</html>
