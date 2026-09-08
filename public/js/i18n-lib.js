/*========================================================
  I18n — shared translation library used across every public
  page (home, about, contact, blog index/show). Centralizes
  the language-switch logic (dictionary lookup, {var}
  interpolation, DOM binding via data-i18n* attributes, and
  persistence) in one place so pages no longer keep their own
  copy of the same code. Site-specific dictionaries live in
  i18n-data.js — load that file before this one is used.

  Usage on any page:
    I18n.init(window.SITE_I18N);   // reads saved language, applies it
    I18n.bindLangSwitcher();       // wires the flag/dropdown UI

  Markup contract:
    data-i18n="key"                 -> element textContent
    data-i18n-placeholder="key"     -> element placeholder attr
    data-i18n-aria-label="key"      -> element aria-label attr
    data-i18n-var-<name>="value"    -> fills {<name>} inside the
                                        translated string, e.g.
                                        data-i18n-var-site="Acme"
                                        with a dictionary entry of
                                        "Hi {site}!"
========================================================*/
(function (global) {
  var LANG_STORAGE_KEY = 'site_lang';
  var SUPPORTED = ['id', 'en'];
  var DEFAULT_LANG = 'id';

  var FLAG_SVG = {
    id: '<svg viewBox="0 0 3 2" xmlns="http://www.w3.org/2000/svg"><rect width="3" height="1" fill="#CE1126"/><rect y="1" width="3" height="1" fill="#FFFFFF"/></svg>',
    en: '<svg viewBox="0 0 60 30" xmlns="http://www.w3.org/2000/svg"><rect width="60" height="30" fill="#00247d"/><path d="M0,0 L60,30 M60,0 L0,30" stroke="#fff" stroke-width="6"/><path d="M0,0 L60,30 M60,0 L0,30" stroke="#cf142b" stroke-width="2"/><path d="M30,0 V30 M0,15 H60" stroke="#fff" stroke-width="10"/><path d="M30,0 V30 M0,15 H60" stroke="#cf142b" stroke-width="6"/></svg>'
  };

  var resources = {};
  var currentLang = DEFAULT_LANG;

  function detectInitialLang() {
    try {
      var saved = global.localStorage.getItem(LANG_STORAGE_KEY);
      if (SUPPORTED.indexOf(saved) !== -1) { return saved; }
    } catch (e) { /* localStorage unavailable, fall back to default */ }
    return DEFAULT_LANG;
  }

  function init(dictionary, opts) {
    resources = dictionary || {};
    currentLang = detectInitialLang();
    if (!opts || opts.autoApply !== false) { apply(); }
    return currentLang;
  }

  function t(key, vars) {
    var dict = resources[currentLang] || resources[DEFAULT_LANG] || {};
    var fallback = resources[DEFAULT_LANG] || {};
    var str = dict[key] !== undefined ? dict[key] : (fallback[key] !== undefined ? fallback[key] : key);
    if (vars) {
      Object.keys(vars).forEach(function (name) {
        str = str.split('{' + name + '}').join(vars[name]);
      });
    }
    return str;
  }

  function varsFor(el) {
    var vars = {};
    Array.prototype.forEach.call(el.attributes, function (attr) {
      if (attr.name.indexOf('data-i18n-var-') === 0) {
        vars[attr.name.slice('data-i18n-var-'.length)] = attr.value;
      }
    });
    return vars;
  }

  function apply(root) {
    var scope = root || document;
    scope.querySelectorAll('[data-i18n]').forEach(function (el) {
      el.textContent = t(el.getAttribute('data-i18n'), varsFor(el));
    });
    scope.querySelectorAll('[data-i18n-placeholder]').forEach(function (el) {
      el.setAttribute('placeholder', t(el.getAttribute('data-i18n-placeholder'), varsFor(el)));
    });
    scope.querySelectorAll('[data-i18n-aria-label]').forEach(function (el) {
      el.setAttribute('aria-label', t(el.getAttribute('data-i18n-aria-label'), varsFor(el)));
    });
    if (!root) { document.documentElement.setAttribute('lang', currentLang); }
  }

  function refreshSwitcherUI() {
    var flagEl = document.getElementById('langCurrentFlag');
    if (flagEl) { flagEl.innerHTML = FLAG_SVG[currentLang] || FLAG_SVG[DEFAULT_LANG]; }

    document.querySelectorAll('.lang-option').forEach(function (btn) {
      var isActive = btn.getAttribute('data-lang') === currentLang;
      btn.classList.toggle('is-active', isActive);
      btn.setAttribute('aria-checked', isActive ? 'true' : 'false');
    });

    var toggleBtn = document.getElementById('langToggle');
    if (toggleBtn) { toggleBtn.setAttribute('aria-expanded', 'false'); }
  }

  function setLang(lang) {
    currentLang = (SUPPORTED.indexOf(lang) !== -1) ? lang : DEFAULT_LANG;
    apply();
    refreshSwitcherUI();
    try { global.localStorage.setItem(LANG_STORAGE_KEY, currentLang); } catch (e) { /* ignore */ }
    try {
      document.dispatchEvent(new CustomEvent('i18n:change', { detail: { lang: currentLang } }));
    } catch (e) { /* older browsers without CustomEvent support */ }
    return currentLang;
  }

  function bindLangSwitcher() {
    refreshSwitcherUI();
    document.querySelectorAll('.lang-option').forEach(function (btn) {
      btn.addEventListener('click', function () {
        setLang(btn.getAttribute('data-lang'));
        var wrap = btn.closest('.has-dropdown');
        if (wrap) { wrap.classList.remove('is-open'); }
      });
    });
  }

  function getLang() { return currentLang; }

  global.I18n = {
    init: init,
    t: t,
    apply: apply,
    setLang: setLang,
    getLang: getLang,
    bindLangSwitcher: bindLangSwitcher
  };
})(window);
