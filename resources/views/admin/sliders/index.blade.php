@extends('admin.layouts.app')
@section('page-title')
    السلايدرز
@endsection

@section('content')
    <!-- /.card -->
    <div class="card">
        <div class="card-header">
            <div class="d-flex flex-wrap justify-content-between align-items-center">
                <!-- زر إضافة سلايدر جديد -->
                <a href="{{ route('admin.sliders.create') }}" class="btn btn-primary mb-2">
                    <i class="fas fa-plus mr-1"></i> إضافة سلايدر
                </a>

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
                        <th>الصورة</th>
                        <th>العنوان</th>
                        <th>النص</th>
                        <th>نص الزر</th>
                        <th>رابط الزر</th>
                        <th>العمليات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($sliders as $slider)
                        <tr>
                            <td class="align-middle">{{ $loop->iteration }}.</td>
                            <td class="align-middle">
                                @if($slider->image)
                                    <img src="{{ asset('storage/' . $slider->image) }}" alt="صورة السلايدر" class="img-fluid img-hover-zoom" style="height:40px">
                                @else
                                    <span>لا توجد صورة</span>
                                @endif
                            </td>
                            <td class="align-middle"> {{ \Str::limit($slider->title, 20, '...') }}</td>
                            <td class="align-middle">{{ \Str::limit($slider->description, 30, '...') }}</td>
                            <td class="align-middle">{{ $slider->button_text }}</td>
                            <td class="align-middle"><a href="{{ $slider->button_link }}" target="_blank">{{ $slider->button_link }}</a></td>
                            <td class="align-middle">
                                <div class="d-flex justify-content-center">
                                    <a href="{{ route('admin.sliders.edit', $slider->id) }}" class="btn btn-sm btn-info mb-1 mr-1">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    @if(auth('admin')->user()->hasAnyRole(['superAdmin']))
                                        <form action="{{ route('admin.sliders.destroy', $slider->id) }}" method="POST" class="d-inline delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-sm btn-danger delete-slider-btn mb-1" data-id="{{ $slider->id }}">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">لا يوجد سلايدرز حاليا</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.card-body -->

        <!-- Pagination -->
        <div class="card-footer">
        </div>
    </div>
@endsection
@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.css">
@endpush
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.delete-slider-btn').on('click', function(e) {
                e.preventDefault();
                let id = $(this).data('id');

                if (confirm('هل أنت متأكد من حذف هذا السلايدر؟')) {
                    $(this).closest('form').submit();
                }
                // Swal.fire({
                //     title: 'هل أنت متأكد؟',
                //     text: "لن تتمكن من التراجع عن هذا الإجراء!",
                //     icon: 'warning',
                //     showCancelButton: true,
                //     confirmButtonColor: '#3085d6',
                //     cancelButtonColor: '#d33',
                //     confirmButtonText: 'نعم، احذف!',
                //     cancelButtonText: 'إلغاء'
                // }).then((result) => {
                //     if (result.isConfirmed) {
                //         // في حالة التأكيد، قم بتقديم نموذج الحذف
                //         $(this).closest('form').submit();
                //     }
                // });
            });
        });
    </script>
@endpush
