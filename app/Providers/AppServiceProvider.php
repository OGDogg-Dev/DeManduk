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
                    ];
                } else {
                    $shared = [
                        'siteTitle' => SiteSetting::getValue('site.title', "D'Manduk"),
                        'siteLogoPath' => SiteSetting::getValue('site.logo_path'),
                    ];
                }
            }

            $view->with($shared);
        });
    }
}
