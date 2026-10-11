<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ProjectDetailController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\EducationController;
use App\Http\Controllers\Admin\ExperienceController;
use App\Http\Controllers\Admin\SkillController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\CertificateController;
use App\Http\Controllers\Admin\SocialLinkController;
use App\Http\Controllers\Admin\ContactMessageController;

/*
|--------------------------------------------------------------------------
| Public Portfolio Routes (Bisa diakses siapa saja tanpa login)
|--------------------------------------------------------------------------
*/
Route::get('/', [PortfolioController::class, 'index'])->name('portfolio.index');
Route::post('/contact', [PortfolioController::class, 'contact'])->name('portfolio.contact');
Route::get('/cv', [PortfolioController::class, 'downloadCv'])->name('portfolio.cv');
Route::get('/project/{slug}', [ProjectDetailController::class, 'show'])->name('portfolio.project.detail');

/*
|--------------------------------------------------------------------------
| Admin Authentication Routes
|--------------------------------------------------------------------------
*/
Route::redirect('/login', '/admin/login')->name('login');
Route::get('/admin/login', [AuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

/*
|--------------------------------------------------------------------------
| Protected Admin Dashboard Routes (/admin - Wajib Login)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    // /admin redirect to dashboard
    Route::get('/', function () {
        return redirect()->route('admin.dashboard');
    })->name('root');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Section 1: Profile Management
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Section 2: About Section Management
    Route::get('/about', [AboutController::class, 'edit'])->name('about.edit');
    Route::put('/about', [AboutController::class, 'update'])->name('about.update');

    // Section 3-8: CRUD Modules
    Route::resource('educations', EducationController::class);
    Route::resource('experiences', ExperienceController::class);
    Route::resource('skills', SkillController::class);
    Route::resource('projects', ProjectController::class);
    Route::resource('certificates', CertificateController::class);
    Route::resource('social-links', SocialLinkController::class);
    Route::resource('messages', ContactMessageController::class)->only(['index', 'show', 'destroy']);
    Route::get('/messages-poll', [ContactMessageController::class, 'poll'])->name('messages.poll');

    // One-click helper to migrate and seed cloud database
    Route::get('/migrate-db', function () {
        try {
            \Illuminate\Support\Facades\Artisan::call('migrate', ['--force' => true]);
            \Illuminate\Support\Facades\Artisan::call('db:seed', ['--force' => true]);
            return redirect()->route('admin.dashboard')->with('success', 'Database cloud berhasil dimigrasikan dan di-seed!');
        } catch (\Throwable $e) {
            return redirect()->route('admin.dashboard')->with('error', 'Gagal migrasi database: ' . $e->getMessage());
        }
    })->name('migrate.db');
});
