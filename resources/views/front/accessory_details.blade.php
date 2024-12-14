@extends('front.layouts.app')
@section('content')
    <!-- inner page banner -->
    <div class="dlab-bnr-inr overlay-black-middle" style="background-image:url({{asset('storage/'.$siteImages?->title_image)}});">
        <div class="container">
            <div class="dlab-bnr-inr-entry">
                <h1 class="text-white">تفاصيل المنتج</h1>
            </div>
        </div>
    </div>
    <!-- inner page banner END -->
    <!-- Breadcrumb row -->
    <div class="breadcrumb-row">
        <div class="container">
            <ul class="list-inline">
                <li><a href="{{route('home.index')}}">الرئيسية</a></li>
                <li>تفاصيل المنتج</li>
            </ul>
        </div>
    </div>
    <!-- Breadcrumb row END -->
    <!-- contact area -->
    <div class="section-full content-inner bg-white">
        <!-- Product details -->
        <div class="container woo-entry">
            <div class="row m-b30">
                <!-- قسم الصور -->
                <div class="col-lg-5 col-md-5">
                    <div class="product-gallery shadow-sm rounded-3 p-3 bg-light">
                        <div class="swiper main-slider mb-3">
                            <div class="swiper-wrapper">
                                @foreach($accessory->images as $image)
                                    <div class="swiper-slide">
                                        <img src="{{ asset('storage/'.$image) }}" alt="{{ $accessory->name }}" class="product-image img-fluid rounded">
                                    </div>
                                @endforeach
                            </div>

                            <!-- أزرار التنقل -->
                            <div class="swiper-button-next small-nav text-primary"></div>
                            <div class="swiper-button-prev small-nav text-primary"></div>
                        </div>

                        <!-- معاينة الصور -->
                        <div class="swiper thumb-slider">
                            <div class="swiper-wrapper">
                                @foreach($accessory->images as $image)
                                    <div class="swiper-slide">
                                        <img src="{{ asset('storage/'.$image) }}" alt="{{ $accessory->name }}" class="thumb-image img-fluid rounded">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <!-- قسم تفاصيل المنتج -->
                <div class="col-lg-7 col-md-7">
                    <div class="product-details  p-4 bg-white rounded shadow-sm">
                        <div class="product-header mb-4">
                            <h2 class="product-title mb-3">{{$accessory->name}}</h2>

                            <div class="d-flex align-items-center mb-3">
                                <h3 class="product-price text-primary ms-1 fw-bold">{{$accessory->discounted_price}} ر.س</h3>
                                @if($accessory->discounted_price < $accessory->price)
                                <span class="text-muted text-decoration-line-through small opacity-75 me-1">{{$accessory->price}} ر.س</span>
                                @endif
                            </div>

                        </div>

                        <div class="product-description mb-4">
                            <div class="description-content">
                                <p class="text-muted">{!! $accessory->description !!}</p>
                            </div>
                        </div>

                        <div class="product-actions">
                            <form class="cart">
                                @csrf
                                <div class="row align-items-center mb-4">
                                    <div class="qty-div">
                                        <label class="d-inline-block qty-label" >اختر الكمية:</label>
                                        <div class="quantity btn-quantity style-1 d-inline-block">
                                            <input id="product-count" type="text" value="1" name="product_count" class="form-control text-center"/>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="accessory_id" value="{{$accessory->id}}">
                                <input type="hidden" name="product_type" value="accessory">
                                <input type="hidden" name="category_id" value="{{$accessory->category_id}}">

                                <div class="cart-div">
                                <button  type="button" class="btn site-button add-to-cart-btn btn-lg">
                                    أضف للسلة <i class="ti-shopping-cart me-2"></i>
                                </button>
                                </div>
                                <div class=" go-to-cart mt-4" style="display: none">
                                    <a class="site-button" href="{{route('home.shop-cart')}}">الذهاب للسلة</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Product details -->
    </div>
    <!-- contact area  END -->
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
                            <p>Not happy with our product, feel free to return it, we will refund 100% your money!</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // سلايدر المصغرات أولاً
            var thumbSwiper = new Swiper('.thumb-slider', {
                spaceBetween: 10,
                slidesPerView: 4,
                watchSlidesProgress: true,
                breakpoints: {
                    320: { slidesPerView: 3 },
                    480: { slidesPerView: 4 },
                    640: { slidesPerView: 4 }
                }
            });

            // سلايدر الصور الرئيسي
            var mainSwiper = new Swiper('.main-slider', {
                loop: true,
                spaceBetween: 10,
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                thumbs: {
                    swiper: thumbSwiper
                }
            });

            // إضافة إمكانية التبديل عند النقر على المصغرات
            var thumbImages = document.querySelectorAll('.thumb-image');
            thumbImages.forEach((thumbImage, index) => {
                thumbImage.addEventListener('click', function() {
                    mainSwiper.slideTo(index);
                });
            });
        });

        $(document).ready(function() {

            // تهيئة TouchSpin
            $("input[name='product_count']").TouchSpin({
                verticalbuttons: true,
                min: 1,
                max: 100,
                booster: false,  // Disable rapid increment/decrement
                mousewheel: false,  // Disable mouse wheel changes
                forcestepdivisibility: 'none'  // Allow any numeric input
            });
        });

    </script>
@endpush
@push('styles')
<style>
    /* Basic Reset & General Styles */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }


    /* Product Gallery Styles */
    .product-gallery {
        max-width: 600px;
        margin: 0 auto;
        transition: all 0.3s ease;
        position: relative;
        z-index: 1;
    }

    /* Main Slider Styles */
    .main-slider {
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        margin-bottom: 15px;
    }

    .swiper-container {
        overflow: hidden;
        position: relative;
        z-index: 1;
    }

    /* Main Product Image */
    .product-image {
        width: 100%;
        height: auto;
        max-height: 400px;
        object-fit: contain;
        background-color: #f8f8f8;
        border-radius: 8px;
    }

    /* Thumbnail Slider */
    .thumb-slider {
        margin-top: 15px;
        padding: 5px;
    }

    .thumb-image {
        width: 100%;
        height: auto;
        max-height: 100px;
        object-fit: cover;
        border-radius: 5px;
        cursor: pointer;
        opacity: 0.6;
        transition: all 0.3s ease;
    }

    /* Thumbnail Active States */
    .thumb-slider .swiper-slide-thumb-active .thumb-image,
    .thumb-image:hover {
        opacity: 1;
        border: 2px solid rgba(0, 123, 255, 0.71);
    }

    /* Navigation Buttons */
    .small-nav {
        width: 25px !important;
        height: 25px !important;
        background-color: rgba(255, 255, 255, 0.9);
        border-radius: 50%;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .small-nav::after {
        font-size: 15px !important;
    }

    .swiper-button-next,
    .swiper-button-prev {
        color: #007bff !important;
    }

    /* Product Details Section */
    .product-details {
        border: 1px solid #e0e0e0;
        position: relative;
        z-index: 2;
        min-height: 400px;
    }

    /* Product Header */
    .product-title {
        font-size: 24px;
        margin-bottom: 15px;
        color: #333;
    }

    .product-price {
        font-size: 22px;
        color: #007bff;
    }

    /* Product Actions */
    .cart-div {
        width: 100%;
    }

    .add-to-cart-btn {
        width: 50%;
        border-radius: 10px;
        margin-right: 25%;
        transition: all 0.3s ease;
    }
    .go-to-cart{
        width: 100%;
    }
    .go-to-cart a {
        width: 50%;
        border-radius: 10px;
        margin-right: 25%;
        transition: all 0.3s ease;
    }

    .qty-div {
        width: 100%;
        margin-right: 25%;
        margin-top:20px;
        margin-bottom: 20px;
    }

    .qty-label {
        padding-left: 10px !important;
        font-weight: 500;
    }

    /* Page Structure Elements */
    .breadcrumb-row {
        position: relative;
        z-index: 3;
        background: #fff;
        border-bottom: 1px solid #eee;
    }

    .dlab-bnr-inr {
        position: relative;
        z-index: 3;
    }

    .section-full {
        position: relative;
        overflow: hidden;
    }

    /* Responsive Design */
    @media (max-width: 991px) {
        .product-details {
            margin-top: 30px;
        }

        .add-to-cart-btn {
            width: 70%;
            margin-right: 15%;
        }
        .go-to-cart a {
            width: 70%;
            margin-right: 15%;
        }
    }

    @media (max-width: 768px) {
        .section-full {
            overflow-x: hidden;
        }

        .container {
            padding-left: 15px;
            padding-right: 15px;
        }

        .row {
            margin-left: -15px;
            margin-right: -15px;
        }

        .product-gallery {
            max-width: 100%;
        }

        .product-image {
            max-height: 350px;
        }

        .product-details {
            position: static !important;
            margin-top: 20px;
            padding: 15px !important;
        }

        .add-to-cart-btn {
            width: 100%;
            margin-right: 0;
        }
        .go-to-cart a{
            width:100%;
            margin-right:0;
        }

        .qty-div {
            margin-right: 0;
        }

        .thumb-image {
            max-height: 80px;
        }

        .product-title {
            font-size: 20px;
            margin-bottom:15px !important;
        }
    }

    @media (max-width: 480px) {
        .product-gallery {
            padding: 0 10px;
        }

        .thumb-slider {
            margin-top: 10px;
        }

        .thumb-image {
            max-height: 60px;
        }

        .product-image {
            max-height: 250px;
        }

        .small-nav {
            width: 20px !important;
            height: 20px !important;
        }

        .small-nav::after {
            font-size: 12px !important;
        }
    }

    /* TouchSpin Custom Styles */
    .bootstrap-touchspin {
        width: 120px !important;
    }

    .bootstrap-touchspin input {
        text-align: center;
        border: 1px solid #ddd;
        height: 35px;
    }

    .bootstrap-touchspin-down,
    .bootstrap-touchspin-up {
        background-color: #f8f9fa;
        border: 1px solid #ddd;
        height: 35px;
        width: 30px;
    }

    /* Product Actions Overlay */
    .product-actions-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.3);
        opacity: 0;
        transition: opacity 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .product-card:hover .product-actions-overlay {
        opacity: 1;
    }

    /* Additional Helper Classes */
    .shadow-hover {
        transition: all 0.3s ease;
    }

    .shadow-hover:hover {
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    /* Fix for Swiper Navigation in RTL */
    [dir="rtl"] .swiper-button-next {
        right: auto;
        left: 10px;
    }

    [dir="rtl"] .swiper-button-prev {
        left: auto;
        right: 10px;
    }
    .product-description {
        word-wrap: break-word;
        overflow-wrap: break-word;
        max-width: 100%;
    }

    .product-description p {
        margin-bottom: 15px;
        line-height: 1.6;
        overflow-wrap: break-word;
        word-wrap: break-word;
        hyphens: auto;
    }


    .related-products-grid .grid-container {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 20px;
    }

    .product-card {
        background: #fff;
        transition: transform 0.3s ease-in-out;
    }

    .product-card:hover {
        transform: scale(1.05);
    }

</style>
@endpush
