<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login Admin - {{ $setting->site_title ?? 'Asa Production' }}</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300;400;500;700&display=swap" rel="stylesheet">
  <style>
    /* Token warna disamakan dengan public/css/style.css milik halaman utama */
    :root {
      --brand-dark: #00224C;
      --brand-mid: #003D8F;
      --brand-light: #0051B5;
      --brand-accent: #2E8BFF;
    }
    * { box-sizing: border-box; }
    body {
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 24px;
      font-family: 'Ubuntu', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
      background:
        radial-gradient(1100px 550px at 15% -10%, rgba(46,139,255,.35), transparent 60%),
        radial-gradient(900px 500px at 110% 110%, rgba(0,61,143,.55), transparent 60%),
        linear-gradient(160deg, var(--brand-dark) 0%, #001636 65%, #000e22 100%);
      color: #fff;
    }
    .login-shell {
      width: 100%;
      max-width: 380px;
    }
    .login-brand {
      display: flex;
      align-items: center;
      gap: .7rem;
      margin-bottom: 1.75rem;
    }
    .login-brand img {
      height: 34px;
      width: auto;
    }
    .login-brand strong {
      font-size: 1.05rem;
      font-weight: 500;
      letter-spacing: .02em;
    }
    .login-card {
      background: #fff;
      color: #101B2D;
      border: none;
      border-radius: 16px;
      padding: 2.1rem 2rem;
      box-shadow: 0 24px 60px -20px rgba(0,14,34,.55);
    }
    .login-card h4 {
      margin: 0 0 .3rem;
      font-weight: 500;
      color: var(--brand-dark);
    }
    .login-card p.text-muted {
      font-size: .88rem;
      margin-bottom: 1.6rem;
    }
    .form-label {
      font-size: .82rem;
      font-weight: 500;
      color: #344054;
    }
    .form-control {
      border-radius: 10px;
      border-color: #e1e8f5;
      padding: .6rem .85rem;
    }
    .form-control:focus {
      border-color: var(--brand-accent);
      box-shadow: 0 0 0 .2rem rgba(46,139,255,.16);
    }
    .btn-login {
      background: var(--brand-dark);
      border: none;
      color: #fff;
      font-weight: 500;
      border-radius: 10px;
      padding: .65rem;
      transition: background .15s ease;
    }
    .btn-login:hover {
      background: var(--brand-accent);
      color: #fff;
    }
    .form-check-input:checked {
      background-color: var(--brand-accent);
      border-color: var(--brand-accent);
    }
    .alert-danger {
      border-radius: 10px;
      border: none;
      background: #fde8e8;
      color: #9b1c1c;
      font-size: .87rem;
    }
    .login-footnote {
      text-align: center;
      margin-top: 1.4rem;
      font-size: .78rem;
      color: rgba(255,255,255,.6);
    }
    .login-footnote a {
      color: rgba(255,255,255,.85);
      text-decoration: none;
    }
    .login-footnote a:hover { text-decoration: underline; }
  </style>
</head>
<body>
  <div class="login-shell">
    <div class="login-brand">
      @if(!empty($setting->logo))
        <img src="{{ asset('storage/'.$setting->logo) }}" alt="{{ $setting->site_title ?? 'Asa Production' }}">
      @else
        <img src="{{ asset('images/logo.png') }}" alt="{{ $setting->site_title ?? 'Asa Production' }}">
      @endif
      <strong>{{ $setting->site_title ?? 'Asa Production' }}</strong>
    </div>

    <div class="login-card">
      <h4>Masuk ke Admin Panel</h4>
      <p class="text-muted">Kelola konten website dari satu tempat.</p>

      @if($errors->any())
        <div class="alert alert-danger">
          @foreach($errors->all() as $error)
            <div>{{ $error }}</div>
          @endforeach
        </div>
      @endif

      <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="mb-3">
          <label class="form-label">Email</label>
          <input type="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus>
        </div>
        <div class="mb-3">
          <label class="form-label">Password</label>
          <input type="password" name="password" class="form-control" required>
        </div>
        <div class="form-check mb-3">
          <input type="checkbox" name="remember" class="form-check-input" id="remember">
          <label class="form-check-label" for="remember">Ingat saya</label>
        </div>
        <button type="submit" class="btn btn-login w-100">Login</button>
      </form>
    </div>

    <div class="login-footnote">
      &larr; <a href="{{ route('home') }}">Kembali ke situs</a>
    </div>
  </div>
</body>
</html>
