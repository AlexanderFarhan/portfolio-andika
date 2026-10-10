<?php

// 1. Direct Static File Handler (Fallback to guarantee assets load with proper Content-Type)
$uri = urldecode(parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH));
$publicFile = __DIR__ . '/../public' . $uri;

if (!file_exists($publicFile) && str_starts_with($uri, '/public/')) {
    $publicFile = __DIR__ . '/..' . $uri;
}
if (!file_exists($publicFile)) {
    $publicFile = __DIR__ . '/../dist' . $uri;
}

if ($uri !== '/' && file_exists($publicFile) && !is_dir($publicFile)) {
    $extension = strtolower(pathinfo($publicFile, PATHINFO_EXTENSION));
    $mimeType = match ($extension) {
        'css' => 'text/css; charset=utf-8',
        'js', 'mjs' => 'application/javascript; charset=utf-8',
        'svg' => 'image/svg+xml',
        'png' => 'image/png',
        'jpg', 'jpeg' => 'image/jpeg',
        'webp' => 'image/webp',
        'gif' => 'image/gif',
        'ico' => 'image/x-icon',
        'woff' => 'font/woff',
        'woff2' => 'font/woff2',
        'ttf' => 'font/ttf',
        'otf' => 'font/otf',
        'eot' => 'application/vnd.ms-fontobject',
        'json' => 'application/json',
        'pdf' => 'application/pdf',
        default => mime_content_type($publicFile) ?: 'application/octet-stream',
    };

    header("Content-Type: $mimeType");
    header("Cache-Control: public, max-age=31536000, immutable");
    header("Content-Length: " . filesize($publicFile));
    readfile($publicFile);
    exit;
}

// 2. Prepare required directories in /tmp (writable environment in Vercel Serverless)
$directories = [
    '/tmp/storage/framework/views',
    '/tmp/storage/framework/cache/data',
    '/tmp/storage/framework/sessions',
    '/tmp/storage/logs',
    '/tmp/bootstrap/cache',
];

foreach ($directories as $dir) {
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }
}

// 3. Setup SQLite Database in /tmp if not using external DB
$dbConnection = getenv('DB_CONNECTION') ?: 'sqlite';
if ($dbConnection === 'sqlite') {
    $srcDb = __DIR__ . '/../database/database.sqlite';
    $tmpDb = '/tmp/database.sqlite';

    // Copy seeded database to writable /tmp directory if it doesn't exist
    if (!file_exists($tmpDb) && file_exists($srcDb)) {
        copy($srcDb, $tmpDb);
    }

    putenv('DB_CONNECTION=sqlite');
    putenv('DB_DATABASE=' . $tmpDb);
    $_ENV['DB_CONNECTION'] = 'sqlite';
    $_ENV['DB_DATABASE'] = $tmpDb;
}

// 4. Set cache and view compilation path to /tmp
putenv('VIEW_COMPILED_PATH=/tmp/storage/framework/views');
putenv('APP_CONFIG_CACHE=/tmp/bootstrap/cache/config.php');
putenv('APP_EVENTS_CACHE=/tmp/bootstrap/cache/events.php');
putenv('APP_PACKAGES_CACHE=/tmp/bootstrap/cache/packages.php');
putenv('APP_ROUTES_CACHE=/tmp/bootstrap/cache/routes.php');
putenv('APP_SERVICES_CACHE=/tmp/bootstrap/cache/services.php');

$_ENV['VIEW_COMPILED_PATH'] = '/tmp/storage/framework/views';
$_ENV['APP_CONFIG_CACHE'] = '/tmp/bootstrap/cache/config.php';
$_ENV['APP_EVENTS_CACHE'] = '/tmp/bootstrap/cache/events.php';
$_ENV['APP_PACKAGES_CACHE'] = '/tmp/bootstrap/cache/packages.php';
$_ENV['APP_ROUTES_CACHE'] = '/tmp/bootstrap/cache/routes.php';
$_ENV['APP_SERVICES_CACHE'] = '/tmp/bootstrap/cache/services.php';

// 5. Forward request to Laravel public index
require __DIR__ . '/../public/index.php';
