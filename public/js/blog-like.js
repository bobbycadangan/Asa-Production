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
  var likeBtn = document.getElementById('likeBtn');
  if (likeBtn) {
    var likeUrl = likeBtn.getAttribute('data-url');
    var storageKey = 'liked_post:' + likeUrl;
    var countEl = document.getElementById('likeCount');

    function markLiked() {
      likeBtn.classList.add('is-liked');
      likeBtn.disabled = true;
    }

    try {
      if (window.localStorage.getItem(storageKey)) {
        markLiked();
      }
    } catch (e) { /* localStorage unavailable */ }

    likeBtn.addEventListener('click', function () {
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
          markLiked();
          try { window.localStorage.setItem(storageKey, '1'); } catch (e) { /* ignore */ }
        })
        .catch(function () {
          likeBtn.disabled = false;
        });
    });
  }
})();
