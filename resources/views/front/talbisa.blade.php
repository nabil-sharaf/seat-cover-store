@extends('front.layouts.app')
@section('content')
    <!-- inner page banner -->
    <div class="dlab-bnr-inr overlay-black-middle" style="background-image:url({{asset('storage/'.$siteImages?->title_image)}});">
        <div class="container">
            <div class="dlab-bnr-inr-entry">
                <h1 class="text-white">{{$category->name}}</h1>
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
                                <img id="main-product-image" src="{{asset('storage/'.$category->image)}}"
                                     alt="Product Image">
                                <div class="overlay-circle"></div>
                            </div>
                        </div>
                        <!-- Product Details Section -->
                        <div class="product-details">
                            <form id="order-form" method="post">
                                @csrf
                                <div class="details-card">
                                    <h3 class="product-name-title"> {{$category->name}} </h3>
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
                                                        <input type="radio" name="seat_count"
                                                               value="{{$seat->id}}"
                                                               data-talbisa-price="{{$seat->seatPrice($category->id)}}"
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
                                        <p class=" car-details-title car-selection-title fw-bold mb-3 text-decoration-underline"
                                           style="display:none">
                                            تفاصيل
                                            السيارة: </p>

                                        <!-- Car Brand -->
                                        <div class="form-group" style="display:none" id="car-brand-div">
                                            <label for="car-brand" class="form-label fw-bold">براند السيارة</label>
                                            <select id="car-brand" name="car_brand" class="form-control select2">
                                                <option value="" disabled selected>اختر البراند</option>
                                            </select>
                                        </div>

                                        <!-- Car Model -->
                                        <div class="form-group" style="display:none" id="car-model-div">
                                            <label for="car-model" class="form-label fw-bold">موديل السيارة</label>
                                            <select id="car-model" name="car_model" class="form-control select2">
                                                <option value="" disabled selected>اختر الموديل</option>
                                            </select>
                                        </div>

                                        <!-- Manufaturing Year -->
                                        <div class="form-group" style="display:none" id="made-year-div">
                                            <label for="made-year" class="form-label fw-bold">تاريخ الصنع</label>
                                            <select id="made-year" name="made_year" class="form-control select2">
                                                <option value="" disabled selected>اختر سنة الصنع</option>
                                            </select>
                                        </div>

                                        <!-- Bag Option -->
                                        <div class="form-group" style="display:none" id="bag-option-div">
                                            <label for="bag-option" class="form-label fw-bold">بشنطة أو بدون</label>
                                            <select id="bag-option" name="bag_option" class="form-control select2">
                                                <option data-bag-price="0" value="" disabled selected>هل المنتج بشنطة
                                                </option>
                                                <option data-bag-price="0" value="0">بدون شنطة</option>
                                                <option data-bag-price="{{$category->bagOption?->bag_price}}"
                                                        class="bag-option-price" value="1"> بشنطة
                                                    - {{$category->bagOption?->bag_price }} ر.س
                                                </option>
                                            </select>
                                        </div>

                                        <input id="category-id" type="hidden" name="category_id"
                                               value="{{$category->id}}"/>
                                        <input id="parent-id" type="hidden" name="parent_id" value="{{$category->parent_id}}"/>
                                        <input id="product-type" type="hidden" name="product_type" value="{{$category->product_type}}"/>
                                        <input id="tax-rate" type="hidden" name="tax_rate"
                                               value="{{\App\Models\Admin\Setting::getValue('tax_rate')}}"/>

                                        <!-- Total Price Section -->
                                        <div class="price-summary mb-4 mt-4">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="fw-bold">الإجمالي:</span>
                                                <span id="total-price" class="text-primary fs-5">--</span>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center mt-2">
                                                <span class="fw-bold">الإجمالي  بالقيمة المضافة:</span>
                                                <span id="final-price" class="text-success fs-5"> --</span>
                                            </div>
                                        </div>

                                        <!-- Quantity -->
                                        <div class="form-group cart-group">
                                            <label for="product-count" class="form-label fw-bold"> العدد
                                                المطلوب </label>
                                            <input id="product-count" type="number" class="form-control product-count"
                                                   name="product_count" value="1" min="1" step="1"/>
                                            <button id="add-to-cart" class="add-to-cart-btn " type="button">أضف للسلة <i
                                                    class="fas fa-shopping-cart "></i></button>
                                        </div>

                                        <div class="text-center go-to-cart" style="display: none">
                                           <a class="site-button" href="{{route('home.shop-cart')}}">الذهاب للسلة</a>
                                        </div>

                                    </div>
                                </div>
                            </form>
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
            width: 30%;
            padding: 9px;
            background-color: #b48800;
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
            margin-bottom: 30px; /* مسافة بين الحقول */
        }

        .form-label {
            width: 25%; /* عرض ثابت أو نسبي للـ label */
            font-size: 13px;
            margin-bottom: 0 !important;
        }

        .form-control {
            width: 75%; /* عرض ثابت أو نسبي للـ input */
            padding: 8px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .form-group input.product-count {
            width: 75%;
            background-color: #e9e9e900;
        }

        .price-text {
            font-size: 12px;
            display: inline-block;
            text-align: center !important;
            width: 100%
        }

        .car-details-title {
            margin-bottom: 27px !important;
        }

        .cart-group {
            gap: 10px;
            width: 100%
        }

        .price-summary {
            padding: 10px;
            background-color: #f8f9fa;
            border: 1px solid #e0e0e0;
            border-radius: 5px;
        }

        .price-summary .text-primary {
            color: #007bff;
        }

        .price-summary .text-success {
            color: #28a745;
        }

        @media (max-width: 568px) {
            .add-to-cart-btn{
                width:60%
            }
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

        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('input[name=seat_count]').on('change', function () {

                let seatCountId = $('input[name=seat_count]:checked').val();
                if (seatCountId) {
                    $('#car-brand-div ,.car-details-title').show();
                    $('#car-model-div,#made-year-div,#bag-option-div').hide();
                    $('#car-model,#made-year,#bag-option').val('').trigger('change');
                    $.ajax({
                        url: "{{route('get-brands')}}",
                        data: {
                            seat_count_id: seatCountId,
                        },
                        success: function (response) {
                            let brandSelect = $('#car-brand');
                            brandSelect.empty();
                            if (response.length > 0) {
                                brandSelect.append('<option value="" selected disabled>اختر براند السيارة</option>');
                                $.each(response, function (key, brand) {
                                    brandSelect.append('<option value="' + brand.id + '">' + brand.brand_name + '</option>');
                                });
                            }
                        },
                        error: function (xhr) {
                            console.log(xhr);
                        },
                    });
                }
                calculateTotalPrice();
            })

            $('#car-brand').on('change', function () {
                let brandId = $(this).val();
                let seatCountId = $("input[name=seat_count]:checked").val();
                if (brandId && seatCountId) {
                    $('#car-model-div').show();
                    $.ajax({
                            url: "{{route('get-car-models')}}",
                            type: 'GET',
                            data: {
                                brand_id: brandId,
                                seat_count_id: seatCountId,
                            },
                            success: function (response) {
                                let $modelSelect = $('#car-model');
                                $modelSelect.empty();
                                if (response.length > 0) {
                                    $modelSelect.append('<option value="" selected disabled>اختر موديل السيارة</option>');
                                    $.each(response, function (key, model) {
                                        $modelSelect.append('<option value="' + model.id + '">' + model.model_name + '</option>');
                                    });
                                }
                            },
                            error: function (xhr) {
                                console.log(xhr);
                            },
                        }
                    );
                }
            });

            $('#car-model').on('change', function () {
                let modelId = $(this).val();
                let productType = $('#product-type').val();
                if (modelId) {
                    $('#made-year-div').show();
                    if (productType === 'earth') {
                        $('#bag-option-div').show();
                    }
                    $.ajax({
                            url: "{{route('get-made-years')}}",
                            type: 'GET',
                            data: {
                                model_id: modelId,
                            },
                            success: function (response) {
                                let $years = $('#made-year');
                                $years.empty();
                                if (response && response.made_year_from && response.made_year_to) {
                                    $years.append('<option value="" disabled>اختر سنة الصنع</option>');
                                    $years.append('<option value="' + response.made_year_from + '-' + response.made_year_to + '">' + response.made_year_from + '-' + response.made_year_to + '</option>');
                                } else {
                                    console.log('response error');
                                }
                            },
                            error: function (xhr) {
                                console.log(xhr);
                            },
                        }
                    );
                }
            });

            $('#bag-option').on('change', function () {
                calculateTotalPrice();
            });

            $('#product-count').on('change', function () {
                calculateTotalPrice();
            })

// الإضافة للسلة

        })
        function calculateTotalPrice() {
            const talbisaPrice = parseFloat($('input[name=seat_count]:checked').data('talbisa-price')) || 0;
            const bagPrice = parseFloat($('#bag-option option:selected').data('bag-price')) || 0;
            const quantity = parseInt($('#product-count').val()) || 1;
            const taxRate = parseFloat($('#tax-rate').val()) / 100 || 0;

            let totalPrice = 0;
            let finalTotal = 0;

            if (talbisaPrice > 0) {
                totalPrice = (talbisaPrice + bagPrice) * quantity;
                finalTotal = (taxRate * totalPrice) + totalPrice;
                // تحديث النصوص
                $('#total-price').text(totalPrice.toFixed(2) + ' ر.س');
                $('#final-price').text(finalTotal.toFixed(2) + ' ر.س');
            } else {
                $('#total-price').text('--');
                $('#final-price').text('--');
            }
        }

    </script>

@endpush
