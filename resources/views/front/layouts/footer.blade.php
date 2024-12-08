
{{--<div class="section-full p-t50 p-b20 bg-gray">--}}
{{--    <div class="container">--}}
{{--        <div class="row">--}}
{{--            <div class="col-lg-4 col-md-4 col-sm-12">--}}
{{--                <div class="icon-bx-wraper left m-b30">--}}
{{--                    <div class="icon-md text-black radius">--}}
{{--                        <a href="#" class="icon-cell text-black"><i class="fas fa-gift"></i></a>--}}
{{--                    </div>--}}
{{--                    <div class="icon-content">--}}
{{--                        <h5 class="dlab-tilte">Free shipping on orders $60+</h5>--}}
{{--                        <p>Order more than 60$ and you will get free shippining Worldwide. More info.</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-lg-4 col-md-4 col-sm-12">--}}
{{--                <div class="icon-bx-wraper left m-b30">--}}
{{--                    <div class="icon-md text-black radius">--}}
{{--                        <a href="#" class="icon-cell text-black"><i class="fas fa-plane"></i></a>--}}
{{--                    </div>--}}
{{--                    <div class="icon-content">--}}
{{--                        <h5 class="dlab-tilte">Worldwide delivery</h5>--}}
{{--                        <p>We deliver to the following countries: USA, Canada, Europe, Australia</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-lg-4 col-md-4 col-sm-12">--}}
{{--                <div class="icon-bx-wraper left m-b30">--}}
{{--                    <div class="icon-md text-black radius">--}}
{{--                        <a href="#" class="icon-cell text-black"><i class="fas fa-history"></i></a>--}}
{{--                    </div>--}}
{{--                    <div class="icon-content">--}}
{{--                        <h5 class="dlab-tilte">60 days money back guranty!</h5>--}}
{{--                        <p>Not happy with our product, feel free to return it, we will refund 100% your money!</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
<!-- contact area  END -->

<!-- Footer -->
<footer class="site-footer ">
    <!-- footer top part -->
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 footer-col-4">
                    <div class="widget widget_about">
                        <div class="logo-footer logo-white"><img src="{{asset('storage').'/'.$siteImages?->footer_image}}" alt=""></div>
                         {!! \App\Models\Admin\Setting::getValue('footer_desc') !!}
{{--                        <ul class="dlab-social-icon dez-border">--}}
{{--                            <li><a class="fab fa-facebook-f" href="{{asset('front')}}/https://www.facebook.com/" target="blank"></a></li>--}}
{{--                            <li><a class="fab fa-twitter" href="{{asset('front')}}/https://twitter.com/" target="blank"></a></li>--}}
{{--                            <li><a class="fab fa-linkedin-in" href="{{asset('front')}}/https://www.linkedin.com/" target="blank"></a></li>--}}
{{--                            <li><a class="fab fa-facebook-f" href="{{asset('front')}}/https://www.facebook.com/" target="blank"></a></li>--}}
{{--                        </ul>--}}
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 footer-col-4">
                    <div class="widget widget_services">
                        <h4 class="m-b15 text-uppercase"> روابط سريعة</h4>
                        <div class="dlab-separator-outer m-b10">
                            <div class="dlab-separator bg-white style-skew"></div>
                        </div>
                        <ul>
                            <li><a href="{{asset('front')}}/engine-diagnostics.html">Engine Diagnostics</a></li>
                            <li><a href="{{asset('front')}}/belts-and-hoses.html">Belts and Hoses</a></li>
                            <li><a href="{{asset('front')}}/air-conditioning.html">Air Conditioning</a></li>
                            <li><a href="{{asset('front')}}/air-conditioning.html">Air Conditioning</a></li>
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
                            <li><a href="{{asset('front')}}/engine-diagnostics.html">Engine Diagnostics</a></li>
                            <li><a href="{{asset('front')}}/lube-oil-and-filters.html">Lube, Oil and Filters</a></li>
                            <li><a href="{{asset('front')}}/belts-and-hoses.html">Belts and Hoses</a></li>
                            <li><a href="{{asset('front')}}/belts-and-hoses.html">Belts and Hoses</a></li>
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
                            <li><i class="ti-location-pin"></i><strong>العنوان</strong> {{\App\Models\Admin\Setting::getValue('address')}} </li>
                            <li><i class="ti-mobile"></i><strong>الجوال</strong>{{\App\Models\Admin\Setting::getValue('phone')}}</li>
                            <li><i class="ti-printer"></i><strong>البريد الالكتروني</strong>{{\App\Models\Admin\Setting::getValue('email')}}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- footer bottom part -->
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 text-left">
                    <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  Copyright © Elmallahsoft </span>
                </div>
                <div class="col-lg-4 col-md-4 text-center">
                    <span> Design With  <i class="ti-heart text-primary heart"></i>  By <a href="#" target="_blank"> Elmallah Soft</a> </span>
                </div>
                <div class="col-lg-4 col-md-4 text-right">
                    <a href="#"> About Us</a>
                    <a href="#"> FAQs</a>
                    <a href="#"> Contact Us</a>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Footer END-->
</div>
