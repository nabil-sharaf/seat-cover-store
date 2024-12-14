<body id="bg">
<!-- header -->
<header class="site-header header header-style-7 mo-left">
    <!-- top bar -->
    <div class="top-bar no-skew">
        <div class="container-fluid">
            <div class="d-flex justify-content-between">
                <div class="dlab-topbar-left topbar-info">
                    <ul>
                        <li>
                            <a href="javascript:void(0);">
                                <i class="fas fa-phone-alt text-primary"></i>
                                <span> {{\App\Models\Admin\Setting::getValue('phone')}} </span>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0);">
                                <i class="fas fa-user-check text-primary"></i>
                                <span>{{\App\Models\Admin\Setting::getValue('shipping_title')}}</span>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0);">
                                <i class="fas fa-user-check text-primary"></i>
                                <span>{{\App\Models\Admin\Setting::getValue('appointments')}}</span>
                            </a>
                        </li>
{{--                        <li>--}}
{{--                            <a href="javascript:void(0);">--}}
{{--                                <i class="fas fa-user-check text-primary"></i>--}}
{{--                                <span class="text-decoration-underline fw-bold">تسجيل دخول</span>--}}
{{--                            </a>--}}
{{--                        </li>--}}
                    </ul>
                </div>
                <div class="dlab-topbar-right d-flex ">
                    @php
                        $socialLinks = \App\Models\Admin\Setting::whereIn('setting_key', ['social_link', 'social_link_2'])->get();
                        $facebook = \App\Models\Admin\Setting::getValue('facebook');
                        $instagram = \App\Models\Admin\Setting::getValue('insta');
                        $whatsapp = \App\Models\Admin\Setting::getValue('whats-app');
                    @endphp
                    <ul class="social-bx list-inline float-end align-self-center">
                        @if($facebook !='')
                            <li><a class="fab fa-facebook-f" href="{{$facebook}}" target="blank"></a></li>
                        @endif
                        @if($instagram !='')
                            <li><a class="fab fa-instagram" href="{{$instagram}}" target="blank"></a></li>
                        @endif
                        @if($whatsapp !='')
                            <li><a class="whats-icon-head fab fa-whatsapp" href="{{$whatsapp}}" target="blank"></a></li>
                        @endif
                        @foreach($socialLinks as $social)
                            @if($social && $social->setting_value && $social->social_type)
                                <li>
                                    <a href="{{ $social->setting_value }}" target="_blank"
                                       @if($social->social_type == 'tiktok')
                                           class="fab fa-tiktok"
                                       @elseif($social->social_type == 'youtube')
                                           class="fab fa-youtube"
                                       @elseif($social->social_type == 'twitter')
                                           class="fab fa-twitter"
                                       @elseif($social->social_type == 'snapchat')
                                           class="fab fa-snapchat-ghost"
                                        @endif
                                    >
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- top bar END-->
    <!-- main header -->
    <div class="sticky-header main-bar-wraper navbar-expand-lg">
        <div class="main-bar clearfix ">
            <div class="container-fluid clearfix">
                <!-- website logo -->
                <div class="logo-header mostion logo-dark"><a href="#"><img
                            src="{{asset('storage').'/'.$siteImages?->logo}}" width="193" height="89" alt=""></a></div>
                <!-- nav toggle button -->
                <button class="navbar-toggler collapsed navicon justify-content-end" type="button"
                        data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
                <!-- extra nav -->
                <div class="extra-nav">
                    <div class="extra-cell">
                        <a href="javascript:void(0);" id="quik-search-btn" class="search-btn">
                            <i class="fas fa-search"></i>
                        </a>

                        @auth
                            <div class="user-dropdown-wrapper">
                                <a href="javascript:void(0);" id="user-login-btn" class="fa-user-btn  authenticated-user-btn">
                                    <i class="fas fa-user" title="حسابي"></i>
                                </a>
                                <div class="user-dropdown">
                                    <ul>
                                        <li>
                                            <a href="{{ route('profile.index') }}">
                                                <i class="fas fa-user-circle"></i>
                                                حسابي
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                <i class="fas fa-sign-out-alt"></i>
                                                تسجيل خروج
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        @else
                            <a href="{{route('login')}}" id="user-login-btn" class="fa-user-btn">
                                <i class="fas fa-user" title="تسجيل دخول - انشاء حساب"></i>
                            </a>
                        @endauth

                        <a href="{{route('home.shop-cart')}}" class="cart-btn">
                            <i class="fas fa-shopping-cart"></i>
                            @php
                                $cartCount = \Darryldecode\Cart\Facades\CartFacade::getContent()->count();
                            @endphp
                            <span id="cart-count-span"
                                  class="badge bg-danger position-absolute top-0 start-100 translate-middle"
                                  style="display:{{$cartCount==0 ? 'none':''}};">
                {{$cartCount}}
            </span>
                        </a>
                    </div>
                </div>
                <!-- Quik search -->
                <div class="dlab-quik-search bg-primary">
                    <form action="#">
                        <input name="search" value="" type="text" class="form-control" placeholder="ابحث عن ما تريد">
                        <span id="quik-search-remove"><i class="fas fa-times"></i></span>
                    </form>
                </div>
                <!-- main nav -->
                <div class="header-nav navbar-collapse collapse justify-content-center" id="navbarNavDropdown">
                    <ul class="nav navbar-nav">
                        <li class="{{Route::is('home.index') ? 'active':''}}"><a
                                href="{{route('home.index')}}">الرئيسية</a>
                        </li>
                        <li class="{{Route::is('home.category.products') ? 'active':''}}"><a href="javascript:;">منتجاتنا
                                <i class="fas fa-chevron-down"></i></a>
                            <ul class="sub-menu">
                                @php
                                    $categories = \App\Models\Admin\Category::whereNull('parent_id')->get();
                                @endphp

                                @foreach($categories as $category)
                                    <li style="">
                                        @if($category->children?->isNotEmpty())
                                            <a href="javascript:;">{{$category->name}}<i class="fas fa-angle-right"></i></a>
                                            <ul class="sub-menu" style="direction: ltr">
                                                @foreach($category->children as $cat)
                                                    <li>
                                                        <a href="{{ route('talbisa.index', $cat->id) }}">{{$cat->name}}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @else
                                            <a href="{{ route('home.category.products', $category->id) }}">{{$category->name}}</a>
                                        @endif
                                    </li>

                                @endforeach
                            </ul>
                        </li>
                        <li class="{{Route::is('home.about') ? 'active':''}}"><a href="{{route('home.about')}}">من
                                نحن</a>
                        </li>
                        <li class="{{Route::is('home.branches') ? 'active':''}}"><a href="{{route('home.branches')}}">فروعنا</a>
                        </li>
                        {{--                        <li class="{{Route::is('home.category.contact') ? 'active':''}}"><a href="javascript:;">اتصل بنا</a>--}}
                        {{--                        </li>--}}
                    </ul>
                </div>
            </div>
                @if(session('editing_order_id'))
                    <div class="text-center editing-message">
                        <div class="alert alert-info">انت تقوم حاليا بتعديل الاوردر الخاص بك <a href="{{route('orders.clear-cart')}}" class="text-danger text-decoration-underline"> الغاء التعديل </a></div>
                    </div>
                @endif
        </div>
    </div>
    <!-- main header END -->
</header>
<!-- header END -->
<div class="page-wraper">
