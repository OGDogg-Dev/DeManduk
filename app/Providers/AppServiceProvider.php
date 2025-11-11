<?php

namespace App\Providers;

use App\Models\SiteSetting;
use Illuminate\Support\Facades\Schema;
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
        View::composer('*', function ($view): void {
            static $shared;

            if ($shared === null) {
                if (! Schema::hasTable('site_settings')) {
                    $shared = [
                        'siteTitle' => "D'Manduk",
                        'siteLogoPath' => null,
                        'siteFaviconPath' => null,
                        'siteMetaTitle' => 'Waduk - JDIH Kemenko Maritim & Investasi',
                        'siteMetaDescription' => "Temukan informasi lengkap D'Manduk: fasilitas, harga tiket, agenda event, berita terbaru, SOP, dan kontak resmi.",
                        'siteReferenceLabel' => 'Kemenko Bidang Kemaritiman dan Investasi',
                        'siteReferenceUrl' => 'https://jdih.maritim.go.id/waduk',
                        'siteReferenceSnippet' => 'Waduk adalah wadah buatan yang terbentuk sebagai akibat dibangunnya bendungan. Referensi resmi: Perpres Nomor 64 Tahun 2022.',
                    ];
                } else {
                    $shared = [
                        'siteTitle' => SiteSetting::getValue('site.title', "D'Manduk"),
                        'siteLogoPath' => SiteSetting::getValue('site.logo_path'),
                        'siteFaviconPath' => SiteSetting::getValue('site.favicon_path'),
                        'siteMetaTitle' => SiteSetting::getValue('seo.meta_title', 'Waduk - JDIH Kemenko Maritim & Investasi'),
                        'siteMetaDescription' => SiteSetting::getValue('seo.meta_description', "Temukan informasi lengkap D'Manduk: fasilitas, harga tiket, agenda event, berita terbaru, SOP, dan kontak resmi."),
                        'siteReferenceLabel' => SiteSetting::getValue('seo.reference_label', 'Kemenko Bidang Kemaritiman dan Investasi'),
                        'siteReferenceUrl' => SiteSetting::getValue('seo.reference_url', 'https://jdih.maritim.go.id/waduk'),
                        'siteReferenceSnippet' => SiteSetting::getValue('seo.reference_snippet', 'Waduk adalah wadah buatan yang terbentuk sebagai akibat dibangunnya bendungan. Referensi resmi: Perpres Nomor 64 Tahun 2022.'),
                    ];
                }
            }

            $view->with($shared);
        });
    }
}
