<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\EventController as AdminEventController;
use App\Http\Controllers\Admin\Home\FeatureController;
use App\Http\Controllers\Admin\Home\GuideController;
use App\Http\Controllers\Admin\Home\OpeningHourController;
use App\Http\Controllers\Admin\Home\OverviewController;
use App\Http\Controllers\Admin\Home\PricingRowController;
use App\Http\Controllers\Admin\Home\ProcedureController;
use App\Http\Controllers\Admin\Home\ProjectController;
use App\Http\Controllers\Admin\Home\SettingController;
use App\Http\Controllers\Admin\Home\SlideController;
use App\Http\Controllers\Admin\Home\StatController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');
Route::view('/profil', 'public.profile')->name('profile');
Route::view('/fasilitas-harga', 'public.fasilitas-harga')->name('fasilitas.harga');
Route::view('/jam-operasional', 'public.jam')->name('jam');
Route::view('/peta', 'public.peta')->name('peta');
Route::view('/galeri', 'public.galeri')->name('galeri');

Route::get('/event', [EventController::class, 'index'])->name('event.index');
Route::get('/event/{event:slug}', [EventController::class, 'show'])->name('event.show');

Route::view('/blog', 'public.blog.index')->name('blog.index');
Route::view('/blog/{slug}', 'public.blog.show')->name('blog.show');

Route::view('/sop', 'public.sop')->name('sop');
Route::view('/kontak', 'public.kontak')->name('kontak');
Route::view('/qris', 'public.qris')->name('qris');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.perform');
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::view('/', 'admin.dashboard')->name('dashboard');

    Route::prefix('home')->name('home.')->group(function () {
        Route::get('/', [OverviewController::class, 'index'])->name('index');
        Route::get('/settings', [SettingController::class, 'edit'])->name('settings.edit');
        Route::put('/settings', [SettingController::class, 'update'])->name('settings.update');

        Route::resource('slides', SlideController::class)->except('show');
        Route::resource('projects', ProjectController::class)->except('show');
        Route::resource('features', FeatureController::class)->except('show');
        Route::resource('pricing', PricingRowController::class)->except('show');
        Route::resource('hours', OpeningHourController::class)->except('show');
        Route::resource('stats', StatController::class)->except('show');
        Route::resource('procedures', ProcedureController::class)->except('show');
        Route::resource('guides', GuideController::class)->except('show');
    });

    Route::resource('events', AdminEventController::class)->except('show');
});
