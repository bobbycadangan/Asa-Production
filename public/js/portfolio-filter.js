/*========================================================
  Portfolio page — filter tab by category + simple lightbox.
  Vanilla JS, no jQuery dependency (konsisten dengan halaman
  about/contact/blog yang ringan tanpa bundel script.js).
========================================================*/
(function () {
  var filterWrap = document.getElementById('portfolioFilter');
  var grid = document.getElementById('portfolioGrid');
  var emptyFiltered = document.getElementById('portfolioEmptyFiltered');

  if (filterWrap && grid) {
    var tabs = filterWrap.querySelectorAll('.portfolio-filter_tab');
    var cards = grid.querySelectorAll('.portfolio-card');

    tabs.forEach(function (tab) {
      tab.addEventListener('click', function () {
        var category = tab.getAttribute('data-category');

        tabs.forEach(function (t) {
          t.classList.remove('is-active');
          t.setAttribute('aria-selected', 'false');
        });
        tab.classList.add('is-active');
        tab.setAttribute('aria-selected', 'true');

        var visibleCount = 0;
        cards.forEach(function (card) {
          var match = category === 'all' || card.getAttribute('data-category') === category;
          card.hidden = !match;
          if (match) { visibleCount++; }
        });

        if (emptyFiltered) {
          emptyFiltered.hidden = visibleCount !== 0;
        }
      });
    });
  }

  // ===== Lightbox =====
  var lightbox = document.getElementById('portfolioLightbox');
  var lightboxImg = document.getElementById('portfolioLightboxImg');
  var lightboxCaption = document.getElementById('portfolioLightboxCaption');
  var lightboxClose = document.getElementById('portfolioLightboxClose');

  if (lightbox && lightboxImg && lightboxClose) {
    document.querySelectorAll('.portfolio-card_thumb').forEach(function (btn) {
      btn.addEventListener('click', function () {
        var full = btn.getAttribute('data-full');
        var title = btn.getAttribute('data-title') || '';
        lightboxImg.setAttribute('src', full);
        lightboxImg.setAttribute('alt', title);
        if (lightboxCaption) { lightboxCaption.textContent = title; }
        lightbox.classList.add('is-open');
        document.body.style.overflow = 'hidden';
      });
    });

    function closeLightbox() {
      lightbox.classList.remove('is-open');
      document.body.style.overflow = '';
    }

    lightboxClose.addEventListener('click', closeLightbox);
    lightbox.addEventListener('click', function (e) {
      if (e.target === lightbox) { closeLightbox(); }
    });
    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape') { closeLightbox(); }
    });
  }
})();
