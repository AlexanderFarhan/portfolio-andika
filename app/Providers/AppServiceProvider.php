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
        $this->app->bind('db.connector.pgsql', function () {
            return new class extends \Illuminate\Database\Connectors\PostgresConnector {
                protected function getDsn(array $config)
                {
                    $dsn = parent::getDsn($config);
                    if (!empty($config['endpoint'])) {
                        $dsn .= ";options='endpoint={$config['endpoint']}'";
                    } elseif (isset($config['host']) && str_contains($config['host'], 'neon.tech')) {
                        $parts = explode('.', $config['host']);
                        $endpoint = str_replace('-pooler', '', $parts[0]);
                        $dsn .= ";options='endpoint={$endpoint}'";
                    }
                    return $dsn;
                }

                public function getOptions(array $config)
                {
                    if (isset($config['options']) && !is_array($config['options'])) {
                        unset($config['options']);
                    }
                    return parent::getOptions($config);
                }
            };
        });
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

        if (env('VIEW_COMPILED_PATH')) {
            config(['view.compiled' => env('VIEW_COMPILED_PATH')]);
        }

        if (config('app.env') === 'production' || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https')) {
            \Illuminate\Support\Facades\URL::forceScheme('https');
        }
    }
}
