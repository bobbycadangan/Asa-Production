{{-- ======================== CHATBOT WIDGET ======================== --}}
{{-- Partial ini dipakai bersama oleh semua halaman publik (home, blog,
     portfolio, solusi, about, contact, dll) agar tombol chat mengambang
     tampil identik & sinkron di mana pun. Tampilan dirombak jadi gaya
     glass/gradient modern, konsisten dengan warna brand (--brand-*) yang
     sama dipakai navbar. Butuh meta csrf-token di <head> halaman pemakai. --}}
<div id="chatbot" class="chatbot">
  <button type="button" id="chatbotToggle" class="chatbot_toggle" data-i18n-aria-label="chatbot.openLabel" aria-label="Buka chat">
    <span class="chatbot_toggle-ping" aria-hidden="true"></span>
    <svg class="chatbot_toggle-icon-open" viewBox="0 0 24 24" width="26" height="26" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
      <path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/>
    </svg>
    <svg class="chatbot_toggle-icon-close" viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
      <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
    </svg>
  </button>

  <div class="chatbot_window" id="chatbotWindow" role="dialog" aria-label="Live chat">
    <div class="chatbot_header">
      <div class="chatbot_header-info">
        <span class="chatbot_header-avatar">
          <img src="{{ $setting->logo ? asset('storage/'.$setting->logo) : asset('images/logo.png') }}" alt="{{ $setting->site_title }}"/>
          <span class="chatbot_header-status" aria-hidden="true"></span>
        </span>
        <div class="chatbot_header-text">
          <strong>{{ $setting->site_title }}</strong>
          <span class="chatbot_header-sub">
            <i class="chatbot_header-dot" aria-hidden="true"></i>
            <span data-i18n="chatbot.subtitle">Biasanya balas dalam beberapa detik</span>
          </span>
        </div>
      </div>
      <button type="button" id="chatbotClose" class="chatbot_header-close" data-i18n-aria-label="chatbot.closeLabel" aria-label="Tutup chat">
        <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
        </svg>
      </button>
    </div>

    <div class="chatbot_messages" id="chatbotMessages">
      <div class="chatbot_msg chatbot_msg-bot" id="chatbotGreeting" data-i18n="chatbot.greeting" data-i18n-var-site="{{ $setting->site_title }}">
        Halo! 👋 Ada yang bisa dibantu seputar layanan {{ $setting->site_title }}?
      </div>
    </div>

    <form id="chatbotForm" class="chatbot_input">
      <input type="text" id="chatbotInput" data-i18n-placeholder="chatbot.placeholder" placeholder="Tulis pertanyaan..." maxlength="500" autocomplete="off" required/>
      <button type="submit" class="chatbot_send" data-i18n-aria-label="chatbot.sendLabel" aria-label="Kirim">
        <svg viewBox="0 0 24 24" width="18" height="18" fill="currentColor"><path d="M2 21l21-9L2 3v7l15 2-15 2z"/></svg>
      </button>
    </form>
  </div>
</div>

<script>
  (function () {
    var chatbot = document.getElementById('chatbot');
    var chatToggle = document.getElementById('chatbotToggle');
    var chatClose = document.getElementById('chatbotClose');
    var chatWindow = document.getElementById('chatbotWindow');
    var chatMessages = document.getElementById('chatbotMessages');
    var chatForm = document.getElementById('chatbotForm');
    var chatInput = document.getElementById('chatbotInput');

    if (!(chatbot && chatToggle && chatWindow && chatForm && chatInput)) { return; }

    var history = [];
    var sending = false;

    function openChat() {
      chatbot.classList.add('is-open');
      chatInput.focus();
    }

    function closeChat() {
      chatbot.classList.remove('is-open');
    }

    chatToggle.addEventListener('click', function () {
      if (chatbot.classList.contains('is-open')) {
        closeChat();
      } else {
        openChat();
      }
    });

    if (chatClose) {
      chatClose.addEventListener('click', closeChat);
    }

    function appendMessage(text, role) {
      var el = document.createElement('div');
      el.className = 'chatbot_msg chatbot_msg-' + (role === 'user' ? 'user' : 'bot');
      el.textContent = text;
      chatMessages.appendChild(el);
      chatMessages.scrollTop = chatMessages.scrollHeight;
      return el;
    }

    function showTyping() {
      var el = document.createElement('div');
      el.className = 'chatbot_msg chatbot_msg-bot chatbot_msg-typing';
      el.id = 'chatbotTyping';
      el.innerHTML = '<span></span><span></span><span></span>';
      chatMessages.appendChild(el);
      chatMessages.scrollTop = chatMessages.scrollHeight;
    }

    function hideTyping() {
      var el = document.getElementById('chatbotTyping');
      if (el) { el.remove(); }
    }

    function pushHistory(message, reply) {
      history.push({ role: 'user', content: message });
      history.push({ role: 'assistant', content: reply });
      if (history.length > 12) {
        history = history.slice(history.length - 12);
      }
    }

    // Fallback non-streaming (dipakai kalau browser/proxy tidak mendukung
    // ReadableStream body pada fetch).
    function sendNonStreaming(message, token) {
      fetch('{{ route('chat.send') }}', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
          'X-CSRF-TOKEN': token
        },
        body: JSON.stringify({ message: message, history: history, lang: (window.__siteLang ? window.__siteLang() : 'id') })
      })
        .then(function (res) { return res.json(); })
        .then(function (data) {
          hideTyping();
          var reply = (data && data.reply) ? data.reply : (window.__t ? window.__t('chatbot.errorGeneral') : 'Maaf, terjadi kendala. Silakan coba lagi.');
          appendMessage(reply, 'bot');
          pushHistory(message, reply);
        })
        .catch(function () {
          hideTyping();
          appendMessage(window.__t ? window.__t('chatbot.errorConnection') : 'Maaf, tidak dapat terhubung ke server. Silakan coba lagi.', 'bot');
        })
        .finally(function () {
          sending = false;
        });
    }

    function sendStreaming(message, token) {
      fetch('{{ route('chat.stream') }}', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'text/event-stream',
          'X-CSRF-TOKEN': token
        },
        body: JSON.stringify({ message: message, history: history, lang: (window.__siteLang ? window.__siteLang() : 'id') })
      }).then(function (res) {
        if (!res.ok || !res.body || !res.body.getReader) {
          return sendNonStreaming(message, token);
        }

        var reader = res.body.getReader();
        var decoder = new TextDecoder();
        var buffer = '';
        var botEl = null;
        var fullReply = '';
        var typingRemoved = false;

        function ensureBotEl() {
          if (!typingRemoved) {
            hideTyping();
            typingRemoved = true;
          }
          if (!botEl) {
            botEl = appendMessage('', 'bot');
          }
          return botEl;
        }

        function handleEvent(eventName, dataStr) {
          var data;
          try { data = JSON.parse(dataStr); } catch (e) { return; }

          if (eventName === 'chunk' && data.delta) {
            fullReply += data.delta;
            ensureBotEl().textContent = fullReply;
            chatMessages.scrollTop = chatMessages.scrollHeight;
          } else if (eventName === 'done') {
            if (data.reply) {
              // Fallback message (error/inactive) dikirim utuh di event "done".
              ensureBotEl().textContent = data.reply;
              fullReply = data.reply;
            } else if (!fullReply) {
              ensureBotEl().textContent = window.__t ? window.__t('chatbot.errorGeneral') : 'Maaf, terjadi kendala. Silakan coba lagi.';
              fullReply = botEl.textContent;
            }
            pushHistory(message, fullReply);
            sending = false;
          }
        }

        function pump() {
          return reader.read().then(function (result) {
            if (result.done) { return; }

            buffer += decoder.decode(result.value, { stream: true });
            var chunks = buffer.split('\n\n');
            buffer = chunks.pop();

            chunks.forEach(function (chunk) {
              var eventName = 'message';
              var dataStr = '';
              chunk.split('\n').forEach(function (line) {
                if (line.indexOf('event:') === 0) {
                  eventName = line.slice(6).trim();
                } else if (line.indexOf('data:') === 0) {
                  dataStr = line.slice(5).trim();
                }
              });
              if (dataStr) { handleEvent(eventName, dataStr); }
            });

            return pump();
          });
        }

        return pump();
      }).catch(function () {
        hideTyping();
        if (!sending) { return; }
        appendMessage(window.__t ? window.__t('chatbot.errorConnection') : 'Maaf, tidak dapat terhubung ke server. Silakan coba lagi.', 'bot');
        sending = false;
      }).finally(function () {
        sending = false;
      });
    }

    chatForm.addEventListener('submit', function (e) {
      e.preventDefault();
      if (sending) { return; }

      var message = chatInput.value.trim();
      if (!message) { return; }

      appendMessage(message, 'user');
      chatInput.value = '';
      sending = true;
      showTyping();

      var tokenMeta = document.querySelector('meta[name="csrf-token"]');
      var token = tokenMeta ? tokenMeta.getAttribute('content') : '';

      if (window.ReadableStream) {
        sendStreaming(message, token);
      } else {
        sendNonStreaming(message, token);
      }
    });
  })();
</script>
