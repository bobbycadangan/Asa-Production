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
      var open = menu.classList.toggle('is-open');
      toggle.classList.toggle('is-open', open);
      toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
    });
    menu.querySelectorAll('a').forEach(function (link) {
      link.addEventListener('click', function () {
        menu.classList.remove('is-open');
        toggle.classList.remove('is-open');
        toggle.setAttribute('aria-expanded', 'false');
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

  var year = document.getElementById('copyright-year');
  if (year) {
    year.textContent = new Date().getFullYear();
  }
})();
