@extends('admin.layouts.app')
@section('page-title')
    المنتجات
@endsection

@section('content')
    <!-- /.card -->
    <div class="card">
        <div class="card-header">
            <div class="d-flex flex-wrap justify-content-between align-items-center">
                <!-- زر إضافة منتج جديد -->
                <a href="{{ route('admin.products.create') }}" class="btn btn-primary mb-2">
                    <i class="fas fa-plus mr-1"></i> إضافة لون جديد
                </a>

                <!-- مربع البحث -->
                <form action="{{ route('admin.products.index') }}" method="GET" class="form-inline mb-2">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="ابحث عن لون..." value="{{ request('search') }}">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-outline-secondary">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.card-header -->

        <!-- .card-body -->
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover text-center table-sm">
                    <thead class="thead-light">
                    <tr>
                        <th>#</th>
                        <th>لون التلبيسة</th>
                        <th>لون التطريز</th>
                        <th>صورة التلبيسة</th>
                        <th>نوع التلبيسة</th>
                        <th>الحالة</th>
                        <th>العمليات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($products as $product)
                        <tr>
                            <td>{{ $loop->iteration }}.</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->tatriz_color }}</td>
                            <td>
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="img-fluid img-hover-zoom">
                                @else
                                    <span>لا توجد صورة</span>
                                @endif
                            </td>
                            <td>{{ $product->category->name }}</td>
                            <td>{{ $product->status == 1 ? 'متاح' : 'غير متاح' }}</td>
                            <td>
                                <div class="d-flex justify-content-center">
{{--                                    <a href="{{ route('admin.products.show', $product->id) }}" class="btn btn-sm btn-warning mb-1 mr-1">--}}
{{--                                        <i class="fas fa-eye"></i>--}}
{{--                                    </a>--}}
                                    <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-sm btn-info mb-1 mr-1">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    @if(auth('admin')->user()->hasAnyRole(['superAdmin']))
                                        <button type="button" class="btn btn-sm btn-danger delete-product-btn mb-1" data-id="{{ $product->id }}">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">لا يوجد منتجات حاليا</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.card-body -->

        <!-- Pagination -->
        <div class="card-footer">
            {{ $products->appends(request()->input())->links('vendor.pagination.custom') }}
        </div>
    </div>
@endsection

@push('styles')

    <style>
        .table-responsive-md {
            overflow-x: auto;
            /* تحسين التمرير الأفقي على الشاشات الصغيرة */
        }
        .btn-sm {
            padding: 0.25rem 0.5rem;
            font-size: 0.75rem;
        }

        .img-hover-zoom {
            transition: transform 0.6s ease; /* إضافة تأثير انتقالي ناعم */
            width: 40px; /* حجم الصورة الطبيعي */
            height: 40px;
        }

        .img-hover-zoom:hover {
            transform: scale(6); /* تكبير الصورة عند المرور */
            z-index: 10; /* رفع مستوى العنصر عند التكبير */
        }
    </style>
@endpush
@push('scripts')
    <script>
        $(document).ready(function() {
            // تحديد كل المنتجات
            $('#select-all').click(function() {
                $('.product-checkbox').prop('checked', this.checked);
            });

            // تنفيذ عملية الحذف الجماعي
            $('#delete-selected').click(function() {

                var selected = [];
                url = "{{ route('admin.products.deleteAll') }}";

                $('.product-checkbox:checked').each(function() {
                    selected.push($(this).val());
                });

                if (selected.length > 0) {
                    if (confirm('هل أنت متأكد من حذف المنتجات المحددة؟')) {
                        $.ajax({
                            url: url,
                            type: 'DELETE',
                            data: {
                                "_token": "{{ csrf_token() }}",
                                "ids": selected
                            },
                            success: function(response) {
                                toastr.error(response.success);
                                $('.product-checkbox:checked').closest('tr').remove();
                            },
                            error: function(response) {
                               console.log(response);
                            }
                        });

                    }
                } else {
                    alert('لم يتم تحديد أي منتجات');
                }
            });
            $('#trend-selected').click(function() {

                var selected = [];
                url = "{{ route('admin.products.trendAll') }}";

                $('.product-checkbox:checked').each(function() {
                    selected.push($(this).val());
                });

                if (selected.length > 0) {
                    if (confirm('هل أنت متأكد من جعل المنتجات المحددة ترند؟')) {
                        $.ajax({
                            url: url,
                            type: 'PUT',
                            data: {
                                "_token": "{{ csrf_token() }}",
                                "ids": selected
                            },
                            success: function(response) {
                                toastr.success(response.success);
                            },
                            error: function(response) {
                               console.log(response);
                            }
                        });

                    }
                } else {
                    alert('لم يتم تحديد أي منتجات');
                }
            });
            $('#best-seller-selected').click(function() {

                var selected = [];
                url = "{{ route('admin.products.bestSellerAll') }}";

                $('.product-checkbox:checked').each(function() {
                    selected.push($(this).val());
                });

                if (selected.length > 0) {
                    if (confirm('هل أنت متأكد من جعل المنتجات المحددة الأفضل')) {
                        $.ajax({
                            url: url,
                            type: 'PUT',
                            data: {
                                "_token": "{{ csrf_token() }}",
                                "ids": selected
                            },
                            success: function(response) {
                                toastr.success(response.success);
                            },
                            error: function(response) {
                                toastr.error(response.error);
                            }
                        });

                    }
                } else {
                    alert('لم يتم تحديد أي منتجات');
                }
            });

            // حذف منتج منفرد
            $('.delete-product-btn').on('click', function() {
                if (confirm('هل أنت متأكد من حذف هذا المنتج؟')) {
                    var productId = $(this).data('id');
                    var url = "{{ route('admin.products.destroy', ':id') }}".replace(':id', productId);
                    var tr = $(this).closest('tr');
                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        data: {
                            "_token": "{{ csrf_token() }}",
                        },
                        success: function(response) {
                            toastr.error(response.success);
                            // إزالة الصف من الجدول إذا تم الحذف بنجاح
                            tr.remove();
                        },
                        error: function(response) {
                            alert('حدث خطأ أثناء محاولة حذف المنتج');
                        }
                    });
                }
            });
        });
    </script>
@endpush


