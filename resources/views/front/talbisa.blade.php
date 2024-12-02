@extends('front.layouts.app')
@section('content')
    <!-- inner page banner -->
    <div class="dlab-bnr-inr overlay-black-middle" style="background-image:url(images/background/bg4.jpg);">
        <div class="container">
            <div class="dlab-bnr-inr-entry">
                <h1 class="text-white">Product Details</h1>
            </div>
        </div>
    </div>
    <!-- inner page banner END -->

    <!-- Breadcrumb row -->
    <div class="breadcrumb-row">
        <div class="container">
            <ul class="list-inline">
                <li><a href="{{route('home.index')}}">الرئيسية</a></li>
                <li>تلبيسة</li>
            </ul>
        </div>
    </div>
    <!-- Breadcrumb row END -->
    <!-- contact area -->
    <div class="section-full content-inner bg-white">
        <!-- Product details -->
        <div class="container woo-entry">
            <div class="row m-b30">
                <div class="product-container">
                    <div class="product-layout">
                        <!-- Product Image Section -->
                        <div class="product-image">
                            <div class="circular-frame">
                                <img id="main-product-image" src="{{asset('storage/'.$siteImages->about_us_image)}}"
                                     alt="Product Image">
                                <div class="overlay-circle"></div>
                            </div>
                        </div>
                        <!-- Product Details Section -->
                        <div class="product-details">
                            <div class="details-card">
                                <h3 class="product-name-title"> تلبيسة الدياموند</h3>
                                <p class="car-selection-title">اختر لون التلبيسة:</p>
                                <div class="products-grid">
                                    @foreach($colors as $color)
                                        <div class="product-item">
                                            <label class="color-label">
                                                <input type="radio" name="cover_color" value="{{$color->id}}"
                                                       class="color-radio" style="display: none;">
                                                <div class="product-image">
                                                    <img src="{{ asset('storage/'.$color->image) }}"
                                                         alt="{{$color->name}}"/>
                                                </div>
                                                <div
                                                    class="product-title">{{$color->name.' '.$color->tatriz_color}}</div>
                                            </label>
                                        </div>
                                    @endforeach
                                </div>


                                <div class="car-selection">
                                    <p class="car-selection-title">اختر نوع السيارة : </p>
                                    <div class="products-grid">
                                        @foreach($seatCounts as $seat)
                                            <div class="product-item car-selection-item">
                                                <label class="car-label">
                                                    <input type="radio" name="seat_count" value="{{$seat->id}}"
                                                           class="car-radio"
                                                           style="display: none;">
                                                    <div class="product-image">
                                                        <img src="{{ asset('storage/'.$seat->image) }}"
                                                             alt="{{$seat->name}}">
                                                    </div>
                                                    <div class="product-title">{{$seat->name}}</div>
                                                    <span class=" price-text text-muted ">{{$seat->seatPrice($category->id)}} ر.س</span>
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <!-- New Section for Select Inputs -->
                                <div class="car-details">
                                    <p class="car-selection-title fw-bold mb-3 text-decoration-underline">تفاصيل
                                        السيارة: </p>

                                    <!-- Car Brand -->
                                    <div class="form-group">
                                        <label for="car-brand" class="form-label fw-bold">براند السيارة</label>
                                        <select id="car-brand" name="car_brand" class="form-control">
                                            <option value="" disabled selected>اختر البراند</option>
                                            @foreach($car_brands as $brand)
                                            <option value="{{$brand->id}}">{{$brand->brand_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Car Model -->
                                    <div class="form-group">
                                        <label for="car-model" class="form-label fw-bold">موديل السيارة</label>
                                        <select id="car-model" name="car_model" class="form-control">
                                            <option value="" disabled selected>اختر الموديل</option>
                                        </select>
                                    </div>

                                    <!-- Manufaturing Year -->
                                    <div class="form-group">
                                        <label for="made-year" class="form-label fw-bold">تاريخ الصنع</label>
                                        <select id="made-year" name="made_year" class="form-control">
                                            <option value="" disabled selected>اختر سنة الصنع</option>
                                            @for ($year = 2000; $year <= now()->year; $year++)
                                                <option value="{{ $year }}">{{ $year }}</option>
                                            @endfor
                                        </select>
                                    </div>

                                    <!-- Bag Option -->
                                    <div class="form-group">
                                        <label for="bag-option" class="form-label fw-bold">بشنطة أو بدون</label>
                                        <select id="bag-option" name="bag_option" class="form-control">
                                            <option value="" disabled selected>هل المنتج بشنطة</option>
                                            <option value="0">بدون شنطة</option>
                                            <option class="bag-option-price" value="1">بشنطة</option>
                                        </select>
                                    </div>

                                    <!-- Quantity -->
                                    <div class="form-group">
                                        <label for="product-count" class="form-label fw-bold"> العدد المطلوب </label>
                                        <input type="number" class="form-control product-count"
                                               name="product_count" value="1" min="1" step="1"/>
                                    </div>
                                </div>

                            </div>
                            <button class="add-to-cart-btn">أضف للسلة</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    </div>

@endsection

@push('styles')
    <style>
        /* تحسينات عامة للتخطيط */
        .container.woo-entry {
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px 15px;
            background-color: #f9f9f9;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .product-layout {
            display: flex;
            gap: 40px;
            align-items: stretch;
            direction: rtl;
        }

        .product-image,
        .product-details {
            flex: 1;
        }

        /* تحسينات صورة المنتج */
        .circular-frame {
            position: relative;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .circular-frame:hover {
            transform: scale(1.01);
        }

        .circular-frame img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        /* تحسينات شبكة المنتجات */
        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
            gap: 8px;
            padding: 10px 0;
        }

        .product-item {
            position: relative;
            background-color: white;
            border-radius: 10px;
            padding: 3px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.08);
        }

        .product-item img:hover {
            transform: scale(1.08);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        }


        .add-to-cart-btn {
            display: block;
            width: 100%;
            padding: 12px;
            background-color: #f4c430;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .add-to-cart-btn:hover {
            background-color: #e6b71e;
            transform: scale(1.02);
        }

        /* تحسينات العناوين والنصوص */
        .product-name-title {
            text-align: center;
            color: #333;
            font-size: 24px;
            margin-bottom: 20px;
            font-family: Cairo, sans-serif;
        }

        .product-title {
            font-size: 11px;
            color: #666;
            margin-top: 2px;
            margin-bottom: 0;
            text-align: center;
        }

        /* تحسينات النقاط الزخرفية */
        .dots-decoration {
            position: absolute;
            top: 10px;
            right: 10px;
            display: flex;
            gap: 4px;
        }

        .dot {
            width: 6px;
            height: 6px;
            background-color: #f4c430;
            border-radius: 50%;
            opacity: 0.7;
        }

        /* استجابة الشاشات */
        @media (max-width: 992px) {
            .product-layout {
                flex-direction: column;
                gap: 20px;
            }
        }


        .car-selection {
            margin-top: 10px;
        }

        .car-selection-title {
            margin-bottom: 0;
            margin-top: 40px;
            font-size: 14px;
        }


        .car-label {
            display: inline-block;
            cursor: pointer;
            border: 2px solid transparent; /* البوردر الافتراضي */
            border-radius: 10px; /* لإضافة زوايا دائرية */
            margin-bottom: 0;
        }

        .car-radio:checked + .product-image {
            border: 1px solid rgba(0, 123, 255, 0.99); /* لون البوردر عند التحديد */
            border-radius: 10px;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.1); /* تأثير ظل */
        }

        /* لإضافة تأثير على النص أيضًا */
        .car-label input.car-radio:checked ~ .product-title {
            color: #007bff;
        }

        .car-label input.car-radio:checked ~ .price-text {
            color: #007bff !important;
            font-weight: bold;
        }

        .color-label {
            display: inline-block;
            cursor: pointer;
            border: 2px solid transparent; /* البوردر الافتراضي */
            border-radius: 10px; /* لإضافة زوايا دائرية */
            margin-bottom: 0;
        }

        /*.color-label .product-image{*/
        /*    display: flex;*/
        /*    flex-direction: column;*/
        /*    align-items: center;*/
        /*}*/

        /*.color-label .product-image img {*/
        /*    object-fit: cover;*/
        /*}*/

        .color-radio:checked + .product-image {
            border: 1px solid rgba(0, 123, 255, .99); /* لون البوردر عند التحديد */
            border-radius: 10px;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.1); /* تأثير ظل */
        }

        .color-radio:checked ~ .product-title {
            color: #007bff; /* لون النص عند التحديد */
        }

        .car-details .form-group {
            display: flex;
            align-items: center; /* محاذاة رأسية متوسطة بين الـ label والـ input */
            margin-bottom: 15px; /* مسافة بين الحقول */
        }

        .form-label {
            width: 25%; /* عرض ثابت أو نسبي للـ label */
            font-size: 13px;
        }

        .form-control {
            width: 75%; /* عرض ثابت أو نسبي للـ input */
            padding: 8px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .form-group input.product-count {
            width: 100%
        }

        .price-text {
            font-size: 12px;
            display: inline-block;
            text-align: center !important;
            width:100%
        }
    </style>
@endpush
@push('scripts')
    <script>
        // تحديد كل الأزرار داخل color-label
        document.querySelectorAll('.color-label .product-image img').forEach((img) => {
            img.addEventListener('click', function () {
                // تحديث صورة المنتج الرئيسية عند الضغط على الصورة
                document.getElementById('main-product-image').src = img.src;
            });
        });
    </script>

@endpush
