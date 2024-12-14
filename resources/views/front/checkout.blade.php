@extends('front.layouts.app')
@section('title','اتمام الطلب')

@section('content')
    @php
        $user = auth()->user() ?? null;
        $address = null;
            if($user){
                $address = $user->address;
            }
    @endphp
        <!-- inner page banner -->
    <div class="dlab-bnr-inr overlay-black-middle"
         style="background-image:url({{asset('storage/'.$siteImages->title_image)}});">
        <div class="container">
            <div class="dlab-bnr-inr-entry">
                <h1 class="text-white"> إتمام الطلب</h1>
            </div>
        </div>
    </div>
    <!-- inner page banner END -->
    <!-- Breadcrumb row -->
    <div class="breadcrumb-row">
        <div class="container">
            <ul class="list-inline">
                <li><a href="{{route('home.index')}}">الرئيسية</a></li>
                <li>اتمام الطلب</li>
            </ul>
        </div>
    </div>
    <!-- Breadcrumb row END -->
    <!-- contact area -->
    <div class="section-full content-inner">
        <!-- Product -->
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <h4>محتويات الطلب : </h4>
                    <table class="table-bordered check-tbl">
                        <thead class="text-left">
                        <tr class="text-center">
                            <th>صورة المنتج</th>
                            <th>اسم المنتج</th>
                            <td>السعر</td>
                            <td>الكمية</td>
                            <th>الإجمالي</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($formattedItems as $item)
                            <tr class="text-center">
                                <td><img src="{{asset('storage/'.$item['details']['image'])}}" alt=""></td>
                                <td>{{$item['name']}}</td>
                                <td> {{$item['price']}} ر.س</td>
                                <td>{{$item['quantity']}}</td>
                                <td class="text-primary fw-bold">{{$item['quantity'] * $item['price']}} ر.س</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="dlab-divider bg-gray-dark text-gray-dark icon-center"><i
                    class="fas fa-circle bg-white text-gray-dark"></i></div>
            <form id="order-form" class="shop-form">
                @csrf
                <div class="row">
                    <div class="col-md-6 col-lg-6 m-b30">
                        <h4>العنوان وتفاصيل الشحن:</h4>
                        <div class="row">
                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                <input required type="text" name="full_name"
                                       value="{{old('full_name',$address?->full_name)}}" class="form-control"
                                       placeholder="الاسم بالكامل">
                            </div>
                        </div>
                        <div class="form-group">
                            <input required name="address" value="{{old('address',$address?->address)}}" type="text"
                                   class="form-control" placeholder="العنوان">
                        </div>
                        <div class="form-group col-lg-12 col-md-12 col-sm-12">
                            <input required name="city" value="{{old('city',$address?->city)}}" type="text"
                                   class="form-control" placeholder="المدينة">
                        </div>
                        <div class="form-group col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <select required name="state" class="form-control select2">
                                    <option value="" selected disabled>اختر المحافظة</option>
                                    @foreach($states as $state)
                                        <option value="{{$state->state}}"
                                                {{old('state',$address?->state) == $state->state ? 'selected':''}}
                                                data-state-id="{{$state->id}}">
                                            {{$state->state}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <input required name="phone" type="text" class="form-control" value="{{$address?->phone}}" placeholder="رقم الجوال">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <h4>تفاصيل الفاتورة:</h4>
                        <table class="table-bordered check-tbl">
                            <tbody>
                            <tr>
                                <td>اجمالي سعر المنتجات</td>
                                <td class="fw-bold">{{$totalPrice}} ر.س</td>
                            </tr>
                            @if($user)

                                <tr>
                                    <td>كوبون الخصم</td>
                                    <td id="copoun-discount" class="fw-bold">--</td>
                                </tr>
                            @endif
                            <tr>
                                <td>القيمة المضافة</td>
                                <td id="tax-amount" class="fw-bold">{{$taxAmount}} ر.س</td>
                            </tr>
                            <tr>
                                <td>تكاليف الشحن</td>
                                <td id="shipping-cost" class="fw-bold">--</td>
                            </tr>
                            <tr class="alert-info border-dark">
                                <td>اجمالي الفاتورة</td>
                                <td id="final-total" class="fw-bolder">{{$totalPrice + $taxAmount}} ر.س</td>
                            </tr>
                            </tbody>
                        </table>

                        <!-- قسم كوبون الخصم الجديد -->
                        @if($user)
                            <div class="form-group coupon-section mt-3">
                                <div class="input-group">
                                    <input name="promo_code" type="text" class="form-control"
                                           placeholder="أدخل كود الخصم اذا وجد "
                                           id="coupon-input">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="button" id="apply-coupon">
                                            تطبيق الكوبون
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <h5 class="mt-3">طريقة الدفع:</h5>
                        <div class="form-group">
                            <select class="form-control select2">
                                <option selected disabled value="">اختر طريقة الدفع</option>
                                <option value="">الدفع عند الاستلام</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <button id="order-submit" class="site-button button-lg w-100" type="button">
                               @if(session('editing_order_id'))
                                تأكيد التعديل
                                @else
                                تأكيد الطلب
                                @endif
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!-- Product END -->
    </div>
    <!-- contact area  END -->

@endsection

@push('styles')
    <style>
        .is-invalid {
            border-color: #dc3545 !important;
            background-color: #fff8f8;
        }
    </style>
@endpush

@push('scripts')
    <script>
        $(document).ready(function () {

            // دالة لحساب الإجمالي بعد الخصومات والشحن
            function recalculateTotal(orderTotal, taxRate, couponDiscount, shippingCost = 0) {
                var total = orderTotal;

                if (couponDiscount) {
                    total -= couponDiscount;
                }
                var taxAmount = taxRate * total;

                // إضافة تكلفة الشحن
                total += shippingCost;
                total += taxAmount;

                return total.toFixed(2);
            }

            const selectedState = $('select[name="state"] option:selected');
            // تحقق مما إذا كان المستخدم مسجلاً ولديه محافظة مسجلة
            const userState = selectedState.data('state-id'); // افترض أن الحقل يحتفظ بالمحافظة المخزنة

            // -------------------  تطبيق الكوبون --------------------
            $('#apply-coupon').on('click', function (e) {
                e.preventDefault();

                var couponCode = $('#coupon-input').val();
                var orderTotal = {{$totalPrice}}; // إجمالي الطلب
                var taxRate = {{$tax_rate}};

                var userId = {{ auth()->check() ? auth()->user()->id : 'null' }}; // معرف المستخدم الحالي
                $.ajax({
                    url: '{{ route("checkout.promo") }}',
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    data: {
                        promo_code: couponCode,
                        total_order: orderTotal,
                        user_id: userId
                    },
                    success: function (data) {
                        if (data.success) {

                            $('#apply-coupon').prop('readonly', true).css({
                                'background-color': 'green',
                                'color': 'white',
                                'cursor': 'not-allowed',
                                'opacity': '.6',
                            }).text('تم تطبيق الكوبون بنجاح');

                            // جعل حقل الكوبون readonly
                            $('#coupon-input').prop('readonly', true);

                            $('#copoun-discount').text(parseFloat(data.discount).toFixed(2) + ' ر.س ');


                            var couponDiscount = data.discount || 0;
                            var totalAfterDiscount = orderTotal - couponDiscount;

                            var selectedState = $('select[name="state"]').data('user-state');
                            if (selectedState) {
                                calculateShippingCost(selectedState);
                            }
                            // حساب الإجمالي الجديد باستخدام الدالة
                            var newTotal = recalculateTotal(orderTotal, taxRate, couponDiscount);
                            $('#final-total').text(newTotal);

                            $('#tax-amount').text((totalAfterDiscount * taxRate).toFixed(2) + ' ر.س ');
                        } else if (data.error) {
                            toastr.error(data.error)
                            $('#coupon-input').val('');
                        }
                    },
                    error: function (xhr) {
                        toastr.error('حدث خطأ تأكد من الكوبون وحاول مرة أخرى');
                    }
                });
            });

            // -------------------  إرسال الطلب --------------------
            $('#order-submit').on('click', function (event) {
                event.preventDefault();

                // تحقق من جميع الحقول المطلوبة
                var isValid = true;
                var firstError = ''; // متغير لتخزين أول خطأ فقط

                // إزالة كل الكلاسات السابقة
                $('.is-invalid').removeClass('is-invalid');

                // التحقق من الاسم
                if ($('input[name="full_name"]').val().trim() === '') {
                    isValid = false;
                    firstError = 'الاسم بالكامل مطلوب';
                    $('input[name="full_name"]').addClass('is-invalid');
                    toastr.error(firstError);
                    return;
                }

                // التحقق من العنوان
                if ($('input[name="address"]').val().trim() === '') {
                    isValid = false;
                    firstError = 'العنوان مطلوب';
                    $('input[name="address"]').addClass('is-invalid');
                    toastr.error(firstError);
                    return;
                }

                // التحقق من المدينة
                if ($('input[name="city"]').val().trim() === '') {
                    isValid = false;
                    firstError = 'المدينة مطلوبة';
                    $('input[name="city"]').addClass('is-invalid');
                    toastr.error(firstError);
                    return;
                }

                // التحقق من المحافظة
                if ($('select[name="state"]').val() === null || $('select[name="state"]').val() === '') {
                    isValid = false;
                    firstError = 'يرجى اختيار المحافظة';
                    $('select[name="state"]').addClass('is-invalid');
                    toastr.error(firstError);
                    return;
                }

                // التحقق من رقم الجوال
                if ($('input[name="phone"]').val().trim() === '') {
                    isValid = false;
                    firstError = 'رقم الجوال مطلوب';
                    $('input[name="phone"]').addClass('is-invalid');
                    toastr.error(firstError);
                    return;
                }

                // إذا كانت جميع التحققات صحيحة، تابع مع إرسال الطلب
                var formData = $('#order-form').serialize();
                var submitButton = $('#order-submit');
                submitButton.prop('disabled', true).text('جاري الإرسال...');

                var method = @if(session()->has('editing_order_id')) "PUT"
                @else "POST" @endif;

                var orderId = null;
               @if(session()->has('editing_order_id'))
                orderId = {{session('editing_order_id')}};
               @endif
                var myUrl = @if(session()->has('editing_order_id'))
                    "{{route('checkout.update',':id')}}".replace(':id', orderId);
                @else
                    "{{route('checkout.store')}}";
                @endif

                $.ajax({
                    url: myUrl,
                    method: method,
                    data: formData,
                    success: function (response) {
                        if (response.success) {
                            window.location.href = "{{route('home.index')}}";
                        } else {
                            toastr.error('خطأ: ' + response.message);
                            if (orderId) {
                                submitButton.prop('disabled', false).text('تأكيد التعديل');
                            } else {

                                submitButton.prop('disabled', false).text('اتمام الطلب');
                            }
                        }
                    },
                    error: function (response) {
                        if (response.responseJSON && response.responseJSON.message) {
                            toastr.error(response.responseJSON.message);
                            console.log(response);
                        } else {
                            alert('حدث خطأ حاول مرة أخرى.');
                        }

                        if (orderId) {

                            submitButton.prop('disabled', false).text('تأكيد التعديل');
                        } else {

                            submitButton.prop('disabled', false).text('اتمام الطلب');
                        }
                    }
                });
            });            // -------------------  حساب تكلفة الشحن --------------------

            // const stateSelect = $('select[name="state"]');


            const totalAmount = {{$totalPrice}};
            var taxRate = {{$tax_rate}};

            // وظيفة لحساب تكلفة الشحن
            function calculateShippingCost(state) {
                if (!state) {
                    $('#shipping-cost').text('غير متوفر');
                    return;
                }

                $.ajax({
                    url: "{{route('checkout.getShippingCost', ':state')}}".replace(':state', state),
                    method: 'GET',
                    success: function (response) {
                        const shippingCost = response.shipping_cost;
                        if (shippingCost == 0 || !shippingCost) {
                            $('#shipping-cost').text(' شحن مجاني');
                        } else {
                            $('#shipping-cost').text(shippingCost + ' ر.س ');
                        }

                        // تحديث إجمالي المبلغ بعد إضافة تكلفة الشحن
                        var updatedTotal = recalculateTotal(totalAmount, taxRate, parseFloat($('#copoun-discount').text()) || 0, parseFloat(shippingCost));
                        $('#final-total').text(updatedTotal + ' ر.س ');
                    },
                    error: function () {
                        $('#shipping-cost').text('خطأ في جلب تكلفة الشحن');
                    }
                });
            }

            if (userState) {
                // حساب تكلفة الشحن بناءً على المحافظة المسجلة
                calculateShippingCost(userState);
                recalculateTotal();
            }

            // حدث عند تغيير المحافظة
            const stateSelect = $('select[name="state"]');

            stateSelect.change(function () {
                const stateId = $(this).find('option:selected').data('state-id');
                calculateShippingCost(stateId);
                recalculateTotal();
            });

        });


    </script>
@endpush
