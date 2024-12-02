@extends('front.layouts.app')
@section('content')
    <!-- Content -->
    <div class="page-content bg-white">
        <!-- inner page banner -->
        <div class="dlab-bnr-inr overlay-black-middle"
             style="background-image:url({{asset('storage/'.$siteImages?->about_us_image)}});">
            <div class="container">
                <div class="dlab-bnr-inr-entry">
                    <h1 class="text-white">تسوق منتجاتنا </h1>
                </div>
            </div>
        </div>
        <!-- inner page banner END -->
        <!-- Breadcrumb row -->
        <div class="breadcrumb-row">
            <div class="container">
                <ul class="list-inline">
                    <li><a href="{{route('home.index')}}">الرئيسية</a></li>
                    <li>الاكسسوارات</li>
                </ul>
            </div>
        </div>
        <!-- Breadcrumb row END -->
        <!-- contact area -->
        <div class="section-full content-inner">
            <!-- Product -->
            <div class="container">
                <div class="row">
                    @forelse($accessories as $accessory)
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="item-box m-b10">
                                <div class="item-img">
                                    <img src="{{ asset('storage/' . $accessory->images[0]) }}" alt=""/>
                                    @if($accessory->discount)
                                    <div class="discount-badge">
                                        خصم
                                    </div>
                                    @endif

                                    <div class="item-info-in">
                                        <ul>
                                            <li><a href="#"><i class="ti-shopping-cart"></i></a></li>
                                            <li><a href="#"><i class="ti-eye"></i></a></li>
{{--                                            <li><a href="#"><i class="ti-heart"></i></a></li>--}}
                                        </ul>
                                    </div>
                                </div>
                                <div class="item-info text-center text-black p-a10">
                                    <h6 class="item-title"><a href="{{route('accessory.details',$accessory->id)}}">{{$accessory->name}}</a></h6>
                                    <h4 class="item-price">
                                        @if($accessory->discount)
                                        <del style="color: #020202; font-size: 1em; background-color: #ffe6e6; padding: 2px 1px; border-radius: 2px; margin-left: 8px;">
                                            {{ number_format($accessory->price, 2) }}
                                        </del>
                                        @endif
                                        <span class="text-primary">{{ number_format($accessory->discounted_price, 2) }} ر.س</span></h4>
                                </div>
                            </div>
                        </div>
                    @empty
                        لا توجد منتجات حاليا
                    @endforelse
                </div>
            </div>
            <!-- Product END -->
        </div>
        <div class="section-full p-t50 p-b20 bg-gray">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-lg-4">
                        <div class="icon-bx-wraper left m-b30">
                            <div class="icon-md text-black radius">
                                <a href="#" class="icon-cell text-black"><i class="fas fa-gift"></i></a>
                            </div>
                            <div class="icon-content">
                                <h5 class="dlab-tilte">Free shipping on orders $60+</h5>
                                <p>Order more than 60$ and you will get free shippining Worldwide. More info.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-4">
                        <div class="icon-bx-wraper left m-b30">
                            <div class="icon-md text-black radius">
                                <a href="#" class="icon-cell text-black"><i class="fas fa-plane"></i></a>
                            </div>
                            <div class="icon-content">
                                <h5 class="dlab-tilte">Worldwide delivery</h5>
                                <p>We deliver to the following countries: USA, Canada, Europe, Australia</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-4">
                        <div class="icon-bx-wraper left m-b30">
                            <div class="icon-md text-black radius">
                                <a href="#" class="icon-cell text-black"><i class="fas fa-history"></i></a>
                            </div>
                            <div class="icon-content">
                                <h5 class="dlab-tilte">60 days money back guranty!</h5>
                                <p>Not happy with our product, feel free to return it, we will refund 100% your
                                    money!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Content END-->
@endsection
@push('styles')
    <style>
        .discount-badge {
            position: absolute;
            top: 0;
            right: 0;
            background-color: #ff4d4f;
            color: #ffffff;
            padding: 3px 10px;
            font-size: 0.8em;
            font-weight: bold;
            border-radius: 3px;
            z-index: 10;
        }
    </style>
@endpush
