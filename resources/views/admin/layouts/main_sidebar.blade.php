<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('admin.dashboard')}}" class="brand-link ">
{{--      <img src="{{asset('')}}" alt=" seatCover Logo" class="mama-logo  elevation-3">--}}
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image mr-2">
          <img src="{{asset('admin/img/avatar04.png')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::guard('admin')->user()->name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview {{ Request::is(app()->getLocale() .'/admin/settings*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link ">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p class='font-weight-bold'>
                لوحة التحكم
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('admin.settings.edit')}}" class="nav-link {{ Request::is(app()->getLocale() .'/admin/settings') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>اعدادات الموقع</p>
                </a>
              </li>
                <li class="nav-item">
                <a href="{{route('admin.settings.images')}}" class="nav-link {{ Request::is(app()->getLocale() .'/admin/settings/images') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>صور الموقع</p>
                </a>
              </li>
                <li class="nav-item">
                <a href="{{route('admin.shipping-rates.index')}}" class="nav-link {{ Request::is(app()->getLocale() .'/admin/settings/shipping-rates/') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>ادارة تكاليف الشحن </p>
                </a>
              </li>
                <li class="nav-item">
                <a href="{{route('admin.sliders.index')}}" class="nav-link {{ Request::is(app()->getLocale() .'/admin/sliders/') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p> سلايدر الصفحة الرئيسية  </p>
                </a>
              </li>
            </ul>
          </li>
            @if(auth('admin')->user()->hasAnyRole(['superAdmin']))
          <li class="nav-item has-treeview {{ Request::is(app()->getLocale() .'/admin/customers*') || Request::is(app()->getLocale() .'/admin/moderators*')? 'menu-open' : '' }}">
            <a href="#" class="nav-link ">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p class='font-weight-bold'>
                الأعضاء
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
               <li class="nav-item">
                    <a href="{{route('admin.moderators.index')}}" class="nav-link {{ Request::is(app()->getLocale() .'/admin/moderators*') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>المشرفين</p>
                    </a>
                </li>
              <li class="nav-item">
                <a href="{{route('admin.customers.index')}}" class="nav-link {{ Request::is(app()->getLocale() .'/admin/customers*') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>العملاء</p>
                </a>
              </li>

            </ul>
          </li>
            @endif
          <li class="nav-item has-treeview {{ Request::is(app()->getLocale() .'/admin/categories*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link ">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p class='font-weight-bold'>
                الأقسام و التلبيسات
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.categories.index') }}" class="nav-link {{ Request::is(app()->getLocale() .'/admin/categories') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>كل الأقسام</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.categories.create') }}" class="nav-link {{ Request::is(app()->getLocale() .'/admin/categories/create') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>إضافة قسم</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview {{ Request::is(app()->getLocale() .'/admin/products*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link ">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p class='font-weight-bold'>
               ألوان التلبيسات
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.products.index') }}" class="nav-link {{ Request::is(app()->getLocale() .'/admin/products') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>كل الألوان</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.products.create') }}" class="nav-link {{ Request::is(app()->getLocale() .'/admin/products/create') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>إضافة لون</p>
                </a>
              </li>
            </ul>
          </li>

{{--          <li class="nav-item has-treeview {{ Request::is(app()->getLocale() .'/admin/offers*') ? 'menu-open' : '' }}">--}}
{{--            <a href="#" class="nav-link ">--}}
{{--              <i class="nav-icon fas fa-chart-pie"></i>--}}
{{--              <p class='font-weight-bold'>--}}
{{--                عروض التلبيسات--}}
{{--                <i class="right fas fa-angle-left"></i>--}}
{{--              </p>--}}
{{--            </a>--}}
{{--            <ul class="nav nav-treeview">--}}
{{--              <li class="nav-item">--}}
{{--                <a href="{{ route('admin.offers.index') }}" class="nav-link {{ Request::is(app()->getLocale() .'/admin/offers') ? 'active' : '' }}">--}}
{{--                  <i class="far fa-circle nav-icon"></i>--}}
{{--                  <p>كل العروض </p>--}}
{{--                </a>--}}
{{--              </li>--}}
{{--              <li class="nav-item">--}}
{{--                <a href="{{ route('admin.offers.create') }}" class="nav-link {{ Request::is(app()->getLocale() .'/admin/offers/create') ? 'active' : '' }}">--}}
{{--                  <i class="far fa-circle nav-icon"></i>--}}
{{--                  <p>إضافة عرض</p>--}}
{{--                </a>--}}
{{--              </li>--}}
{{--              <li class="nav-item">--}}
{{--                <a href="{{ route('admin.popup.index') }}" class="nav-link {{ Request::is(app()->getLocale() .'/admin/offers/popup') ? 'active' : '' }}">--}}
{{--                  <i class="far fa-circle nav-icon"></i>--}}
{{--                  <p> pop-up الرئيسية</p>--}}
{{--                </a>--}}
{{--              </li>--}}
{{--            </ul>--}}
{{--          </li>--}}

            <li class="nav-item has-treeview {{ Request::is(app()->getLocale() .'/admin/car-brands*') ? 'menu-open' : '' }}">
                <a href="#" class="nav-link ">
                    <i class="nav-icon fas fa-chart-pie"></i>
                    <p class='font-weight-bold'>
                        براندات السيارات
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('admin.car-brands.index') }}" class="nav-link {{ Request::is(app()->getLocale() .'/admin/car-brands') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>كل البراندات </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.car-brands.create') }}" class="nav-link {{ Request::is(app()->getLocale() .'/admin/car-brands/create') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>إضافة براند</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item has-treeview {{ Request::is(app()->getLocale() .'/admin/car-models*') ? 'menu-open' : '' }}">
                <a href="#" class="nav-link ">
                    <i class="nav-icon fas fa-chart-pie"></i>
                    <p class='font-weight-bold'>
                        موديلات السيارات
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('admin.car-models.index') }}" class="nav-link {{ Request::is(app()->getLocale() .'/admin/car-models') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>كل الموديلات </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.car-models.create') }}" class="nav-link {{ Request::is(app()->getLocale() .'/admin/car-models/create') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>إضافة موديل</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item has-treeview {{ Request::is(app()->getLocale() .'/admin/seat-counts*') ? 'menu-open' : '' }}">
                <a href="#" class="nav-link ">
                    <i class="nav-icon fas fa-chart-pie"></i>
                    <p class='font-weight-bold'>
                         المقاعد
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('admin.seat-counts.index') }}" class="nav-link {{ Request::is(app()->getLocale() .'/admin/seat-counts') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>كل المقاعد  </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.seat-counts.create') }}" class="nav-link {{ Request::is(app()->getLocale() .'/admin/seat-counts/create') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>إضافة مقعد </p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item has-treeview {{ Request::is(app()->getLocale() .'/admin/seat-prices*') ? 'menu-open' : '' }}">
                <a href="#" class="nav-link ">
                    <i class="nav-icon fas fa-chart-pie"></i>
                    <p class='font-weight-bold'>
                         أسعار التلبيسات
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('admin.seat-prices.index') }}" class="nav-link {{ Request::is(app()->getLocale() .'/admin/seat-prices') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>كل الأسعار  </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.seat-prices.create') }}" class="nav-link {{ Request::is(app()->getLocale() .'/admin/seat-prices/create') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>إضافة سعر لتلبيسة </p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item has-treeview {{ Request::is(app()->getLocale() .'/admin/bag-options*') ? 'menu-open' : '' }}">
                <a href="#" class="nav-link ">
                    <i class="nav-icon fas fa-chart-pie"></i>
                    <p class='font-weight-bold'>
                         أسعار الشنط
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('admin.bag-options.index') }}" class="nav-link {{ Request::is(app()->getLocale() .'/admin/bag-options') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>كل اسعار الشنط  </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.bag-options.create') }}" class="nav-link {{ Request::is(app()->getLocale() .'/admin/bag-options/create') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>إضافة سعر لشنطة </p>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item has-treeview {{ Request::is(app()->getLocale() .'/admin/accessories*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link ">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p class='font-weight-bold'>
                الاكسسورارات
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.accessories.index') }}" class="nav-link {{ Request::is(app()->getLocale() .'/admin/accessories') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>كل الاكسسوارات</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.accessories.create') }}" class="nav-link {{ Request::is(app()->getLocale() .'/admin/accessories/create') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>إضافة اكسسوار </p>
                </a>
              </li>
            </ul>
          </li>
            <li class="nav-item has-treeview {{ Request::is(app()->getLocale() .'/admin/orders*') ? 'menu-open' : '' }}">
                <a href="#" class="nav-link ">
                    <i class="nav-icon fas fa-chart-pie"></i>
                    <p class='font-weight-bold'>
                        الأوردرات
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('admin.orders.index') }}" class="nav-link {{ Request::is(app()->getLocale() .'/admin/orders') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>كل الأوردرات</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.orders.create') }}" class="nav-link {{ Request::is(app()->getLocale() .'/admin/orders/create') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>إضافة أوردر</p>
                        </a>
                    </li>
                </ul>
            </li>


            @if(auth('admin')->user()->hasAnyRole(['superAdmin']))
          <li class="nav-item has-treeview {{ Request::is(app()->getLocale() .'/admin/promo-codes*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link ">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p class='font-weight-bold'>
                  كوبونات الخصم
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.promo-codes.index') }}" class="nav-link {{ Request::is(app()->getLocale() .'/admin/promo-codes') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>كل الكوبونات</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.promo-codes.create') }}" class="nav-link {{ Request::is(app()->getLocale() .'/admin/promo-codes/create') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>إضافة  كوبون</p>
                </a>
              </li>
            </ul>
          </li>
{{--          <li class="nav-item has-treeview {{ Request::is(app()->getLocale() .'/admin/reports*') ? 'menu-open' : '' }}">--}}
{{--            <a href="#" class="nav-link ">--}}
{{--              <i class="nav-icon fas fa-chart-pie"></i>--}}
{{--              <p class='font-weight-bold'>--}}
{{--               التقارير--}}
{{--                <i class="right fas fa-angle-left"></i>--}}
{{--              </p>--}}
{{--            </a>--}}
{{--            <ul class="nav nav-treeview">--}}
{{--              <li class="nav-item">--}}
{{--                <a href="{{ route('admin.reports.index') }}" class="nav-link {{ Request::is(app()->getLocale() .'/admin/reports') ? 'active' : '' }}">--}}
{{--                  <i class="far fa-circle nav-icon"></i>--}}
{{--                  <p>تقارير المبيعات</p>--}}
{{--                </a>--}}
{{--              </li>--}}
{{--            </ul>--}}
{{--          </li>--}}
            @endif
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
