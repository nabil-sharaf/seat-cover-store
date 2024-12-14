@extends('admin.layouts.app')
@section('page-title')
    تفاصيل الطلب
@endsection


@section('content')
    <div class="card">
        <div
            class="card-header @if($order->status->id == 3) bg-success pb-0 @elseif($order->status->id == 4) pb-0 bg-danger @endif">
            <h3 class="card-title pb-0 float-left">تفاصيل الطلب رقم #{{ $order->id }}</h3>
            @if($order->status->id == 3)
                <span class="badge badge-light float-right mr-4">   &nbsp;الطلب مكتمل &nbsp;✅</span>
            @endif
            @if($order->status->id == 4)
                <span class="badge badge-light float-right mr-4">   &nbsp;الطلب ملغي &nbsp;❌</span>
            @endif
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p class="customerName"><strong>المستخدم:</strong> {{ $order?->user?->name ?? 'Guest' }}</p>
                    <p><strong>اسم العميل:</strong> {{ $address->full_name ?? null}}</p>
                    <p><strong>رقم التليفون:</strong> {{ $address->phone ?? null }}</p>
                    <p><strong>العنوان:</strong> {{ $address->address ?? null }}</p>
                    <p><strong>المدينة :</strong> {{ $address->city ?? null }} &nbsp;-<strong> &nbsp;المحافظة
                            :</strong> {{ $address->state ?? null }} </p>
                    <p><strong> إجمالي الطلب :</strong> {{$order->final_total}} ر.س </p>
                    <p class="status-now"><strong>حالة الطلب :</strong> {{ ucfirst($order->status->name) }}</p>
                </div>
                <div class="col-md-6 status-now">
                    @if($order->status->id != 3 && $order->status->id != 4)
                        <form id="statusForm" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group" id="statusGroup">
                                <label for="status">تغيير حالة الطلب:</label>
                                <select name="status" id="status" class="select2 form-control" style="width: 60%">
                                    <option id="processing" value="1" {{ $order->status->id == 1 ? 'selected' : '' }}>
                                        جاري المعالجة
                                    </option>
                                    <option value="2" {{ $order->status->id == 2 ? 'selected' : '' }}>جاري الشحن
                                    </option>
                                    <option value="3" {{ $order->status->id == 3 ? 'selected' : '' }}>تم التسليم
                                    </option>
                                    <option value="4" {{ $order->status->id == 4 ? 'selected' : '' }}>ملغي</option>
                                </select>
                            </div>
                        </form>
                    @elseif($order->status->id == 3)
                        <div class="alert alert-success p-1">
                            الطلب تم تسليمه بنجاح ✅
                        </div>
                    @elseif($order->status->id == 4)
                        <div class="alert alert-danger p-1">
                            الطلب ملغي ❌
                        </div>
                    @endif

                </div>
            </div>
            <hr>
            <h4>المنتجات في هذا الطلب:</h4>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>المنتج</th>
                        <th class="text-center">النوع</th>
                        <th class="text-center">الكمية</th>
                        <th class="text-center">السعر</th>
                        <th class="text-center">الإجمالي</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($order->orderDetails as $detail)
                        <tr>
                            @if($detail->product_type == 'accessory')
                                <td>{{ $detail->accessory->name }}</td>
                                <td class="text-center">اكسسوار</td>
                            @elseif($detail->product_type =='earth')
                                <td>{{$detail->category->name.' - '.
                             $detail->coverColor->name .' '.
                             $detail->coverColor->tatriz_color.' - '.
                             ' نوع السيارة '.
                             '('.$detail->brand->brand_name . ' : '.$detail->model->model_name.') '}}<br/>
                                    سنة الصنع:({{$detail->made_years}}) -
                                    {{$detail->seatCount->name.' - '}}
                                    {{$detail->bag_option ==1?'  بشنطة ' : ' بدون شنطة '}}
                                </td>
                                <td class="text-center">أرضيات</td>
                            @else
                                <td>{{$detail->category->name.' - '.
                             $detail->coverColor->name .' '.
                             $detail->coverColor->tatriz_color.' - '.
                             ' نوع السيارة '.
                             '('.$detail->brand->brand_name . ' : '.$detail->model->model_name.') '}}<br/>
                                    سنة الصنع:({{$detail->made_years}}) -
                                {{$detail->seatCount->name}}
                                <td class="text-center">مقاعد</td>
                            @endif
                            <td class="text-center">{{ $detail->quantity }}</td>
                            <td class="text-center">{{ $detail->unit_price }} ر.س</td>
                            <td class="text-center">{{ $detail->quantity * $detail->unit_price }} ر.س</td>
                        </tr>
                    @endforeach

                    @if($order->user_id)
                        @if(($order->promo_discount) > 0)
                            <tr class="">
                                <td colspan="4" class="text-left font-weight-bold">اجمالي سعر المنتجات</td>
                                <td class="table-active text-center font-weight-bold">{{ $order->total_price }} ر.س</td>
                            </tr>
                            <tr>
                                <td colspan="4" class="text-left font-weight-bold">قيمة خصم الكوبون</td>
                                <td class="text-center font-weight-bold">
                                    {{$order->promo_discount > 0 ? $order->promo_discount.'  ر.س ' : ' --- '}}
                                </td>
                            </tr>
                        @endif
                    @endif
                    <tr>
                        <td colspan="4" class="text-left font-weight-bold">
                            تكاليف الشحن
                        </td>
                        <td colspan="2"
                            class="font-weight-bold text-center">{{$order->shipping_cost > 0 ? $order->shipping_cost.' ر.س ' :'لا يوجد' }}</td>
                    </tr>
                    <tr>
                        <td colspan="4" class="text-left font-weight-bold">
                            ضريبة القيمة المضافة {{\App\Models\Admin\Setting::getValue('tax_rate') . ' %'}}
                        </td>
                        <td colspan="2"
                            class="font-weight-bold text-center">{{$order->tax_amount > 0 ? $order->tax_amount.' ر.س ' :'لا يوجد' }}</td>
                    </tr>
                    <tr class="table-info">
                        <td colspan="4" class="text-left font-weight-bold">
                            {{ ( $order->promo_discount > 0) ? 'السعر الإجمالي للاوردر' : 'إجمالي الطلب' }}
                        </td>
                        <td colspan="2" class="font-weight-bold text-center">{{ $order->final_total }} ر.س</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">
            <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">رجوع إلى قائمة الطلبات</a>
            <button onclick="window.print()" class="btn btn-outline-primary float-right">
                طباعة <i class="fas fa-print"></i>
            </button>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function () {
            $('#status').on('change', function () {
                var formData = $('#statusForm').serialize();
                var url = '{{ route("admin.orders.updatestatus", $order->id) }}';
                let status = $('#status').val();

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: formData,
                    success: function (response) {
                        toastr.success('تم تحديث الحالة بنجاح!');
                        if (status == 2) {
                            $('#processing').remove();
                        }
                        if (status == 3) {
                            $('#statusForm').replaceWith('<div class="alert alert-success p-1">تم تسليم الاوردر ✅</div>')
                        }
                        if (status == 4) {
                            $('#statusForm').replaceWith('<div class="alert alert-danger p-1"> تم الغاء الطلب ❌</div>')
                        }

                    },
                    error: function (xhr, status, error) {
                        toastr.error('حدث خطأ أثناء تحديث الحالة.');
                    }
                });
            });
        });
    </script>
@endpush
@push('styles')
    <style>

        @media screen and (min-width: 768px) {
            .table-responsive {
                overflow-x: visible;
            }
        }

        @media screen and (max-width: 767px) {
            .table-responsive {
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }

            .table {
                min-width: 800px;
            }
        }

        .table {
            margin-bottom: 1rem;
            background-color: transparent;
            border-collapse: collapse;
        }

        .table thead th {
            background-color: #f8f9fa;
            border-bottom: 2px solid #dee2e6;
            padding: 0.75rem;
            vertical-align: middle;
            font-weight: 600;
            white-space: nowrap;
        }

        .table tbody td {
            padding: 0.75rem;
            vertical-align: middle;
            border: 1px solid #dee2e6;
        }

        .table-bordered {
            border: 1px solid #dee2e6;
        }

        .table-info td {
            background-color: #e6f3f8 !important;
        }

        .table tr:hover {
            background-color: rgba(0,0,0,.02);
        }

        /* تنسيق الأعمدة */
        .table td:nth-child(1) {
            min-width: 300px;
        }

        .table td:nth-child(2) {
            min-width: 100px;
        }

        .table td:nth-child(3),
        .table td:nth-child(4),
        .table td:nth-child(5) {
            min-width: 120px;
        }

        /* تنسيق الصفوف الإجمالية */
        .table tr.table-info td {
            font-weight: bold;
            border-top: 2px solid #dee2e6;
        }

        /* تنسيق خاص للطباعة */
        @media print {
            .table {
                width: 100% !important;
                min-width: auto !important;
            }

            .table td,
            .table th {
                padding: 0.5rem !important;
            }
            .btn, .card-footer, #statusGroup, title, .customerName, .status-now {
                display: none !important;
            }

            .card {
                border: none;
            }

            /* نقل الوقت إلى اليمين */
            body::before {
                content: '';
                display: block;
                position: absolute;
                top: 10px;
                right: 10px; /* تحريك الوقت إلى اليمين */
                text-align: right;
            }
        }

    </style>
@endpush
