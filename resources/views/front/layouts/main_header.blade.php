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
                            <a href="{{asset('front')}}/javascript:void(0);">
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
                            <li><a class="fab fa-whatsapp" href="{{$whatsapp}}" target="blank"></a></li>
                        @endif
                        @foreach($socialLinks as $social)
                            @if($social && $social->setting_value && $social->social_type)
                                <li>
                                    <a href="{{ $social->setting_value }}" target="_blank"
                                        @if($social->social_type == 'tiktok')
                                             class="fab- fa-tiktok"
                                        @elseif($social->social_type == 'youtube')
                                           class="fab fa-youtube"
                                       @elseif($social->social_type == 'twitter')
                                           class="fab fa-twitter"
                                       @elseif($social->social_type == 'telegram')
                                           class="fa-brands fa-telegram"
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
                <div class="logo-header mostion logo-dark"><a href="{{asset('front')}}/index.html"><img
                            src="{{asset('storage').'/'.$siteImages->logo}}" width="193" height="89" alt=""></a></div>
    <a href="https://wa.me/{{\App\Models\Admin\Setting::getValue('phone')}}" class="floating-whatsapp-head " target="_blank" >
        <div class="whatsapp-icon">
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 32" class="wa-messenger-svg-whatsapp">
                <path d="M19.11 17.205c-.372 0-1.088 1.39-1.518 1.39a.63.63 0 0 1-.315-.1c-.802-.402-1.504-.817-2.163-1.447-.545-.516-1.146-1.29-1.46-1.963a.426.426 0 0 1-.073-.215c0-.33.99-.945.99-1.49 0-.143-.73-2.09-.832-2.335-.143-.372-.214-.487-.6-.487-.187 0-.36-.043-.53-.043-.302 0-.53.115-.746.315-.688.645-1.032 1.318-1.06 2.264v.114c-.015.99.472 1.977 1.017 2.78 1.23 1.82 2.506 3.41 4.554 4.34.616.287 2.035.888 2.722.888.817 0 2.15-.515 2.478-1.318.13-.33.244-.73.244-1.088 0-.058 0-.144-.03-.215-.1-.172-2.434-1.39-2.678-1.39zm-2.908 7.593c-1.747 0-3.48-.53-4.942-1.49L7.793 24.41l1.132-3.337a8.955 8.955 0 0 1-1.72-5.272c0-4.955 4.04-8.995 8.997-8.995S25.2 10.845 25.2 15.8c0 4.958-4.04 8.998-8.998 8.998zm0-19.798c-5.96 0-10.8 4.842-10.8 10.8 0 1.964.53 3.898 1.546 5.574L5 27.176l5.974-1.92a10.807 10.807 0 0 0 16.03-9.455c0-5.958-4.842-10.8-10.802-10.8z"
                      fill="#ffffff"
                      fill-rule="evenodd"/>
            </svg>
        </div>
        <span>تواصل معنا</span>
    </a>

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
                        <a href="javascript:void(0);" id="quik-search-btn" class="search-btn"><i
                                class="fas fa-search"></i></a>
                        <a href="{{asset('front')}}/shop-cart.html" class="cart-btn"><i
                                class="fas fa-shopping-cart "></i></a>
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
                        <li class="{{Route::is('home.index') ? 'active':''}}"><a href="{{route('home.index')}}">الرئيسية</a>
                        </li>
                        <li class="{{Route::is('home.category.products') ? 'active':''}}"><a href="javascript:;">منتجاتنا <i class="fas fa-chevron-down"></i></a>
                            <ul class="sub-menu">
                                @php
                                $categories = \App\Models\Admin\Category::whereNull('parent_id')->get();
                                @endphp
                                @foreach($categories as $category)
                                <li><a href="{{route('home.category.products',$category->id)}}">{{$category->name}}</a></li>
                                @endforeach
                            </ul>
                        </li>
                        <li class="{{Route::is('home.about') ? 'active':''}}"><a href="{{route('home.about')}}">من نحن</a>
                        </li>
                        <li class="{{Route::is('home.branches') ? 'active':''}}"><a href="{{route('home.branches')}}">فروعنا</a>
                        </li>
{{--                        <li class="{{Route::is('home.category.contact') ? 'active':''}}"><a href="javascript:;">اتصل بنا</a>--}}
{{--                        </li>--}}
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- main header END -->
</header>
<!-- header END -->
<div class="page-wraper">
