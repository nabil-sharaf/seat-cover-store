@extends('front.layouts.app')
@section('content')
    <!-- inner page banner -->
    <div class="dlab-bnr-inr overlay-black-middle" style="background-image:url(images/background/bg4.jpg);">
        <div class="container">
            <div class="dlab-bnr-inr-entry">
                <h1 class="text-white">Cart</h1>
            </div>
        </div>
    </div>

    <!-- Breadcrumb row -->
    <div class="breadcrumb-row">
        <div class="container">
            <ul class="list-inline">
                <li><a href="{{route('home.index')}}">الرئيسية</a></li>
                <li>تفاصيل السلة</li>
            </ul>
        </div>
    </div>

    <!-- contact area -->
    <div class="section-full content-inner">
        <!-- Product -->
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- Table on desktop, Cards on mobile -->
                    <div class="d-none d-md-block">
                        <div class="table-responsive table-bordered table-hover">
                            <table class="table check-tbl">
                                <thead class="text-right">
                                <tr>
                                    <th>#</th>
                                    <th>صورة المنتج</th>
                                    <th>المنتج</th>
                                    <th>سعر الوحدة</th>
                                    <th>الكمية</th>
                                    <th>الإجمالي</th>
                                    <th>حذف</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($formattedItems as $item)
                                    <tr class="alert">
                                        <td>{{$loop->iteration}}</td>
                                        <td class="product-item-img">
                                            <img src="{{asset('storage').'/'.$item['details']['image']}}" alt=""
                                                 class="img-fluid">
                                        </td>
                                        <td class="product-item-name">
                                            {{$item['name']}}&nbsp;
                                            @if($item['original_ids']['product_type'] !='accessory')
                                                -
                                                <button type="button"
                                                        class="btn btn-link"
                                                        data-bs-toggle="popover"
                                                        data-bs-placement="right"
                                                        title="تفاصيل التلبيسة"
                                                        data-bs-content="براند السيارة: {{ $item['details']['brand'] }} - الموديل: {{ $item['details']['model'] }} - عدد المقاعد: {{ $item['details']['seat_count'] }} - اللون: {{ $item['details']['color'] }} - موديل السنة: ({{ $item['details']['made_year'] }}) - هل المنتج بشنطة: {{ $item['details']['bag_option'] }}">
                                                    <span>تفاصيل المنتج</span>
                                                    <i class="fas fa-info-circle"></i>
                                                </button>
                                            @endif
                                        </td>
                                        <td class="product-item-price">{{$item['price']}}</td>
                                        <td class="product-item-quantity">
                                            <div class="quantity-input-wrapper">
                                                <button type="button" class="quantity-btn decrease"
                                                        onclick="decreaseQuantity(this)">-
                                                </button>
                                                <input type="number"
                                                       class="quantity-input"
                                                       value="{{$item['quantity']}}"
                                                       min="1"
                                                       max="99"
                                                       onchange="updateQuantity(this)"
                                                       data-id="{{ $item['id'] }}"
                                                />
                                                <button type="button" class="quantity-btn increase"
                                                        onclick="increaseQuantity(this)">+
                                                </button>
                                            </div>
                                        </td>
                                        <td class="product-item-total">{{$item['price'] * $item['quantity']}}</td>
                                        <td class="product-item-close">
                                            <a href="javascript:void(0)"
                                               class="fas fa-times remove-item"
                                               data-id="{{ $item['id'] }}"></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Mobile view -->
                    <div class="d-md-none">
                        @foreach($formattedItems as $item)
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-4">
                                            <img src="{{asset('storage').'/'.$item['details']['image']}}" alt="" class="img-fluid">
                                        </div>
                                        <div class="col-8">
                                            <h5 class="card-title">{{$item['name']}}</h5>
                                            @if($item['original_ids']['product_type'] !='accessory')
                                            <button type="button"
                                                    class="btn btn-link p-0 mb-2"
                                                    data-bs-toggle="popover"
                                                    data-bs-placement="bottom"
                                                    title="تفاصيل التلبيسة"
                                                    data-bs-content="براند السيارة: {{ $item['details']['brand'] }} - الموديل: {{ $item['details']['model'] }} - عدد المقاعد: {{ $item['details']['seat_count'] }} - اللون: {{ $item['details']['color'] }} - موديل السنة: ({{ $item['details']['made_year'] }}) - هل المنتج بشنطة: {{ $item['details']['bag_option'] }}">
                                                <span>تفاصيل المنتج</span>
                                                <i class="fas fa-info-circle"></i>
                                            </button>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-6">
                                            <p class="mb-1">سعر الوحدة:</p>
                                            <h6>{{$item['price']}}</h6>
                                        </div>
                                        <div class="col-6">
                                            <p class="mb-1">الكمية:</p>
                                            <div class="quantity-input-wrapper">
                                                <button type="button" class="quantity-btn decrease"
                                                        onclick="decreaseQuantity(this)">-
                                                </button>
                                                <input type="number"
                                                       class="quantity-input"
                                                       value="{{$item['quantity']}}"
                                                       min="1"
                                                       max="99"
                                                       onchange="updateQuantity(this)"
                                                       data-id="{{ $item['id'] }}"
                                                />
                                                <button type="button" class="quantity-btn increase"
                                                        onclick="increaseQuantity(this)">+
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-6">
                                            <p class="mb-1">الإجمالي:</p>
                                            <h6>{{$item['price'] * $item['quantity']}}</h6>
                                        </div>
                                        <div class="col-6 text-end">
                                            <a href="javascript:void(0)"
                                               class="btn btn-danger btn-sm remove-item"
                                               data-id="{{ $item['id'] }}">
                                                <i class="fas fa-trash"></i> حذف
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Summary section -->
                    <div class="summary-section card mt-4">
                        <div class="card-body">
                            <h5 class="card-title mb-4">الإجمالي</h5>
                            <div class="table-responsive">
                                <table class="table table-bordered mb-0">
                                    <tbody>
                                    <tr>
                                        <td>اجمالي الاوردر</td>
                                        <td>--</td>
                                    </tr>
                                    <tr>
                                        <td>الشحن</td>
                                        <td>مجاني</td>
                                    </tr>
                                    <tr>
                                        <td>كوبون الخصم</td>
                                        <td>--</td>
                                    </tr>
                                    <tr>
                                        <td>القيمة المضافة</td>
                                        <td>--</td>
                                    </tr>
                                    <tr>
                                        <td><strong>الإجمالي</strong></td>
                                        <td><strong>--</strong></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="d-flex flex-column flex-md-row justify-content-between mt-4 gap-3">
                                <button class="btn site-button order-2 order-md-2" onclick="window.history.back()">
                                    العودة للصفحة السابقة <i class="fa fa-arrow-circle-left"></i>
                                </button>
                                <button class="btn site-button order-1 order-md-1">
                                    التوجه لصفحة الدفع
                                </button>
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
        .product-item-close a {
            width: 25px !important;
            height: 25px !important;
            line-height: 25px !important;
        }

        .product-item-close .remove-item {
            font-size: 0.7em; /* حجم الأيقونة */
        }

        @media (max-width: 767px) {
            .quantity.btn-quantity {
                max-width: 100px;
                margin: 0;
            }

            .card-title {
                font-size: 1.1rem;
                margin-bottom: 0.5rem;
            }

            .table-responsive {
                margin-bottom: 0;
            }

            .btn-quantity input {
                height: 35px;
            }

            .breadcrumb-row {
                padding: 10px 0;
            }

            .section-full {
                padding: 40px 0;
            }

            .dlab-bnr-inr {
                padding: 40px 0;
            }
        }

        /* General improvements */
        .table > :not(caption) > * > * {
            padding: 1rem;
        }

        .product-item-img img {
            max-width: 80px;
            height: auto;
        }

        .quantity input {
            text-align: center;
        }

        .card {
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .site-button {
            min-width: 160px;
        }

        .summary-section {
            margin-top: 50px !important;
        }

        /*quantity Button*/
        /* Enhanced Quantity Input Styles */
        .quantity-input-wrapper {
            display: flex;
            align-items: center;
            max-width: 100px;
            border: 1px solid #ddd;
            border-radius: 4px;
            overflow: hidden;
        }

        .quantity-input {
            width: 50px;
            text-align: center;
            border: none;
            padding: 5px;
            -moz-appearance: textfield; /* Remove default arrows in Firefox */
        }

        .quantity-input::-webkit-outer-spin-button,
        .quantity-input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .quantity-btn {
            background: #f8f9fa;
            border: none;
            padding: 5px 8px;
            cursor: pointer;
            color: #666;
            transition: background-color 0.2s;
        }

        .quantity-btn:hover {
            background: #e9ecef;
        }

        .quantity-btn:active {
            background: #dee2e6;
        }

        @media (max-width: 767px) {
            .quantity-input-wrapper {
                max-width: 90px;
            }

            .quantity-input {
                width: 40px;
                padding: 4px;
            }

            .quantity-btn {
                padding: 4px 6px;
            }
        }
    </style>

@endpush
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
            var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
                return new bootstrap.Popover(popoverTriggerEl)
            })
        });

        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            // عند الضغط على زر الحذف
            $('.remove-item').on('click', function (e) {
                e.preventDefault();

                const itemId = $(this).data('id');
                const row = $(this).closest('tr');

                $.ajax({
                    url: '{{route('cart.remove',':id')}}'.replace(':id', itemId),
                    method: 'post',
                    success: function (response) {
                        if (response.success === true) {
                            // حذف الصف من الجدول
                            row.fadeOut(300, function () {
                                $(this).remove();

                                // إذا كانت السلة فارغة
                                if ($('tr.alert').length === 0) {
                                    location.reload(); // أو عرض رسالة أن السلة فارغة
                                }
                            });

                            // تحديث عدد العناصر في السلة في الهيدر (إذا كان موجود)
                            // $('.cart-count').text(response.cart_count);

                            // عرض رسالة نجاح
                            toastr.success(response.message);
                        }
                    },
                    error: function () {
                        toastr.error('حدث خطأ أثناء حذف المنتج');
                    }
                });
            });
        });

        function increaseQuantity(btn) {
            const input = btn.parentElement.querySelector('.quantity-input');
            if (input.value < parseInt(input.max)) {
                input.value = parseInt(input.value) + 1;
                updateQuantity(input);
            }
        }

        function decreaseQuantity(btn) {
            const input = btn.parentElement.querySelector('.quantity-input');
            if (input.value > parseInt(input.min)) {
                input.value = parseInt(input.value) - 1;
                updateQuantity(input);
            }
        }


        function updateQuantity(input) {
            const itemId = input.dataset.id;
            const quantity = parseInt(input.value);


            // You might want to add your AJAX logic here:
            /*
            axios.post('/cart/update', {
                id: itemId,
                quantity: quantity
            }).then(response => {
                // Update total price, etc.
            }).catch(error => {
                console.error('Error updating quantity:', error);
            });
            */
        }
    </script>
@endpush
