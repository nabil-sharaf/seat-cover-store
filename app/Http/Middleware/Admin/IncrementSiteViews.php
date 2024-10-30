<?php

namespace App\Http\Middleware\Admin;

use App\Models\Admin\SiteView;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IncrementSiteViews
{
    public function handle($request, Closure $next)
    {
        if (!$request->session()->has('visited')) {
            // جلب السجل الحالي للزيارات أو إنشاء سجل جديد إذا لم يوجد
            $siteView = SiteView::first();

            if ($siteView) {
                // زيادة عدد الزيارات بمقدار واحد
                $siteView->increment('views');
            } else {
                // إنشاء سجل جديد لأول زيارة
                SiteView::create(['views' => 1]);
            }

            // تعيين جلسة المستخدم لمنع تكرار الزيارة
            $request->session()->put('visited', true);
        }

        return $next($request);
    }
}
