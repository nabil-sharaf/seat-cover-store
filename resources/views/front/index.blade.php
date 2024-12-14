@extends('front.layouts.app')
@section('title','الرئيسية')
@section('content')
    <!-- Slider -->
    <div class="main-slider style-two default-banner" dir="ltr">
        <div class="tp-banner-container">
            <div class="tp-banner">
                <div id="rev_slider_1014_1_wrapper" class="rev_slider_wrapper fullscreen-container"
                     data-alias="typewriter-effect" data-source="gallery">
                    <!-- START REVOLUTION SLIDER 5.3.0.2 -->
                    <div id="rev_slider_1014_1" class="rev_slider fullscreenbanner" style="display:none;"
                         data-version="5.3.0.2">
                        <ul>
                            <!-- SLIDE 1 -->
                            @foreach($sliders as $index =>$value)
                                <li data-index="rs-{{$index+1}}000" data-transition="slidingoverlayhorizontal"
                                    data-slotamount="default" data-hideafterloop="0" data-hideslideonmobile="off"
                                    data-easein="default" data-easeout="default" data-masterspeed="default"
                                    data-thumb="{{ asset('storage/' . $value->image) }}"
                                    data-rotate="0" data-saveperformance="off" data-title="Slide" data-param1=""
                                    data-param2="" data-param3="" data-param4="" data-param5="" data-param6=""
                                    data-param7="" data-param8="" data-param9="" data-param10="" data-description="">
                                    <!-- MAIN IMAGE -->
                                    <img src="{{asset('storage/'.$value->image)}}" alt=""
                                         data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat"
                                         class="rev-slidebg" data-no-retina/>
                                    <!-- LAYER NR. 1 [ for overlay ] -->
                                    <div class="tp-caption tp-shape tp-shapewrapper"
                                         id="slide-{{$index+1}}00-layer-1"
                                         data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']"
                                         data-y="['middle','middle','middle','middle']" data-voffset="['0','0','0','0']"
                                         data-width="full"
                                         data-height="full"
                                         data-whitespace="nowrap"
                                         data-type="shape"
                                         data-basealign="slide"
                                         data-responsive_offset="off"
                                         data-responsive="off"
                                         data-frames='[{"from":"opacity:0;","speed":1000,"to":"o:1;","delay":0,"ease":"Power4.easeOut"},{"delay":"wait","speed":1000,"to":"opacity:0;","ease":"Power4.easeOut"}]'
                                         data-textAlign="['left','left','left','left']"
                                         data-paddingtop="[0,0,0,0]"
                                         data-paddingright="[0,0,0,0]"
                                         data-paddingbottom="[0,0,0,0]"
                                         data-paddingleft="[0,0,0,0]"
                                         style="z-index: 12;background-color:rgba(0, 0, 0, 0.20);border-color:rgba(0, 0, 0, 0);border-width:0;">
                                    </div>
                                    <!-- LAYER NR. 2 [ for title ] -->
                                    <div class="tp-caption tp-resizeme"
                                         id="slide-{{$index+2}}00-layer-2"
                                         data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']"
                                         data-y="['top','top','top','top']" data-voffset="['110','110','200','110']"
                                         data-fontsize="['80','80','55','50']"
                                         data-lineheight="['90','90','60','60']"
                                         data-width="['800','800','800','800']"
                                         data-height="['none','none','none','none']"
                                         data-whitespace="['normal','normal','normal','normal']"
                                         data-type="text"
                                         data-responsive_offset="on"
                                         data-frames='[{"from":"y:50px(R);opacity:0;","speed":1500,"to":"o:1;","delay":500,"ease":"Power4.easeOut"},{"delay":"wait","speed":1000,"to":"y:-50px;opacity:0;","ease":"Power2.easeInOut"}]'
                                         data-textAlign="['center','center','center','center']"
                                         data-paddingtop="[0,0,0,0]"
                                         data-paddingright="[0,0,0,0]"
                                         data-paddingbottom="[0,0,0,0]"
                                         data-paddingleft="[0,0,0,0]"
                                         style="z-index: 12;background-color:rgba(0, 0, 0, 0.20);border-color:rgba(0, 0, 0, 0);border-width:0px;">
                                    </div>
                                    <!-- LAYER NR. 2 [ for title ] -->
                                    <div class="tp-caption tp-resizeme"
                                         id="slide-{{$index+1}}00-layer-2"
                                         data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']"
                                         data-y="['top','top','top','top']" data-voffset="['110','110','200','110']"
                                         data-fontsize="['80','80','55','50']"
                                         data-lineheight="['90','90','60','60']"
                                         data-width="['800','800','800','800']"
                                         data-height="['none','none','none','none']"
                                         data-whitespace="['normal','normal','normal','normal']"
                                         data-type="text"
                                         data-responsive_offset="on"
                                         data-frames='[{"from":"y:50px(R);opacity:0;","speed":1500,"to":"o:1;","delay":500,"ease":"Power4.easeOut"},{"delay":"wait","speed":1000,"to":"y:-50px;opacity:0;","ease":"Power2.easeInOut"}]'
                                         data-textAlign="['center','center','center','center']"
                                         data-paddingtop="[40,40,40,40]"
                                         data-paddingright="[0,0,0,0]"
                                         data-paddingbottom="[0,0,0,0]"
                                         data-paddingleft="[0,0,0,0]"
                                         style="z-index: 13;  white-space: normal; text-transform: capitalize; font-size: 70px;  color: rgba(255, 255, 255, 1.00);"> {{$value->title}}
                                    </div>
                                    <!-- LAYER NR. 3 [ for paragraph] -->
                                    <div class="tp-caption tp-resizeme"
                                         id="slide-{{$index+1}}00-layer-3"
                                         data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']"
                                         data-y="['top','top','top','top']" data-voffset="['320','250','340','250']"
                                         data-fontsize="['20','20','18','18']"
                                         data-lineheight="['30','30','30','26']"
                                         data-width="['800','800','800','400']"
                                         data-height="['none','none','none','none']"
                                         data-whitespace="['normal','normal','normal','normal']"
                                         data-type="text"
                                         data-responsive_offset="on"
                                         data-frames='[
										{"from":"y:50px(R);opacity:0;","speed":1500,"to":"o:1;","delay":500,"ease":"Power4.easeOut"},
										{"delay":"wait","speed":1000,"to":"y:-50px;opacity:0;","ease":"Power2.easeInOut"}]'
                                         data-textAlign="['center','center','center','center']"
                                         data-paddingtop="[0,0,0,0]"
                                         data-paddingright="[0,0,0,0]"
                                         data-paddingbottom="[30,30,30,30]"
                                         data-paddingleft="[0,0,0,0]"
                                         style="z-index: 13; font-weight: 500; color: rgba(255, 255, 255, 0.85); border-width:0px;">
                                        <span style="padding-bottom: 20px"> {{$value->description}}</span>
                                    </div>
                                    <!-- LAYER NR. 4 [ for readmore botton ] -->
                                    <div class="tp-caption tp-resizeme"
                                         id="slide-{{$index+1}}00-layer-4"
                                         data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']"
                                         data-y="['top','top','top','top']" data-voffset="['380','370','390','330']"
                                         data-fontsize="['none','none','none','none']"
                                         data-lineheight="['none','none','none','none']"
                                         data-width="['700','700','700','700']"
                                         data-height="['none','none','none','none']"
                                         data-whitespace="['normal','normal','normal','normal']"
                                         data-type="text"
                                         data-responsive_offset="on"
                                         data-frames='[
										{"from":"y:50px(R);opacity:0;","speed":1500,"to":"o:1;","delay":500,"ease":"Power4.easeOut"},
										{"delay":"wait","speed":1000,"to":"y:-50px;opacity:0;","ease":"Power2.easeInOut"}]'
                                         data-textAlign="['center','center','center','center']"
                                         data-paddingtop="[0,0,0,0]"
                                         data-paddingright="[0,0,0,0]"
                                         data-paddingbottom="[0,0,0,0]"
                                         data-paddingleft="[0,0,0,0]"
                                         style="z-index: 13; margin-top: 20px"><a href="{{$value->button_link}}"
                                                                                  class="site-button button-md radius-no">{{$value->button_text}}</a>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                        <div class="tp-bannertimer tp-bottom" style="visibility: hidden !important;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Slider END -->

    <!-- About US -->
    <div class="section-full about-box content-inner">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 m-b30 p-r50">
                    <div class="section-head text-left">
                        <p>{!! \App\Models\Admin\Setting::getValue('about_us') !!}</p>
                    </div>
                    <a href="{{route('home.about')}}" class="site-button button-md radius-no">المزيد</a>
                </div>
                <div class="col-lg-6 m-b30">
                    <div class="video-box">
                        <img src="{{asset('storage/'.$siteImages->about_thumb)}}" alt="">
                        <div class="video-play">
                            <a href="{{\App\Models\Admin\Setting::getValue('about_video')}}"
                               class="popup-youtube gradient-shadow bg-gradient video"><i class="fas fa-play"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About US End -->

    <!-- Our Products -->
    <div class="section-full bg-gray content-inner" id="our-products">
        <div class="container">
            <div class="section-head text-center" >
                <h2 class="text-uppercase"> تعرف على <span class="text-primary"> منتجاتنا   </span></h2>
                <p>منتجاتنا ذات جودة ومتانة عالية ومطابقة لمواصفات الهيئة السعودية للمواصفات والجودة  </p>
            </div>
            <div class="row our-products-row text-center" >
                @foreach($categories as $product)
                    @if($product->parent_id)
                        <div class="col-lg-4 col-md-6 col-sm-12 m-b30">
                            <div class="service-style2">
                                <div class="dlab-media">
                                    <img src="{{asset('storage/'.$product->image)}}" alt="" style="height: 360px;">
                                </div>
                                <div class="icon-content">
                                    <h3 class="dlab-tilte m-b15"><a
                                            href="{{route('home.category.products',$product->id)}}">{{$product->name}}</a>
                                    </h3>
                                    <p class="m-b10">{!! $product->description !!}</p>
                                    <a href="{{route('home.category.products',$product->id)}}" class="site-button">
                                        اطلب الآن</a>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
                @foreach($categories as $product)
                    @if($product->product_type=='accessory' )
                        <div class="col-lg-4 col-md-6 col-sm-12 m-b30">
                            <div class="service-style2">
                                <div class="dlab-media">
                                    <img src="{{asset('storage/'.$product->image)}}" alt="" style="height: 360px;">
                                </div>
                                <div class="icon-content">
                                    <h3 class="dlab-tilte m-b15"><a
                                            href="{{route('home.category.products',$product->id)}}">{{$product->name}}</a>
                                    </h3>
                                    <p class="m-b10">{!! $product->description !!}</p>
                                    <a href="{{route('home.category.products',$product->id)}}" class="site-button">
                                        اطلب الآن</a>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
           </div>
        </div>
    </div>
    <!-- Our Services End -->

    <!-- Our Branches -->
    <div class="section-full content-inner branch-section">
        <div class="container">
            <div class="section-head text-center">
                <h2 class="text-uppercase">تعرف على <span class="text-primary"> فروعنا</span></h2>
                <p>يوجد لدينا فروع في كل انحاء المملكة السعودية </p>
            </div>
                <span style="font-size: 16px">{{\App\Models\Admin\Setting::getValue('branches_desc')}}</span>
            <div class="text-center mt-2">
                <a class="site-button " href="{{route('home.branches')}}"> تفاصيل الفروع</a>
            </div>
        </div>
    </div>
    <!-- Branches End -->

    <!-- What Clients Says -->
    <div class="section-full content-inner" style="background-image: url({{asset('front/images/pattern.png')}});">
        <div class="container">
            <div class="section-head text-center">
                <h2 class="text-uppercase">ماذا يقول <span class="text-primary">عملاؤنا </span></h2>
                <p>نسعد بثقتكم ونتمنى تقديم الأفضل دائما من أجلكم </p>
            </div>
            <div class="row">
                <div class="col-lg-6 d-flex m-b30">
                    <div class="testimonial-one align-self-center testimonial-style8 owl-carousel owl-theme">
                        @foreach($testimonials as $comment)
                            <div class="item">
                                <div class="testimonial-8">
                                    <div class="testimonial-text quote-left">
                                        <p>{{$comment->testimonial}}</p>
                                    </div>
                                    <ul class="rating-list list-inline">
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                    </ul>
                                    <div class="testimonial-detail clearfix">
                                        <h4 class="testimonial-name m-tb0"> {{$comment->client_name}}</h4>
                                        <span class="testimonial-position">Customer</span>
                                        <div class="testimonial-pic"><img src="{{asset('front')}}/images/avatar.png"
                                                                          alt="" width="100" height="100"></div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-lg-6 testimonial-thumb m-b30">
                    <img src="{{asset('front')}}/images/comments.jpg" alt="480*430">
                </div>
            </div>
        </div>
    </div>
    <!-- What Clients Says End -->
@endsection


@push('styles')
    <style>
    .branch-section {
        background-image: url({{asset('front/images/pattern/pt4.jpg')}});
        background-color: rgba(255, 255, 255, .94);
        background-blend-mode: overlay;
        padding-top: 30px;
        padding-bottom: 20px;
        margin-bottom: 10px;
        border: 10px dotted #cccccc2e;
    }
    .our-products-row{
        flex-wrap: wrap;
        justify-content: flex-start;
    }
    .our-products-row:last-child {
        /*justify-content: center; !* محاذاة العناصر في المنتصف للصف الأخير *!*/
    }
    </style>
@endpush
