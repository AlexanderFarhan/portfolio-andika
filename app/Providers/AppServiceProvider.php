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

        try {
            if (\Illuminate\Support\Facades\Schema::hasTable('contact_messages') && !\Illuminate\Support\Facades\Schema::hasColumn('contact_messages', 'phone')) {
                \Illuminate\Support\Facades\Schema::table('contact_messages', function (\Illuminate\Database\Schema\Blueprint $table) {
                    $table->string('phone')->nullable()->after('email');
                });
            }

            // Ensure inbox message is clean: delete any security alert rows previously created
            if (\Illuminate\Support\Facades\Schema::hasTable('contact_messages')) {
                \App\Models\ContactMessage::where('email', 'security-alert@andika.dev')
                    ->orWhere('subject', 'like', '%Percobaan Menerobos Masuk%')
                    ->orWhere('name', 'like', '%Sistem Keamanan%')
                    ->delete();
            }

            // Ensure admin_lockdowns table exists for serverless neon database
            if (!\Illuminate\Support\Facades\Schema::hasTable('admin_lockdowns')) {
                \Illuminate\Support\Facades\Schema::create('admin_lockdowns', function (\Illuminate\Database\Schema\Blueprint $table) {
                    $table->id();
                    $table->boolean('is_locked')->default(false);
                    $table->string('lock_token', 100)->nullable();
                    $table->string('unlock_otp', 20)->nullable();
                    $table->timestamp('otp_expires_at')->nullable();
                    $table->timestamp('locked_at')->nullable();
                    $table->string('locked_reason')->nullable();
                    $table->string('attempted_email')->nullable();
                    $table->string('ip_address')->nullable();
                    $table->text('user_agent')->nullable();
                    $table->timestamp('last_alert_sent_at')->nullable();
                    $table->timestamps();
                });
            }
        } catch (\Throwable $e) {
            // Ignore database connection failures in build or offline stages
        }

        try {
            if (\Illuminate\Support\Facades\Schema::hasTable('users')) {
                // Remove legacy default email admin@andika.dev and ensure only requested admin exists
                \App\Models\User::where('email', '!=', 'andikaamansyah31245@gmail.com')->delete();
                \App\Models\User::updateOrCreate(
                    ['email' => 'andikaamansyah31245@gmail.com'],
                    [
                        'name' => 'Andika Amansyah',
                        'password' => \Illuminate\Support\Facades\Hash::make('lucasdikawfa47'),
                        'email_verified_at' => now(),
                    ]
                );
            }
        } catch (\Throwable $e) {
            // Ignore database connection failures in build or offline stages
        }
    }
}
