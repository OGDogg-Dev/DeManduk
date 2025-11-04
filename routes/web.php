<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\EventController as AdminEventController;
use App\Http\Controllers\Admin\GalleryController as AdminGalleryController;
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
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\Admin\Pages\ContactAlertController;
use App\Http\Controllers\Admin\Pages\ContactSettingsController;
use App\Http\Controllers\Admin\Pages\ContactSupportController;
use App\Http\Controllers\Admin\Pages\QrisFaqController;
use App\Http\Controllers\Admin\Pages\QrisNoteController;
use App\Http\Controllers\Admin\Pages\QrisSettingsController;
use App\Http\Controllers\Admin\Pages\QrisStepController;
use App\Http\Controllers\Admin\Pages\SopObjectiveController;
use App\Http\Controllers\Admin\Pages\SopPartnerController;
use App\Http\Controllers\Admin\Pages\SopSettingsController;
use App\Http\Controllers\Admin\Pages\SopStepController;
use App\Http\Controllers\Admin\Pages\SocialMediaSettingsController;
use App\Http\Controllers\QrisController;
use App\Http\Controllers\SopController;
use App\Models\NewsPost;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');
Route::view('/profil', 'public.profile')->name('profile');
Route::view('/fasilitas-harga', 'public.fasilitas-harga')->name('fasilitas.harga');
Route::view('/jam-operasional', 'public.jam')->name('jam');
Route::view('/peta', 'public.peta')->name('peta');
Route::get('/galeri', GalleryController::class)->name('galeri');

Route::get('/event', [EventController::class, 'index'])->name('event.index');
Route::get('/event/{event:slug}', [EventController::class, 'show'])->name('event.show');

Route::get('/berita', [NewsController::class, 'index'])->name('news.index');
Route::get('/berita/{news:slug}', [NewsController::class, 'show'])->name('news.show');
Route::get('/blog', fn () => redirect()->route('news.index'));
Route::get('/blog/{news:slug}', fn (NewsPost $news) => redirect()->route('news.show', $news));

Route::get('/kontak', ContactController::class)->name('kontak');
Route::get('/qris', QrisController::class)->name('qris');
Route::get('/sop', SopController::class)->name('sop');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.perform');
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::view('/', 'admin.dashboard')->name('dashboard');
    Route::view('/styleguide', 'admin.styleguide')->name('styleguide');
    Route::resource('gallery', AdminGalleryController::class)
        ->parameters(['gallery' => 'galleryItem'])
        ->except('show');
    Route::resource('news', AdminNewsController::class)->except('show');

    Route::prefix('pages')->name('pages.')->group(function () {
        Route::prefix('contact')->name('contact.')->group(function () {
            Route::get('/', [ContactSettingsController::class, 'edit'])->name('settings.edit');
            Route::put('/', [ContactSettingsController::class, 'update'])->name('settings.update');

            Route::resource('supports', ContactSupportController::class)
                ->parameters(['supports' => 'support'])
                ->except('show');
            Route::resource('alerts', ContactAlertController::class)
                ->parameters(['alerts' => 'alert'])
                ->except('show');
        });

        Route::prefix('qris')->name('qris.')->group(function () {
            Route::get('/', [QrisSettingsController::class, 'edit'])->name('settings.edit');
            Route::put('/', [QrisSettingsController::class, 'update'])->name('settings.update');

            Route::resource('steps', QrisStepController::class)
                ->parameters(['steps' => 'step'])
                ->except('show');
            Route::resource('notes', QrisNoteController::class)
                ->parameters(['notes' => 'note'])
                ->except('show');
            Route::resource('faqs', QrisFaqController::class)
                ->parameters(['faqs' => 'faq'])
                ->except('show');
        });

        Route::prefix('sop')->name('sop.')->group(function () {
            Route::get('/', [SopSettingsController::class, 'edit'])->name('settings.edit');
            Route::put('/', [SopSettingsController::class, 'update'])->name('settings.update');

            Route::resource('steps', SopStepController::class)
                ->parameters(['steps' => 'step'])
                ->except('show');
            Route::resource('objectives', SopObjectiveController::class)
                ->parameters(['objectives' => 'objective'])
                ->except('show');
            Route::resource('partners', SopPartnerController::class)
                ->parameters(['partners' => 'partner'])
                ->except('show');
        });

        Route::prefix('social-media')->name('social-media.')->group(function () {
            Route::get('/', [SocialMediaSettingsController::class, 'edit'])->name('settings.edit');
            Route::put('/', [SocialMediaSettingsController::class, 'update'])->name('settings.update');
        });
    });

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
