@extends('admin.layouts.app')
@section('page-title')
    الإكسسوارات
@endsection

@section('content')
    <!-- /.card -->
    <div class="card">
        <div class="card-header">
            <div class="d-flex flex-wrap justify-content-between align-items-center">
                <!-- زر إضافة اكسسوار جديد -->
                <a href="{{ route('admin.accessories.create') }}" class="btn btn-primary mb-2">
                    <i class="fas fa-plus mr-1"></i> إضافة اكسسوار
                </a>

                <!-- مربع البحث -->
                <form action="{{ route('admin.accessories.index') }}" method="GET" class="form-inline mb-2">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="ابحث عن منتج..." value="{{ request('search') }}">
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
                        <th>اسم المنتج</th>
                        <th>صورة المنتج</th>
                        <th>السعر</th>
                        <th>قيمة الخصم</th>
                        <th> القسم</th>
                        <th>العمليات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($accessories as $accessory)
                        <tr>
                            <td>{{ $loop->iteration }}.</td>
                            <td>{{ $accessory->name }}</td>
                            <td>
                                @if($accessory->images)

                                    <img src="{{ asset('storage/' . $accessory->images[0]) }}" alt="{{ $accessory->name }}" class="img-fluid img-hover-zoom">
                                @else
                                    <span>لا توجد صورة</span>
                                @endif
                            </td>
                            <td>{{ $accessory->price }}</td>
                            <td>{{$accessory->discount ? $accessory->discount->discount_value.($accessory->discount->discount_type == 'fixed' ? ' ر.س  ':' % ') : 'لا يوجد' }}</td>
                            <td>{{ $accessory->category->name }}</td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <a href="{{ route('admin.accessories.show', $accessory->id) }}" class="btn btn-sm btn-warning mb-1 mr-1">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.accessories.edit', $accessory->id) }}" class="btn btn-sm btn-info mb-1 mr-1">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    @if(auth('admin')->user()->hasAnyRole(['superAdmin']))
                                        <button type="button" class="btn btn-sm btn-danger delete-accessory-btn mb-1" data-id="{{ $accessory->id }}">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">لا يوجد اكسسوارات حاليا</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.card-body -->

        <!-- Pagination -->
        <div class="card-footer">
            {{ $accessories->appends(request()->input())->links('vendor.pagination.custom') }}
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
            // حذف اكسسوار منفرد
            $('.delete-accessory-btn').on('click', function() {
                if (confirm('هل أنت متأكد من حذف هذا الاكسسوار؟')) {
                    var accessoryId = $(this).data('id');
                    var url = "{{ route('admin.accessories.destroy', ':id') }}".replace(':id', accessoryId);
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
                            alert('حدث خطأ أثناء محاولة حذف الاكسسوار');
                        }
                    });
                }
            });
        });
    </script>
@endpush


