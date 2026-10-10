<?php

namespace App\Providers;

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
        if (isset($_SERVER['HTTP_HOST'])) {
            $scheme = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ||
                      (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https')
                      ? 'https' : 'http';
            $rootUrl = $scheme . '://' . $_SERVER['HTTP_HOST'];
            config(['app.url' => $rootUrl]);
            \Illuminate\Support\Facades\URL::forceRootUrl($rootUrl);
        }

        \Illuminate\Support\Facades\Vite::createAssetPathsUsing(fn (string $path) => '/' . ltrim($path, '/'));

        if (config('app.env') === 'production' || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https')) {
            \Illuminate\Support\Facades\URL::forceScheme('https');
        }
    }
}
