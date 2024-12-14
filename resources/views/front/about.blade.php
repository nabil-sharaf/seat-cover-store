@extends('front.layouts.app')
@section('content')
    <!-- Content -->
    <div class="page-content">
        <!-- inner page banner -->
        <div class="dlab-bnr-inr overlay-black-middle"
             style="background-image:url({{asset('storage/'.$siteImages?->title_image)}}); opacity: .91">
            <div class="container">
                <div class="dlab-bnr-inr-entry">
                    <h1 class="text-white">من نحن</h1>
                </div>
            </div>
        </div>
        <!-- inner page banner END -->
        <!-- Breadcrumb row -->
        <div class="breadcrumb-row">
            <div class="container">
                <ul class="list-inline">
                    <li><a href="{{route('home.index')}}">الرئيسية</a></li>
                    <li> من نحن</li>
                </ul>
            </div>
        </div>
        <!-- Breadcrumb row END -->
        <!-- contact area -->
        <div class="content">
            <!-- About Company -->
            <div class="section-full content-inner bg-white">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="section-head text-left">
                                {!! \App\Models\Admin\Setting::getValue('about_us') !!}
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-6 col-lg-6">
                                    <div class="icon-bx-wraper bx-style-2 m-l40 m-b30 p-a30 left">
                                        <div class="icon-bx-sm radius bg-primary"><a href="#" class="icon-cell"><i
                                                    class="ti-user"></i></a></div>
                                        <div class="icon-content p-l40">
                                            <h4 class="w3-tilte ">طاقم عمل ذو خبرة كفاءة عالية</h4>
                                            <p>لدينا طاقم يتميز بخبرة كبيرة في مجال العناية بالسيارات ومتميزين في سرعة
                                                انجاز الأعمال </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-lg-6">
                                    <div class="icon-bx-wraper bx-style-2 m-l40 m-b30 p-a30 left">
                                        <div class="icon-bx-sm radius bg-primary"><a href="#" class="icon-cell"><i
                                                    class="ti-settings"></i></a></div>
                                        <div class="icon-content p-l40">
                                            <h4 class="w3-tilte ">خدمة عملاء 24 ساعة </h4>
                                            <p>خدمة متميزة مدار الساعة بإمكانك التواصل مع خدمة العملاء على مدار الساعة
                                                لتلبية احتياجاتك واستفساراتك </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-lg-6">
                                    <div class="icon-bx-wraper bx-style-2 m-l40 m-b30 p-a30 left">
                                        <div class="icon-bx-sm radius bg-primary"><a href="#" class="icon-cell"><i
                                                    class="ti-cup"></i></a></div>
                                        <div class="icon-content p-l40">
                                            <h4 class="w3-tilte "> أفضل الخامات</h4>
                                            <p>نحن حريصين على تسليم عملائنا منتجات بجودة عالية والحرص على تقديم أفضل
                                                خامات التلابيس الموجودة في السوق السعودي وذلك ما يجعلنا مميزين وتشتهر به
                                                شركتنا وسبب من أسباب نمو علامتنا التجارية </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-lg-6">
                                    <div class="icon-bx-wraper bx-style-2 m-l40 m-b10 p-a30 left">
                                        <div class="icon-bx-sm radius bg-primary"><a href="#" class="icon-cell"><i
                                                    class="ti-flag-alt-2"></i></a></div>
                                        <div class="icon-content p-l40">
                                            <h4 class="w3-tilte">فروعنا </h4>
                                            <p>لدينا اكثر من فرع على مستوى انحاء المملكة العربية السعودية ونسعى دائما أن نكون بالقرب من عملائنا </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- About Company END -->
            <!-- counter -->
{{--            <div class="section-full aon-our-services bg-gray bg-img-fix content-inner overlay-black-middle"--}}
{{--                 style="background-image:url(images/background/bg2.jpg);">--}}
{{--                <div class="container">--}}
{{--                    <div class="row">--}}
{{--                        <div class="col-lg-3 col-md-6 col-sm-6 m-b30">--}}
{{--                            <div class="p-a30 text-white text-center border-3">--}}
{{--                                <div class="icon-lg m-b20">--}}
{{--                                    <div class="icon-cell text-white"><i class="ti-home"></i></div>--}}
{{--                                </div>--}}
{{--                                <div class="counter font-26 font-weight-800 text-primary m-b5">1035</div>--}}
{{--                                <span>Completed Project</span>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-lg-3 col-md-6 col-sm-6 m-b30">--}}
{{--                            <div class="p-a30 text-white text-center border-3">--}}
{{--                                <div class="icon-lg m-b20">--}}
{{--                                    <div class="icon-cell text-white"><i class="ti-user"></i></div>--}}
{{--                                </div>--}}
{{--                                <div class="counter font-26 font-weight-800 text-primary m-b5">1124</div>--}}
{{--                                <span>Active Experts</span>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-lg-3 col-md-6 col-sm-6 m-b30">--}}
{{--                            <div class="p-a30 text-white text-center border-3">--}}
{{--                                <div class="icon-lg m-b20">--}}
{{--                                    <div class="icon-cell text-white"><i class="ti-user"></i></div>--}}
{{--                                </div>--}}
{{--                                <div class="counter font-26 font-weight-800 text-primary m-b5">834</div>--}}
{{--                                <span>Happy Clients</span>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-lg-3 col-md-6 col-sm-6 m-b10">--}}
{{--                            <div class="p-a30 text-white text-center border-3">--}}
{{--                                <div class="icon-lg m-b20">--}}
{{--                                    <div class="icon-cell text-white"><i class="ti-pie-chart"></i></div>--}}
{{--                                </div>--}}
{{--                                <div class="counter font-26 font-weight-800 text-primary m-b5">538</div>--}}
{{--                                <span>Developer Hand</span>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
            <!-- Counter END-->

            <!-- What peolpe are saying -->
            <div class="section-full overlay-black-middle bg-img-fix content-inner-1"
                 style="background-image:url({{asset('storage/'.$siteImages?->about_us_image)}});">
                <div class="container">
                    <div class="section-head text-white text-center">
                        <h2 class="text-uppercase">ماذا يقول عملائنا </h2>
                        <span class="title-small">  دائما نسعى للحصول على ثقتكم وهدفنا رضاكم</span>
                        <div class="after-titile-line"></div>
                    </div>
                    <div class="section-content">
                        <div class="testimonial-four owl-carousel owl-dots-none owl-theme">

                            @foreach($testimonials as $comment)
                                <div class="item">
                                    <div class="testimonial-4 style-2">
                                        <div class="testimonial-pic"><img src="{{asset('front/images/avatar.png')}}"
                                                                          width="100" height="100" alt=""></div>
                                        <div class="testimonial-text">
                                            <p>{{$comment->testimonial}} </p>
                                        </div>
                                        <div class="testimonial-detail"><strong
                                                class="testimonial-name">{{$comment->client_name}}</strong> <span
                                                class="testimonial-position">أحد عملائنا</span></div>
                                        <div class="quote-right"></div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <!-- What peolpe are saying END-->
        </div>
        <!-- contact area  END -->
    </div>
    <!-- Content END-->
@endsection
@push('styles')
    <style>

    </style>
@endpush
