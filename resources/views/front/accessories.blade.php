@extends('front.layouts.app')
@section('content')
    <!-- Content -->
    <div class="page-content bg-white">
        <!-- inner page banner -->
        <div class="dlab-bnr-inr overlay-black-middle"
             style="background-image:url({{asset('storage/'.$siteImages?->title_image)}});">
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
                        <div class=" col-6 col-lg-3 col-md-4 col-sm-6 mb-4">
                            <div class="item-box m-b10">
                                <div class="item-img">
                                    <img src="{{ asset('storage/' . ($accessory->images ? $accessory->images[0] : '')) }}" alt=""/>
                                    @if($accessory->discount)
                                        <div class="discount-badge">
                                            خصم
                                        </div>
                                    @endif

                                    <div class="item-info-in">
                                        <ul>
                                            <li>
                                                <form class="add-to-cart-form">
                                                    @csrf
                                                    <input type="hidden" name="accessory_id" value="{{$accessory->id}}">
                                                    <input type="hidden" name="product_type" value="accessory">
                                                    <input type="hidden" name="category_id" value="{{$accessory->category_id}}">
                                                    <input type="hidden" name="product_count" value="1">
                                                    <button type="button" class="add-to-cart-btn">
                                                        <i class="ti-shopping-cart"></i>
                                                    </button>
                                                </form>
                                            </li>

                                            <li><a href="{{route('accessory.details',$accessory->id)}}" class="product-show-link  text-black"><i class="ti-eye"></i></a></li>
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
    </div>
    <!-- Content END-->
@endsection
@push('styles')
    <style>

        .row-equal-height {
            display: flex;
            flex-wrap: wrap;
        }

        .item-box {
            height: 100%;
            border: 1px solid #ddd;
            border-radius: 8px;
            transition: all 0.3s ease;
            overflow: hidden;
            background: #fff;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .item-img {
            overflow: hidden;
            position: relative;
        }

        .item-img img {
            object-fit: contain;
            aspect-ratio: 1;
            transition: transform 0.3s ease;
        }

        .item-box:hover .item-img img {
            transform: scale(1.05);
        }

        .item-title {
            margin: 0;
            line-height: 1.4;
            font-size: 0.95rem;
        }

        .item-title a {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
            color: #333;
            text-decoration: none;
        }

        .item-price {
            font-size: 1rem;
            margin: 0;
        }

        .old-price {
            color: #020202;
            font-size: 0.9em;
            background-color: #ffe6e6;
            padding: 2px 4px;
            border-radius: 4px;
            margin-left: 8px;
            text-decoration: line-through;
        }

        .discount-badge {
            position: absolute;
            top: 5px;
            right: 5px;
            background: #ff4444;
            color: white;
            padding: 4px 8px;
            border-radius: 5px;
            font-size: 0.8rem;
            font-weight: bold;
            z-index: 10;
        }

        .item-info-in {
            position: absolute;
            bottom: -50px;
            left: 0;
            right: 0;
            text-align: center;
            background: rgba(255,255,255,0.9);
            padding: 8px;
            transition: bottom 0.3s ease;
        }

        .item-box:hover .item-info-in {
            bottom: 0;
        }

        .item-info-in ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            justify-content: center;
            gap: 10px;
        }

        .add-to-cart-btn,
        .item-info-in a {
            background: none;
            border: none;
            color: #333;
            padding: 5px;
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .add-to-cart-btn:hover,
        .item-info-in a:hover {
            color: #007bff;
        }

        .product-show-link:hover{
            color:dodgerblue !important;
        }

        @media (max-width: 767px) {
            .container {
                padding: 0 10px;
            }

            .item-title {
                font-size: 0.85rem;
            }

            .item-price {
                font-size: 0.9rem;
            }

            .old-price {
                font-size: 0.8em;
            }

            .discount-badge {
                font-size: 0.7rem;
                padding: 3px 6px;
            }
        }
    </style>
@endpush
