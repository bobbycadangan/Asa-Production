/*========================================================
  Portfolio page — filter tab by category.
  Vanilla JS, no jQuery dependency (konsisten dengan halaman
  about/contact/blog yang ringan tanpa bundel script.js).

  Logika lightbox overview gambar dipindah ke js/portfolio-lightbox.js
  agar bisa dipakai bersama dengan galeri portofolio di halaman utama.
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
})();
