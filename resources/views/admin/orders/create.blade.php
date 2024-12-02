@extends('admin.layouts.app')

@section('page-title')
    الطلبات
@endsection

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger pt-2 pb-0">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title " style="float:none">إضافة طلب جديد</h3>
        </div>
        <form id="orderForm" novalidate dir="rtl">
            @csrf
            <div class="card-body">
                <div id="productFormsContainer">
                    <div class="row g-4">
                        <!-- User Selection (Hidden) -->
                        <div class="col-md-12 mb-4" style="display:block">
                            <label for="inputUser" class="form-label fw-bold">اختر العميل</label>
                            <select id="inputUser" class="form-select custom-select select2" name="user_id">
                                <option value="" data-user-type="">زائر - Guest</option>
                                @foreach($users as $user)
                                    @if($user->status)
                                        <option value="{{ $user->id }}">
                                            {{ $user->name  }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="product-form border p-4 mb-4">
                        <div class="row g-4">
                            <!-- Product Category -->
                            <div class="col-md-4">
                                <label for="product_category" class="form-label fw-bold">النوع </label>
                                <select name="product_category[]" class="form-select custom-select product-category">
                                    <option value="" disabled selected>اختر قسم المنتج</option>
                                    @foreach($categories as $cat)
                                        @if(!$cat->parent_id)
                                            <option data-product-type="{{$cat->product_type}}"
                                                    value="{{$cat->id}}">{{$cat->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <!-- Product_type Input  -->
                            <input type="hidden" id="" name="product_type[]" class="product-type-input" value="">

                            <!--  product-select -->
                            <div class="col-md-4 product-select-div" style="display: none">
                                <label for="product-select" class="form-label fw-bold">المنتج </label>
                                <select name="products[]" class="form-select custom-select product-select" disabled>
                                    <option value="">اختر المنتج</option>
                                </select>
                            </div>

                            <!-- Cover Color -->
                            <div class="col-md-4" style="display: none">
                                <label for="cover_color" class="form-label fw-bold">المنتج </label>
                                <select name="cover_color[]" class="form-select custom-select cover-color" disabled>
                                    <option value="" disabled>اختر المنتج أو لون المنتج</option>

                                </select>
                            </div>

                            <!-- Seat Count -->
                            <div class="col-md-4" style="display: none">
                                <label for="seat_count" class="form-label fw-bold">عدد المقاعد</label>
                                <select name="seat_count[]" class="form-select custom-select seat-count" disabled>
                                    <option value="" disabled selected>اختر عدد المقاعد</option>
                                    @foreach($seatCounts as $count)
                                        <option value="{{$count->id}}">{{$count->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Car Brand -->
                            <div class="col-md-4" style="display: none">
                                <label for="car_brand" class="form-label fw-bold">براند السيارة</label>
                                <select name="car_brand[]" class="form-select custom-select car-brand" disabled>
                                    <option value="" disabled selected>اختر براند السيارة</option>
                                </select>
                            </div>

                            <!-- Car Model -->
                            <div class="col-md-4" style="display: none">
                                <label for="car_model" class="form-label fw-bold">موديل السيارة</label>
                                <select name="car_model[]" class="form-select custom-select car-model" disabled>
                                    <option value="" disabled selected>اختر موديل السيارة</option>
                                </select>
                            </div>

                            <!-- Manufacturing Year -->
                            <div class="col-md-4" style="display: none">
                                <label for="made_year" class="form-label fw-bold">تاريخ الصنع</label>
                                <select name="made_year[]" class="form-select custom-select made-year" disabled>
                                    <option value="" disabled selected>اختر تاريخ الصنع</option>
                                </select>
                            </div>

                            <!-- Bag Option -->
                            <div class="col-md-4" style="display: none">
                                <label for="bag-option" class="form-label fw-bold">بشنطة أو بدون</label>
                                <select name="bag_option[]" class="form-select custom-select bag-option" disabled>
                                    <option value="" disabled selected>هل المنتج بشنطة !</option>
                                    <option value="0">بدون شنطة</option>
                                    <option class="bag-option-price" value="1">بشنطة</option>
                                </select>
                            </div>

                            <!-- Quantity -->
                            <div class="col-md-4">
                                <label for="product_count" class="form-label fw-bold">العدد المطلوب </label>
                                <input type="number" class="form-control custom-input product-count"
                                       name="product_count[]" value="1" min="1" step="1" readonly>
                            </div>

                            <!-- Unit Price -->
                            <div class="col-md-4">
                                <label for="product_price" class="form-label fw-bold">سعر الوحدة</label>
                                <input type="text" class="form-control custom-input product-price"
                                       name="product_price[]" readonly>
                            </div>

                            <!-- Total Price -->
                            <div class="col-md-12">
                                <label for="product_count_price" class="form-label fw-bold">إجمالي </label>
                                <input type="text" class="form-control custom-input product-count-price"
                                       name="product_count_price[]" readonly>
                            </div>
                        </div>
                    </div>
                </div>
                <button id="addProductBtn" class="btn btn-primary mb-5 mr-2" type="button">إضافة منتج اخر</button>


                <div id="addressSection" style="display: none;">
                    <div class="form-group">
                        <label for="full_name">الاسم بالكامل</label>
                        <input type="text" class="form-control" id="full_name" name="full_name"
                               {{ old('full_name', $user->address?->full_name )}} required>
                    </div>

                    <div class="form-group">
                        <label for="inputPhone">رقم التليفون</label>
                        <input type="tel" class="form-control" id="inputPhone" name="phone"
                               {{ old('phone', $user->address?->phone )}} required>
                    </div>

                    <div class="form-group">
                        <label for="inputAddress">العنوان</label>
                        <input type="text" class="form-control" id="inputAddress" name="address"
                               {{ old('address', $user->address?->address )}} required>
                    </div>

                    <div class="form-group">
                        <label for="inputCity">المدينة</label>
                        <input type="text" class="form-control" id="inputCity" name="city"
                               {{ old('city', $user->address?->city )}} required>
                    </div>

                    <div class="form-group">
                        <label for="state">المحافظة</label>
                        <select class="form-control" id='state' name="state"
                                data-user-state="{{ $user->address?->state ?? '' }}">
                            <option value="" disabled selected>اختر اسم محافظتك</option>
                            @foreach($states as $state)
                                <option
                                    value="{{$state?->state}}" {{ old('state', $user?->address?->state) == $state?->state ? 'selected' : '' }}>{{$state?->state}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="product_total">اجمالي أسعار المنتجات</label>
                    <input type="text" class="form-control" id="product_total" readonly>
                </div>

                <div class="form-group" id="coupon-group-id" style="display: none">
                    <label for="promo_code">كوبون الخصم</label>
                    <div class="input-group coupon-input-group">
                        <input type="text" id="promo_code" name="promo_code" class="form-control"
                               placeholder="أدخل كود الخصم إذا وجد" readonly>
                        <div class="input-group-append">
                            <button type="button" id="applyCouponButton" class="btn btn-primary ms-2" disabled>تطبيق
                                الكوبون
                            </button>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="copounDiscountAmount">قيمة خصم الكوبون</label>
                    <input type="text" class="form-control" id="copounDiscountAmount" readonly>
                </div>
                <div class="form-group">
                    <label for="inputTotalOrder">الاجمالي بعد الخصم</label>
                    <input type="text" class="form-control" id="inputTotalOrder" readonly>
                </div>

                <div class="form-group" id='shipping-cost-div' style='display: block;'>
                    <label for="shipping_cost">تكلفة الشحن</label>
                    <input type="text" class="form-control" name='shipping_cost' value="" id="shipping_cost" readonly>
                </div>
                <div class="form-group" style='display: block;'>
                    <label for="tax-rate">النسبة المئوية للقيمة المضافة</label>
                    <input type="text" name="tax_rate" class="form-control" id="tax-rate"
                           value="{{\App\Models\Admin\Setting::getValue('tax_rate') }} %" readonly>
                </div>
                <div class="form-group">
                    <label for='final_total'>اجمالي الفاتورة الكلي </label>
                    <input type="text" class="form-control" id='final_total' readonly>
                </div>

            </div>
            <div class="card-footer">
                <button type="button" id="showAddressButton" class="btn btn-info btn-block">أكمل الطلب</button>
                <button type="button" id="goBackButton" class="btn btn-secondary btn-block" style="display: none;">
                    رجوع
                </button>
                <button type="submit" class="btn btn-success btn-block" id="submitBtn" style="display: none;">تأكيد
                    الطلب
                </button>
            </div>
        </form>
    </div>

@endsection

@push('scripts')
    <script>
        $(document).ready(function () {

            let productCount = 0;
            initializeSelect2();

            $('#addProductBtn').click(function () {
                productCount++;
                let newForm = $('.product-form:first').clone();

                // تحديث أسماء و IDs الحقول
                newForm.find('select, input').each(function () {
                    let oldName = $(this).attr('name');
                    let oldId = $(this).attr('id');
                    if (oldName) {
                        let newName = oldName.replace('[]', '[' + productCount + ']');
                        $(this).attr('name', newName);
                    }
                    if (oldId) {
                        let newId = oldId + '_' + productCount;
                        $(this).attr('id', newId);
                    }

                    // إذا كان الحقل هو عدد التلبيسات، اضبط القيمة الافتراضية إلى 1
                    if ($(this).hasClass('product-count')) {
                        $(this).val(1); // قيمة الديفولت
                    } else {
                        $(this).val(''); // مسح القيم الأخرى
                    }
                });

                // إعادة تمكين الحقول المعطلة
                newForm.find('select, input').prop('disabled', true);
                newForm.find('.product-category').prop('disabled', false);
                newForm.find('.product-type-input').prop('disabled', false);

                // إضافة زر حذف (أيقونة تراش) في أعلى النموذج
                let removeButton = `<button type="button" class="removeProductBtn" style="position: absolute; top: 10px; left: 10px; background: transparent; border: none; font-size: 18px;">
                            <i class="fas fa-trash-alt" style="color: #dc3545;"></i>
                        </button>`;

                newForm.css('position', 'relative'); // تأكد من أن النموذج يحتوي على position relative
                newForm.prepend(removeButton); // إضافة الزر في أعلى النموذ

                // إضافة النموذج الجديد
                $('#productFormsContainer').append(newForm);
                initializeSelect2();
            });

            // Event delegation for dynamically added elements
            $(document).on('change', '.product-category', function () {
                let form = $(this).closest('.product-form');
                const selectedOption = $(this).find('option:selected');
                const productType = selectedOption.data('product-type');

                form.find('.product-price,.product-count-price').val('');

                if (productType) {
                    // الحقل المخفي للبروداكت تايب
                    form.find('.product-type-input').val(productType);

                    if (productType === 'earth') {
                        // إظهار الحقول إذا لم يكن المنتج من نوع اكسسوارات أو كان قسمًا فرعيًا
                        form.find('.car-brand, .car-model, .made-year, .bag-option,.product-price, .seat-count').closest('.col-md-4').show().find('select').prop('disabled', true);
                        form.find('.product-count').prop('readonly', true).prop('disabled', true).val('1');
                    } else if (productType === 'seat') {
                        form.find('.car-brand, .car-model,.product-price, .made-year, .seat-count').closest('.col-md-4').show().find('select').prop('disabled', true);
                        form.find('.bag-option').closest('.col-md-4').hide().find('select').val('');
                        form.find('.product-count').prop('readonly', true).prop('disabled', true).val('1');

                    } else {
                        form.find('.car-brand,.cover-color, .car-model, .made-year, .bag-option, .seat-count').closest('.col-md-4').hide().find('select').val('');
                        form.find('.product-count').prop('readonly', false).prop('disabled', false).val('1');
                    }

                    // جلب المنتجات بناءً على الفئة المختارة
                    $.ajax({
                        url: "{{route('admin.getCategory-products',':id')}}".replace(':id', productType),
                        type: 'GET',
                        success: function (products) {
                            // العثور على القائمة المنسدلة التالية وتفريغها
                            let productSelect = form.find('.product-select');
                            let productSelectDiv = form.find('.product-select-div');
                            productSelect.empty();
                            productSelect.prop('disabled', false);
                            productSelectDiv.show();


                            // إضافة الخيارات إلى القائمة بناءً على المنتجات المسترجعة
                            productSelect.append(`<option value="" selected disabled >اختر المنتج</option>`);
                            products.forEach(function (product) {
                                productSelect.append(`<option value="${product.id}" data-product-type="${product.product_type}">${product.name}</option>`);
                            });
                        },
                        error: function () {
                            console.error('Failed to fetch products.');
                        }
                    });
                    calculateProductsTotal();
                }
            });

            $(document).on('change', '.product-select', function () {

                const selectedOption = $(this).find('option:selected');
                const productType = selectedOption.data('product-type');
                let form = $(this).closest('.product-form');
                if (productType !== 'undefined') {
                    form.find('.cover-color').prop('disabled', false).closest('.col-md-4').show();
                    getSeatCoverColors(form);
                    getSeatCoverPrice(form);
                    calculateProductsTotal();
                } else {
                    form.find('.cover-color').prop('disabled', true).closest('.col-md-4').hide();
                    form.find('.product-count').prop('readonly', false);
                    getAccessoryPrice(form);
                    calculateProductsTotal();
                }

            });

            $(document).on('change', '.cover-color', function () {
                let form = $(this).closest('.product-form');
                form.find('.seat-count').prop('disabled', false).focus();
            });

            $(document).on('change', '.seat-count', function () {
                let form = $(this).closest('.product-form');
                $(form).find('.product-count').prop('readonly', false).prop('disabled', false).val('1');
                getSeatCoverPrice(form);
                getCarBrands(form);
                calculateProductsTotal(); // تحديث الإجمالي
            });

            $(document).on('change', '.bag-option', function () {
                let form = $(this).closest('.product-form');
                getSeatCoverPrice(form); // حساب سعر المنتج بناءً على الخيارات المحددة
                calculateProductsTotal(); // تحديث الإجمالي
            });

            $(document).on('change', '.car-brand', function () {
                let form = $(this).closest('.product-form');
                getCarModels(form);
            });

            $(document).on('change', '.car-model', function () {
                let form = $(this).closest('.product-form');
                getMadeYears(form);
            });

            $(document).on('change', '.made-year', function () {
                let form = $(this).closest('.product-form');
                form.find('.bag-option').prop('disabled', false);
                form.find(' .product-count').prop('readonly', false);
            });

            $(document).on('change', '.bag-option', function () {
                let form = $(this).closest('.product-form');
                form.find(' .product-count').prop('readonly', false);
                getSeatCoverPrice(form);
            });

            $(document).on('change', '.product-count', function () {
                let form = $(this).closest('.product-form');
                getSeatCoverPrice(form);
                getAccessoryPrice(form);
            });

            // Event listener for changes in quantity or price fields
            $(document).on('change,input', '.product-count', function () {
                let form = $(this).closest('.product-form');
                getSeatCoverPrice(form); // حساب سعر المنتج بناءً على الخيارات المحددة
                getAccessoryPrice(form)
                calculateproductTotal(); // تحديث الإجمالي الكلي
            });

            // عند الضغط على زر حذف النموذج
            $(document).on('click', '.removeProductBtn', function () {
                $(this).closest('.product-form').remove();
                calculateproductTotal();
            });


            // Function to calculate total price for each product
            function calculateProductsTotal(coupounDiscount = 0) {
                let totalPrice = 0;

                // Loop through all product forms
                $('.product-form').each(function () {

                    // Get the total price for each product
                    let productsTotalPrice = parseFloat($(this).find('.product-count-price').val()) || 0;

                    // Add to total price
                    totalPrice += productsTotalPrice;
                });

                $('#copounDiscountAmount').val(coupounDiscount)
                if (coupounDiscount == 0) {
                    $('#promo_code').attr('readonly', false);
                    $('#applyCouponButton').attr('disabled', false);
                }
                // Update the total price field
                $('#product_total').val(totalPrice.toFixed(2));
                $('#inputTotalOrder').val((totalPrice - coupounDiscount).toFixed(2));

                var shipping = parseFloat($('#shipping_cost').val()) || 0;
                var totalAfterDiscount = totalPrice - coupounDiscount;
                var total = shipping + totalAfterDiscount;
                var taxRate = parseFloat($('#tax-rate').val()) / 100 || 0;
                var taxAmount = total * taxRate;
                var finalTotal = parseFloat(total + taxAmount);
                $('#final_total').val(finalTotal.toFixed(2) + '  ر.س ');


            }

            function getSeatCoverColors(form) {
                var seatCoverId = form.find('.product-select').val();
                if (seatCoverId) {
                    $.ajax({
                        url: "{{route('admin.seat-cover-colors', ':id')}}".replace(':id', seatCoverId),
                        type: 'GET',
                        success: function (response) {
                            var $colorSelect = form.find('.cover-color');
                            $colorSelect.empty();

                            if (response.length > 0) {
                                $colorSelect.append('<option value="" selected disabled>اختر لون المنتج</option>');
                                $.each(response, function (key, color) {
                                    $colorSelect.append('<option value="' + color.id + '">' + color.name + ' ' + color.tatriz_color + '</option>');
                                });
                                $colorSelect.prop('disabled', false).focus();
                            } else {
                                $colorSelect.prop('disabled', true);
                            }
                        },
                        error: function (xhr) {
                            console.log(xhr);
                        }
                    });
                }
            }

            function getCarBrands(form) {
                var seatCount = form.find('.seat-count').val();
                if (seatCount) {
                    $.ajax({
                        url: "{{route('admin.seat-count.brands', ':id')}}".replace(':id', seatCount),
                        type: 'GET',
                        success: function (response) {
                            var $brandsSelect = form.find('.car-brand');
                            $brandsSelect.empty();

                            if (response.length > 0) {
                                $brandsSelect.append('<option value="" selected disabled>اختر براند السيارة</option>');
                                $.each(response, function (key, brand) {
                                    $brandsSelect.append('<option value="' + brand.id + '">' + brand.brand_name + '</option>');
                                });
                                $brandsSelect.prop('disabled', false).focus();
                            } else {
                                $brandsSelect.prop('disabled', true);
                            }
                        },
                        error: function (xhr) {
                            console.log(xhr);
                        }
                    });
                }
            }

            function getCarModels(form) {
                var brandId = form.find('.car-brand').val();
                var seatCountId = form.find('.seat-count').val();

                if (brandId) {
                    $.ajax({
                        url: "{{route('admin.brand-models')}}",
                        type: 'GET',
                        data: {
                            brand_id: brandId,
                            seat_count_id: seatCountId,
                        },
                        success: function (response) {
                            var $modelSelect = form.find('.car-model');
                            $modelSelect.empty();

                            if (response.length > 0) {
                                $modelSelect.append('<option value="" selected disabled>اختر موديل السيارة</option>');
                                $.each(response, function (key, model) {
                                    $modelSelect.append('<option value="' + model.id + '">' + model.model_name + '</option>');
                                });
                                $modelSelect.prop('disabled', false).focus();
                            } else {
                                $modelSelect.prop('disabled', true);
                            }
                        },
                        error: function (xhr) {
                            console.log(xhr);
                        }
                    });
                }
            }

            function getMadeYears(form) {
                var modelId = form.find('.car-model').val();
                if (modelId) {
                    $.ajax({
                        url: "{{route('admin.get-model-made-years')}}",
                        type: 'GET',
                        data: {
                            model_id: modelId,
                        },
                        success: function (response) {
                            var $yearSelect = form.find('.made-year');
                            $yearSelect.empty();

                            if (response) {
                                $yearSelect.append('<option value="' + response + '" selected>' + response + '</option>');
                                $yearSelect.prop('disabled', false);
                                form.find('.bag-option, .product-count').prop('disabled', false);
                            } else {
                                $yearSelect.prop('disabled', true);
                            }
                        },
                        error: function (xhr) {
                            console.log(xhr);
                        }
                    });
                }
            }

            function getSeatCoverPrice(form) {
                var $countId = form.find('.seat-count').val();
                var $coverId = form.find('.product-select').val();
                if ($countId && $coverId) {
                    $.ajax({
                        url: "{{route('admin.cover-price-change')}}",
                        type: 'GET',
                        data: {
                            seat_count_id: $countId,
                            cover_id: $coverId,
                        },
                        success: function (response) {
                            var bagPrice = form.find('.bag-option').val() == 1 ? parseFloat(response.bag_price.bag_price) : 0;
                            form.find('.bag-option-price').text('بشنطة -   ' + bagPrice + " ر.س");
                            var coverPrice = parseFloat(response.cover_price ? response.cover_price.price : '0');
                            var price = coverPrice + bagPrice;

                            if (price > 0) {
                                form.find('.product-price').val(price);
                                var $count = form.find('.product-count').val();
                                form.find('.product-count-price').val($count * price);
                            } else {
                                form.find('.product-price').val('');
                                form.find('.product-count-price').val('');
                            }

                            // تحديث الإجمالي الكلي عند كل تعديل
                            calculateProductsTotal();
                        },
                        error: function (xhr) {
                            console.log(xhr);
                        }
                    });
                }
            }

            function getAccessoryPrice(form) {
                var AccessoryId = form.find('.product-select').val();
                if (AccessoryId) {
                    $.ajax({
                        url: "{{route('admin.accessory-price-change')}}",
                        type: 'GET',
                        data: {
                            accessory_id: AccessoryId,
                        },
                        success: function (response) {
                            var price = parseFloat(response);
                            console.log(response)
                            if (price > 0) {
                                form.find('.product-price').val(price);
                                var $count = form.find('.product-count').val();
                                form.find('.product-count-price').val($count * price);
                            } else {
                                form.find('.product-price').val('');
                                form.find('.product-count-price').val('');
                            }

                            // تحديث الإجمالي الكلي عند كل تعديل
                            calculateProductsTotal();
                        },
                        error: function (xhr) {
                            console.log(xhr);
                        }
                    });
                }
            }

            $('#applyCouponButton').click(function () {
                applyCopoun();
            });

            function applyCopoun() {
                var couponCode = $('#promo_code').val(); // الكود المُدخل للكوبون
                var totalOrder = $('#product_total').val(); // إجمالي الطلب
                var userId = $('#inputUser').val();
                $.ajax({
                    url: "{{ route('admin.check-promo-code') }}",
                    method: 'POST',
                    data: {
                        promo_code: couponCode,
                        total_order: totalOrder,
                        user_id: userId,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        // تحقق من وجود خصم في الرد
                        if (response.discount !== undefined) {
                            var discount = response.discount;
                            $('#copounDiscountAmount').val(response.discount);
                            $('#promo_code').attr('readonly', true);
                            $('#applyCouponButton').attr('disabled', 'disabled');
                            calculateProductsTotal(discount);
                            toastr.success(response.success);
                        } else {
                            toastr.error('حدث خطأ غير متوقع. حاول مرة أخرى.');
                        }
                    },
                    error: function (xhr) {
                        let error = JSON.parse(xhr.responseText);
                        if (error.error) {
                            toastr.error(error.error);
                        } else {
                            toastr.error('حدث خطأ غير متوقع. حاول مرة أخرى.');
                        }
                        $('#promo_code').val('');
                    }
                });
            }

            // -------------------  حساب تكلفة الشحن --------------------

            const stateSelect = $('select[name="state"]');

            // وظيفة لحساب تكلفة الشحن
            function calculateShippingCost(state, callback) {
                if (!state) {
                    $('#shipping_cost').val('غير متوفر');
                    if (callback) callback(); // استدعاء الـ callback في حالة عدم وجود محافظة
                    return;
                }

                $.ajax({
                    url: "{{ route('admin.checkout.getShippingCost', ':state') }}".replace(':state', state),
                    method: 'GET',
                    success: function (response) {
                        const shippingCost = parseFloat(response.shipping_cost);
                        if (shippingCost == 0 || !shippingCost) {
                            $('#shipping_cost').val('شحن مجاني');
                        } else {
                            $('#shipping_cost').val(shippingCost + ' ر.س ');
                        }

                        if (callback) callback(); // استدعاء الـ callback بعد تحديث القيمة
                    },
                    error: function () {
                        $('#shipping_cost').val('خطأ في جلب تكلفة الشحن');
                        if (callback) callback(); // استدعاء الـ callback في حالة حدوث خطأ
                    }
                });
            }

            // استدعاء الفانكشن مع تمرير callback للتأكد من استلام القيمة بعد الانتهاء
            stateSelect.on('change', function () {
                const state = $(this).val();
                calculateShippingCost(state, function () {
                    var discount = parseFloat($("#copounDiscountAmount").val()) || 0;
                    calculateProductsTotal(discount);
                });
            });

            function initializeSelect2() {
                $('.select2').select2({
                    theme: 'bootstrap4',
                    width: '100%',
                    language: {
                        noResults: function () {
                            return "لا توجد نتائج";
                        }
                    }
                });
            }

            // تحديث الخصم عند تغيير المستخدم
            $('#inputUser').change(function () {
                initializeSelect2()
                $('#copounDiscountAmount').val('0');

                // الحصول على الـ user_id المختار
                const userId = $(this).val();
                // أظهار كود كوبون الخصم للاعضاء فقط
                if (userId) {
                    $('#coupon-group-id').show();
                    $('#promo_code').removeAttr('readonly');
                    $('#applyCouponButton').removeAttr('disabled');
                } else {
                    $('#coupon-group-id').hide();
                }

                // إرسال طلب AJAX لجلب العناوين الخاصة بالمستخدم
                if (userId) {
                    $.ajax({
                        url: "{{route('admin.get-customer-address',':userId')}}".replace(':userId', userId), // رابط الـ API لجلب العناوين
                        method: 'GET',
                        success: function (response) {
                            // تأكد من أن الاستجابة تحتوي على بيانات العنوان
                            if (response.success) {
                                const address = response.address;

                                // تعبئة الحقول الخاصة بالعناوين
                                $('#inputAddress').val(address.address);
                                $('#inputPhone').val(address.phone);
                                $('#inputCity').val(address.city);
                                $('#state').val(address.state);
                                $('#full_name').val(address.full_name);
                                calculateShippingCost(address.state, function () {
                                    var discount = parseFloat($("#copounDiscountAmount").val()) || 0;
                                    calculateproductTotal(discount);
                                });

                            } else {
                                // في حالة عدم وجود عنوان، افراغ الحقول
                                $('#inputAddress').val('');
                                $('#inputPhone').val('');
                                $('#inputCity').val('');
                                $('#state').val('');
                                $('#full_name').val('');
                                $('#shipping_cost').val('');

                            }
                        },
                        error: function () {
                            // تفريغ الحقول عند حدوث خطأ
                            $('#inputAddress').val('');
                            $('#inputPhone').val('');
                            $('#inputCity').val('');
                            $('#state').val('');
                            $('#full_name').val('');
                            $('#shipping_cost').val('');
                        }
                    });
                } else {
                    // تفريغ الحقول إذا لم يتم اختيار مستخدم
                    $('#inputAddress').val('');
                    $('#inputPhone').val('');
                    $('#inputCity').val('');
                    $('#state').val('');
                    $('#state option[value=""]').attr('selected', 'selected');
                    $('#full_name').val('');
                    $('#shipping_cost').val('');
                    calculateShippingCost('', function () {
                        var discount = parseFloat($("#copounDiscountAmount").val()) || 0;
                        calculateproductTotal(discount);
                    });


                }

            });


            $('#orderForm').on('submit', function (e) {
                e.preventDefault();

                let hasError = false;
                let errorMessage = '';

                // التحقق من اختيار نوع المنتج على الأقل في نموذج واحد
                let hasSelectedCover = false;
                $('.product-category').each(function () {
                    if ($(this).val() !== '' && $(this).val() !== null) {
                        hasSelectedCover = true;
                    }
                });

                if (!hasSelectedCover) {
                    hasError = true;
                    errorMessage += 'يجب اختيار نوع منتج واحدة على الأقل.\n';
                }

                // التحقق من جميع الحقول المطلوبة في كل نموذج منتج
                $('.product-form').each(function (index) {
                    let form = $(this);
                    let category = form.find('.product-category');
                    let categoryValue = category.val();
                    const selectedOption = category.find('option:selected');
                    const productType = selectedOption.data('product-type');
                    if (categoryValue) {
                        if (productType === 'accessory') {
                            if(!form.find('.product-select').val()){
                                hasError=true;
                                errorMessage+=`الرجاء اختيار اسم المنتج رقم ${index+1}.\n`;
                            }
                        } else {
                            // التحقق من اختيار جميع الحقول المطلوبة
                            if (!form.find('.cover-color').val()) {
                                hasError = true;
                                errorMessage += `الرجاء اختيار لون المنتج للمنتج رقم ${index + 1}.\n`;
                            }
                            if (!form.find('.seat-count').val()) {
                                hasError = true;
                                errorMessage += `الرجاء اختيار عدد المقاعد للمنتج رقم ${index + 1}.\n`;
                            }
                            if (!form.find('.car-brand').val()) {
                                hasError = true;
                                errorMessage += `الرجاء اختيار براند السيارة للمنتج رقم ${index + 1}.\n`;
                            }
                            if (!form.find('.car-model').val()) {
                                hasError = true;
                                errorMessage += `الرجاء اختيار موديل السيارة للمنتج رقم ${index + 1}.\n`;
                            }
                            if (!form.find('.made-year').val()) {
                                hasError = true;
                                errorMessage += `الرجاء اختيار سنة الصنع للمنتج رقم ${index + 1}.\n`;
                            }
                            if (productType === 'earth') {
                                if (!form.find('.bag-option').val()) {
                                    hasError = true;
                                    errorMessage += `الرجاء تحديد خيار الشنطة للمنتج رقم ${index + 1}.\n`;
                                }
                            }
                        }
                    }
                });

                // التحقق من بيانات العنوان إذا كان ظاهراً
                if ($('#addressSection').is(':visible')) {
                    if (!$('#full_name').val()) {
                        hasError = true;
                        errorMessage += 'الرجاء إدخال الاسم بالكامل.\n';
                    }
                    if (!$('#inputPhone').val()) {
                        hasError = true;
                        errorMessage += 'الرجاء إدخال رقم التليفون.\n';
                    }
                    if (!$('#inputAddress').val()) {
                        hasError = true;
                        errorMessage += 'الرجاء إدخال العنوان.\n';
                    }
                    if (!$('#inputCity').val()) {
                        hasError = true;
                        errorMessage += 'الرجاء إدخال المدينة.\n';
                    }
                    if (!$('select[name="state"]').val()) {
                        hasError = true;
                        errorMessage += 'الرجاء اختيار المحافظة.\n';
                    }
                }

                if (hasError) {
                    toastr.error(errorMessage);
                } else {
                    let formData = new FormData(this);
                    // لعرض كل البيانات التي يتم إرسالها
                    for (let [key, value] of formData.entries()) {
                        console.log(key, value);
                    }

                    $.ajax({
                        type: 'POST',
                        url: '{{ route('admin.orders.store') }}',
                        data: formData,
                        processData: false,
                        contentType: false,
                        beforeSend: function () {
                            $('#submitBtn').attr('disabled', true);
                        },
                        success: function (response) {
                            if (response.success) {
                                console.log(response)
                                toastr.success(response.message);
                                window.location.href = '{{ route('admin.orders.index') }}';
                            }
                        },
                        error: function (xhr) {
                            console.log(formData)
                            if (xhr.status === 422) {
                                let errors = xhr.responseJSON.errors;


                                $('.invalid-feedback').remove();
                                $('.is-invalid').removeClass('is-invalid');

                                $.each(errors, function (key, value) {
                                    let inputElement = $('[name="' + key + '"]');
                                    inputElement.addClass('is-invalid');
                                    inputElement.after('<div class="invalid-feedback">' + value[0] + '</div>');
                                });

                                toastr.error(xhr.responseJSON.message || 'هناك بعض الأخطاء في البيانات.');
                            } else {
                                toastr.error('حدث خطأ غير متوقع.');
                            }
                        },
                        complete: function () {
                            $('#submitBtn').attr('disabled', false);
                        }
                    });
                }
            });
        });

        // اخفاء واظهار سيكشن العنوان واضافة المنتجات والتبديل بينهما
        document.addEventListener('DOMContentLoaded', function () {
            const initialFormSection = document.getElementById('productFormsContainer');
            const addressSection = document.getElementById('addressSection');
            const showAddressButton = document.getElementById('showAddressButton');
            const goBackButton = document.getElementById('goBackButton');
            const ShippingDiv = document.getElementById('shipping-cost-div')
            const addButton = document.getElementById('addProductBtn');
            const submitOrderButton = document.getElementById('submitBtn');

            // الانتقال لأعلى الصفحة
            function scrollToTop() {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth' // تمرير سلس إلى أعلى الصفحة
                });
            }

            showAddressButton.addEventListener('click', function () {
                initialFormSection.style.display = 'none';
                goBackButton.style.display = 'block'; // عرض زر الرجوع
                ShippingDiv.style.display = 'block';  // أظهار تكلفة الشحن
                addButton.style.display = 'none';
                addressSection.style.display = 'block';
                showAddressButton.style.display = 'none';
                submitOrderButton.style.display = 'block';

                scrollToTop(); // الانتقال لأعلى الصفحة عند الضغط على "أكمل الطلب"
            });

            goBackButton.addEventListener('click', function () {
                initialFormSection.style.display = 'block';
                addButton.style.display = 'block';
                addressSection.style.display = 'none';
                showAddressButton.style.display = 'block';
                goBackButton.style.display = 'none'; // إخفاء زر الرجوع عند الرجوع
                ShippingDiv.style.display = 'none';  // اخفاء تكلفة الشحن
                submitOrderButton.style.display = 'none';


                scrollToTop(); // الانتقال لأعلى الصفحة عند الضغط على "رجوع"
            });


            const stateSelect = document.getElementById('state');
            stateSelect.selectedIndex = 0;

        });

    </script>
@endpush
@push('styles')
    <style>
        label {
            font-size: 13px;
        }

        .coupon-input-group {
            display: flex;
            align-items: stretch;
        }

        .coupon-input-group .input-group-append {
            margin-right: 0.5rem;
        }

        .coupon-input-group .form-control,
        .coupon-input-group .input-group-append .btn {
            border-radius: 0.25rem;
        }

        @media (max-width: 575.98px) {
            .coupon-input-group {
                flex-direction: column;
            }

            .coupon-input-group > .form-control {
                width: 100%;
                margin-bottom: 0.5rem;
            }

            .coupon-input-group .input-group-append {
                width: 100%;
                margin-right: 0;
            }

            .coupon-input-group .input-group-append .btn {
                width: 100%;
            }

        }

        #product_count_div {
            margin-top: 50px !important;
        }

        .form-select:disabled {
            background-color: #e9ecef;
            opacity: 0.65;
        }

        .product-form {
            margin-bottom: 20px;
            padding: 20px;
            border: 2px solid #ddd !important;
            border-radius: 10px;
            background-color: #ffffff;
            position: relative;
        }

        .product-form .removeProductBtn:hover {
            color: #ff0000;
            cursor: pointer;
        }

    </style>
@endpush
