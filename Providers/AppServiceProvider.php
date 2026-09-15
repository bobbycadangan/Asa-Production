<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }

        // Pastikan $setting (termasuk favicon) selalu tersedia di halaman
        // admin, supaya favicon admin selalu sama dengan situs utama
        // walau controller-nya tidak mengirim variabel $setting.
        View::composer(['layouts.admin', 'auth.login'], function ($view) {
            if (! array_key_exists('setting', $view->getData())) {
                $view->with('setting', Setting::current());
            }
        });
    }
}
