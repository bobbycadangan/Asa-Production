{{-- ======================== CHATBOT WIDGET ======================== --}}
{{-- Partial ini dipakai bersama oleh home, blog (index & show), dan kontak,
     agar tombol chat mengambang konsisten di semua halaman.
     Butuh meta csrf-token di <head> halaman yang memakainya. --}}
<div id="chatbot" class="chatbot">
  <button type="button" id="chatbotToggle" class="chatbot_toggle" data-i18n-aria-label="chatbot.openLabel" aria-label="Buka chat">
    <svg class="chatbot_toggle-icon-open" viewBox="0 0 24 24" width="26" height="26" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
      <path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/>
    </svg>
    <svg class="chatbot_toggle-icon-close" viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
      <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
    </svg>
  </button>

  <div class="chatbot_window" id="chatbotWindow">
    <div class="chatbot_header">
      <img src="{{ $setting->logo ? asset('storage/'.$setting->logo) : asset('images/logo.png') }}" alt="{{ $setting->site_title }}" class="chatbot_header-logo"/>
      <div>
        <strong>{{ $setting->site_title }}</strong>
        <span data-i18n="chatbot.subtitle">Biasanya balas dalam beberapa detik</span>
      </div>
    </div>

    <div class="chatbot_messages" id="chatbotMessages">
      <div class="chatbot_msg chatbot_msg-bot" id="chatbotGreeting" data-i18n="chatbot.greeting" data-i18n-var-site="{{ $setting->site_title }}">
        Halo! 👋 Ada yang bisa dibantu seputar layanan {{ $setting->site_title }}?
      </div>
    </div>

    <form id="chatbotForm" class="chatbot_input">
      <input type="text" id="chatbotInput" data-i18n-placeholder="chatbot.placeholder" placeholder="Tulis pertanyaan..." maxlength="500" autocomplete="off" required/>
      <button type="submit" data-i18n-aria-label="chatbot.sendLabel" aria-label="Kirim">
        <svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor"><path d="M2 21l21-9L2 3v7l15 2-15 2z"/></svg>
      </button>
    </form>
  </div>
</div>

<script>
  (function () {
    var chatbot = document.getElementById('chatbot');
    var chatToggle = document.getElementById('chatbotToggle');
    var chatWindow = document.getElementById('chatbotWindow');
    var chatMessages = document.getElementById('chatbotMessages');
    var chatForm = document.getElementById('chatbotForm');
    var chatInput = document.getElementById('chatbotInput');

    if (!(chatbot && chatToggle && chatWindow && chatForm && chatInput)) { return; }

    var history = [];
    var sending = false;

    chatToggle.addEventListener('click', function () {
      chatbot.classList.toggle('is-open');
      if (chatbot.classList.contains('is-open')) {
        chatInput.focus();
      }
    });

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

          history.push({ role: 'user', content: message });
          history.push({ role: 'assistant', content: reply });
          if (history.length > 12) {
            history = history.slice(history.length - 12);
          }
        })
        .catch(function () {
          hideTyping();
          appendMessage(window.__t ? window.__t('chatbot.errorConnection') : 'Maaf, tidak dapat terhubung ke server. Silakan coba lagi.', 'bot');
        })
        .finally(function () {
          sending = false;
        });
    });
  })();
</script>
