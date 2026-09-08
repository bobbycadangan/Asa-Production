# Asa Production — Laravel Dynamic Website + Admin Dashboard

Paket ini berisi source code **aplikasi Laravel** (bukan project Laravel utuh dengan `vendor/`)
hasil konversi dari template statis `asaproduction.zip` menjadi website dinamis lengkap
dengan **dashboard admin** untuk mengelola semua konten tanpa edit kode.

Struktur folder di zip ini mengikuti struktur project Laravel standar, jadi tinggal
**di-merge / replace** ke dalam project Laravel kosong (hasil `composer create-project laravel/laravel nama-project`).

---
## 1. Yang perlu disiapkan lebih dulu

Karena environment saya tidak bisa mengakses Packagist untuk `composer install`,
paket ini **tidak menyertakan folder `vendor/`**. Silakan siapkan project Laravel kosong dulu:

```bash
composer create-project laravel/laravel asa-production
cd asa-production
```

Laravel versi 10 atau 11 sama-sama didukung — tidak ada package tambahan
(Breeze/Jetstream/dsb) yang dipakai, semua auth dibuat manual pakai Auth facade bawaan Laravel.

---
## 2. Copy-paste file dari paket ini

Salin folder & file berikut dari zip ini ke project Laravel kosong Anda, **replace/timpa** file yang sama:

```
app/Http/Controllers/    → app/Http/Controllers/
app/Http/Middleware/     → app/Http/Middleware/
app/Models/              → app/Models/            (replace User.php)
database/migrations/     → database/migrations/   (tambahkan, jangan hapus migration bawaan users/cache/jobs)
database/seeders/        → database/seeders/       (replace DatabaseSeeder.php)
resources/views/         → resources/views/       (replace welcome.blade.php dihapus, tidak dipakai)
routes/web.php           → routes/web.php         (replace)
public/css, public/js, public/fonts, public/images, public/video → public/  (folder aset statis)
```

> Tips: paling gampang extract zip ini ke folder terpisah, lalu jalankan
> `cp -r` / drag-drop tiap folder di atas ke project Laravel Anda.

---
## 3. Daftarkan middleware `is_admin`

**Kalau pakai Laravel 11+** (ada file `bootstrap/app.php`), buka file itu dan tambahkan di dalam `->withMiddleware()`:

```php
->withMiddleware(function (Middleware $middleware) {
    $middleware->alias([
        'is_admin' => \App\Http\Middleware\IsAdmin::class,
    ]);
})
```

**Kalau pakai Laravel 10** (masih ada `app/Http/Kernel.php`), tambahkan di array `$middlewareAliases`:

```php
protected $middlewareAliases = [
    // ...alias bawaan lainnya
    'is_admin' => \App\Http\Middleware\IsAdmin::class,
];
```

---
## 4. Setup `.env`, database, storage link

```bash
cp .env.example .env
php artisan key:generate
```

Isi kredensial database MySQL/MariaDB di `.env` (`DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`), lalu:

```bash
php artisan storage:link
php artisan migrate --seed
```

Perintah `--seed` akan otomatis membuat:
- 1 akun admin: **email `admin@asaproduction.test`, password `password`** (WAJIB diganti setelah login pertama)
- Data awal (dummy) untuk tim, layanan, portofolio, testimoni, dan partner — supaya halaman depan langsung terlihat terisi dan bisa langsung diedit lewat dashboard.
- Baris `settings` default (judul situs, nomor WhatsApp placeholder `62812xxxxxxx`, dsb) — **segera edit lewat menu Pengaturan Situs**.

---
## 5. Jalankan

```bash
php artisan serve
```

- Halaman utama (publik, dinamis): `http://127.0.0.1:8000/`
- Login admin: `http://127.0.0.1:8000/login`
- Dashboard: `http://127.0.0.1:8000/admin`

---
## 6. Apa saja yang sudah dinamis (bisa diedit dari dashboard, tanpa sentuh kode)

| Menu Admin        | Mengatur bagian di halaman depan                                |
|--------------------|-------------------------------------------------------------------|
| Pengaturan Situs   | Judul, logo, favicon, hero (judul/subjudul/video), teks About, teks Layanan + gambar latar, nomor & pesan WhatsApp, footer |
| Tim Kami           | Section "Our creative team..." (foto, nama, deskripsi tiap anggota) |
| Layanan            | Section 3 kolom "WE ARE CREATIVE / MODERN / EXPERTS" (ikon, judul, deskripsi) |
| Portofolio         | Grid galeri (`#gallery`) — thumbnail + gambar full untuk lightbox |
| Testimoni          | Carousel testimoni klien                                          |
| Partner            | Baris logo partner/klien di bawah testimoni                       |
| Subscriber         | Daftar email yang submit form Subscribe di halaman depan (read-only + hapus) |

Semua item punya field **Urutan** (untuk mengatur posisi tampil) dan **Aktif/Nonaktif**
(untuk sembunyikan tanpa harus hapus datanya).

---
## 7. Catatan teknis penting

- **Tidak ada perubahan CSS/JS pada template asli** — semua file di `public/css`, `public/js`,
  `public/fonts`, `public/images`, `public/video` dipertahankan strukturnya persis seperti
  template statis aslinya (termasuk cara `js/script.js` meng-load library lain secara dinamis
  lewat `document.write`), supaya tampilan & animasi tetap identik.
- Upload gambar disimpan di `storage/app/public/...` lewat Laravel Storage — pastikan
  `php artisan storage:link` sudah dijalankan, kalau tidak gambar upload baru tidak akan tampil.
- Form Subscribe di halaman depan sudah terhubung ke database (tabel `subscribers`) dan
  ada proteksi CSRF (`@csrf`) bawaan Laravel.
- Middleware `is_admin` hanya mengizinkan user dengan kolom `role = 'admin'` di tabel `users`
  masuk ke `/admin`. Kalau mau menambah admin baru, buat user baru lalu set `role` ke `admin`
  (lewat `php artisan tinker` atau menambah seeder sendiri).
