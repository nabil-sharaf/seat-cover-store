<?php

namespace App\Providers;

use App\Models\Admin\SiteImage;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        Event::listen(
            \Illuminate\Auth\Events\Login::class,
            \App\Listeners\LoginEventListener::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
//        // جلب صور الموقع ومشاركتها في جميع القوالب، مع استخدام التخزين المؤقت
        $siteImages = cache()->remember('siteImages', now()->addHours(24), function () {
            return SiteImage::first();
        });
        View::share('siteImages', $siteImages);

    }
}
