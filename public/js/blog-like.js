(function () {
  // ===== Copy link button =====
  var copyBtn = document.getElementById('copyLinkBtn');
  if (copyBtn) {
    copyBtn.addEventListener('click', function () {
      var url = copyBtn.getAttribute('data-url');

      function markCopied() {
        copyBtn.classList.add('is-copied');
        setTimeout(function () {
          copyBtn.classList.remove('is-copied');
        }, 1800);
      }

      if (navigator.clipboard && navigator.clipboard.writeText) {
        navigator.clipboard.writeText(url).then(markCopied).catch(function () {
          fallbackCopy(url, markCopied);
        });
      } else {
        fallbackCopy(url, markCopied);
      }
    });
  }

  function fallbackCopy(text, done) {
    var input = document.createElement('textarea');
    input.value = text;
    input.style.position = 'fixed';
    input.style.opacity = '0';
    document.body.appendChild(input);
    input.select();
    try { document.execCommand('copy'); } catch (e) { /* ignore */ }
    document.body.removeChild(input);
    if (done) { done(); }
  }

  // ===== Like button =====
  // Catatan: batasan "1 like per browser" (localStorage + disable permanen)
  // sengaja dihapus atas permintaan user — sekarang tombol boleh diklik
  // berkali-kali, tiap klik akan menambah hitungan like ke server.
  var likeBtn = document.getElementById('likeBtn');
  if (likeBtn) {
    var likeUrl = likeBtn.getAttribute('data-url');
    var countEl = document.getElementById('likeCount');

    likeBtn.addEventListener('click', function () {
      // Kunci sementara cuma supaya 1 klik tidak terkirim dobel selagi
      // request sebelumnya belum selesai (bukan supaya cuma bisa 1x like).
      if (likeBtn.disabled) { return; }
      likeBtn.disabled = true;

      var tokenEl = document.querySelector('meta[name="csrf-token"]');

      fetch(likeUrl, {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': tokenEl ? tokenEl.getAttribute('content') : '',
          'Accept': 'application/json'
        }
      })
        .then(function (res) { return res.json(); })
        .then(function (data) {
          if (countEl && typeof data.likes !== 'undefined') {
            countEl.textContent = data.likes;
          }
          likeBtn.classList.add('is-liked');
        })
        .catch(function () { /* ignore, biar bisa dicoba lagi */ })
        .finally(function () {
          likeBtn.disabled = false;
        });
    });
  }
})();
