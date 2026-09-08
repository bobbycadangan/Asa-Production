<?php
/*
|--------------------------------------------------------------------------
| TAMBAHKAN INI ke routes/web.php
|--------------------------------------------------------------------------
| 1. Tambahkan use statement di paling atas file:
|      use App\Http\Controllers\Admin\PostController;
|      use App\Http\Controllers\BlogController;
|
| 2. Tambahkan route publik (boleh diletakkan setelah route 'home'):
|      Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
|      Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');
|
| 3. Tambahkan route admin di DALAM Route::prefix('admin')->group() yang sudah ada
|    (sejajar dengan Route::resource('faqs', ...)):
|      Route::resource('posts', PostController::class)->except(['show']);
*/
