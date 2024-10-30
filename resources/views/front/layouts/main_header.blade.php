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
                    <ul class="social-bx list-inline float-end align-self-center">
                        <li><a class="fab fa-facebook-f" href="" target="blank"></a></li>
                        <li><a class="fab fa-twitter" href="{{\App\Models\Admin\Setting::getValue('appointments')}}" target="blank"></a></li>
                        <li><a class="fab fa-linkedin-in" href="{{\App\Models\Admin\Setting::getValue('appointments')}}" target="blank" ></a></li>
                        <li><a class="fab fa-google-plus-g" href="{{\App\Models\Admin\Setting::getValue('appointments')}}" target="blank" ></a></li>
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
                <div class="logo-header mostion logo-dark"><a href="{{asset('front')}}/index.html"><img src="{{asset('storage').'/'.$siteImages->logo}}" width="193" height="89" alt=""></a></div>
                <!-- nav toggle button -->
                <button class="navbar-toggler collapsed navicon justify-content-end" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
                <!-- extra nav -->
                <div class="extra-nav">
                    <div class="extra-cell">
                        <a href="javascript:void(0);" id="quik-search-btn" class="search-btn"><i class="fas fa-search"></i></a>
                        <a href="{{asset('front')}}/shop-cart.html" class="cart-btn"><i class="fas fa-shopping-cart "></i></a>
                    </div>
                </div>
                <!-- Quik search -->
                <div class="dlab-quik-search bg-primary">
                    <form action="#">
                        <input name="search" value="" type="text" class="form-control" placeholder="ابحث عن ما تريد">
                        <span  id="quik-search-remove"><i class="fas fa-times"></i></span>
                    </form>
                </div>
                <!-- main nav -->
                <div class="header-nav navbar-collapse collapse justify-content-center" id="navbarNavDropdown">
                    <ul class="nav navbar-nav">
                        <li class="active"> <a href="javascript:;">الرئيسية</a>
                        </li>
                        <li> <a href="javascript:;">منتجاتنا <i class="fas fa-chevron-down"></i></a>
                            <ul class="sub-menu">
                                <li><a href="{{asset('front')}}/header-style-1.html">تلبيسة دياموند</a></li>
                                <li><a href="{{asset('front')}}/header-style-2.html">تلبيسة فاخر</a></li>
                                <li><a href="{{asset('front')}}/header-style-3.html">تلبيسة مثللثات</a></li>
                                <li><a href="{{asset('front')}}/header-style-4.html">تلبيسة ليزر</a></li>
                            </ul>
                        </li>
                        <li> <a href="javascript:;">من نحن</a>
                        </li>
                        <li> <a href="javascript:;">فروعنا</a>
                        </li>
                        <li> <a href="javascript:;">اتصل بنا</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- main header END -->
</header>
<!-- header END -->
<div class="page-wraper">
