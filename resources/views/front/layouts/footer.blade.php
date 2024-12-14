<!-- Footer -->
<footer class="site-footer ">
    <!-- footer top part -->
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 footer-col-4">
                    <div class="widget widget_about">
                        <div class="logo-footer logo-white"><img
                                src="{{asset('storage').'/'.$siteImages?->footer_image}}" alt=""></div>
                        {!! \App\Models\Admin\Setting::getValue('footer_desc') !!}
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 footer-col-4">
                    <div class="widget widget_services">
                        <h4 class="m-b15 text-uppercase"> روابط سريعة</h4>
                        <div class="dlab-separator-outer m-b10">
                            <div class="dlab-separator bg-white style-skew"></div>
                        </div>
                        <ul>
                            <li><a href="{{route('login')}}">تسجيل دخول / إنشاء حساب</a></li>
                            <li><a href="{{route('home.branches')}}">فروعنا</a></li>
                            <li><a href="{{route('home.about')}}">من نحن</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 footer-col-4">
                    <div class="widget widget_services">
                        <h4 class="m-b15 text-uppercase">خدماتنا</h4>
                        <div class="dlab-separator-outer m-b10">
                            <div class="dlab-separator bg-white style-skew"></div>
                        </div>
                        <ul>
                            @php
                           $cats = \App\Models\Admin\Category::whereNull('parent_id')->get();
                           @endphp
                            @foreach($cats as $cat)
                                @if($cat->product_type=='accessory')
                                <li><a href="{{route('home.category.products',$cat->id)}}">{{$cat->name}}</a></li>
                                @else
                                <li><a href="{{route('home.index')}}#our-products">{{$cat->name}}</a></li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 footer-col-4">
                    <div class="widget widget_getintuch">
                        <h4 class="m-b15 text-uppercase">اتصل بنا</h4>
                        <div class="dlab-separator-outer m-b10">
                            <div class="dlab-separator bg-white style-skew"></div>
                        </div>
                        <ul>
                            <li>
                                <i class="ti-location-pin"></i><strong>العنوان</strong> {{\App\Models\Admin\Setting::getValue('address')}}
                            </li>
                            <li>
                                <i class="ti-mobile"></i><strong>الجوال</strong>{{\App\Models\Admin\Setting::getValue('phone')}}
                            </li>
                            <li><i class="ti-printer"></i><strong>البريد
                                    الالكتروني</strong>{{\App\Models\Admin\Setting::getValue('email')}}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- footer bottom part -->
    <div class="footer-bottom">
        <div class="container">
            <div class="row text-center">
                <div class="col-lg-6 col-md-6 text-center">
                    <span>Copyright © Elmallahsoft </span>
                </div>
                <div class="col-lg-6 col-md-6 text-center">
                    <span> Design With  <i class="ti-heart text-primary heart"></i>  By <a href="#" target="_blank"> Elmallah Soft</a> </span>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Footer END-->
</div>
