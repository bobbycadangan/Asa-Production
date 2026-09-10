/*========================================================
  Site nav — perilaku navbar bersama (dropdown, toggle menu
  mobile, language switcher). Dipakai di semua halaman yang
  meng-include partials.site-nav (about, contact, blog).

  Terjemahan sekarang ditangani oleh library bersama
  (i18n-lib.js + i18n-data.js, di-load sebelum file ini) agar
  satu dictionary dipakai di semua halaman — bukan cuma label
  navbar. Pastikan kedua file itu sudah ter-load lebih dulu.
========================================================*/
(function () {
  // ===== Language switcher (ID / EN) =====
  if (window.I18n && window.SITE_I18N) {
    window.I18n.init(window.SITE_I18N);
    window.I18n.bindLangSwitcher();
  }

  // ===== Mobile menu toggle =====
  var toggle = document.getElementById('navToggle');
  var menu = document.getElementById('navMenu');

  if (toggle && menu) {
    toggle.addEventListener('click', function () {
      menu.classList.toggle('is-open');
    });
    menu.querySelectorAll('a').forEach(function (link) {
      link.addEventListener('click', function () {
        menu.classList.remove('is-open');
      });
    });
  }

  // ===== Dropdown menus (Layanan, Info, language switcher) =====
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
  // dropdown hamburger. Di layar desktop, elemen yang sama dikembalikan ke
  // posisi semula di .site-nav_utility — jadi tampilan desktop tidak
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

  var year = document.getElementById('copyright-year');
  if (year) {
    year.textContent = new Date().getFullYear();
  }
})();
