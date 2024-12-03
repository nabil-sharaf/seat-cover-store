<?php

namespace App\Providers;

use App\Models\Admin\SiteImage;
use Illuminate\Support\Facades\Event;
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
        // تحقق إذا كان جدول الكاش موجودًا
        if (Schema::hasTable('cache')) {
            // جلب صور الموقع ومشاركتها في جميع القوالب، مع استخدام التخزين المؤقت
            $siteImages = cache()->remember('siteImages', now()->addHours(24), function () {
                return SiteImage::first();
            });
            View::share('siteImages', $siteImages);
        } else {
            // جلب صور الموقع بدون كاش إذا لم يكن الجدول موجودًا
            $siteImages = SiteImage::first();
            View::share('siteImages', $siteImages);
        }
    }


}
