@extends('admin.layouts.app')
@section('page-title')
    شهادات العملاء
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex flex-wrap justify-content-between align-items-center">
                <a href="{{ route('admin.testimonials.create') }}" class="btn btn-primary mb-2">
                    <i class="fas fa-plus mr-1"></i> إضافة تعليق جديد
                </a>
            </div>
        </div>
        <!-- /.card-header -->

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover text-center table-sm">
                    <thead class="thead-light">
                    <tr>
                        <th>#</th>
                        <th>الاسم</th>
                        <th>تعليق العميل</th>
{{--                        <th>الصورة</th>--}}
                        <th>العمليات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($testimonials as $index => $testimonial)
                        <tr>
                            <td class="align-middle">{{ $index + 1 }}.</td>
                            <td class="align-middle">{{ $testimonial->client_name }}</td>
                            <td class="align-middle">{{ $testimonial->testimonial }}</td>
{{--                            <td class="align-middle">--}}
{{--                                <img src="{{ asset('storage/' . $testimonial->client_image) }}" width="50" height="50">--}}
{{--                            </td>--}}
                            <td class="align-middle">
                                <div class="d-flex justify-content-center">
                                    <a href="{{ route('admin.testimonials.edit', $testimonial->id) }}" class="btn btn-sm btn-info mb-1 mr-1">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.testimonials.destroy', $testimonial->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger mb-1" onclick="return confirm('هل أنت متأكد من الحذف؟')">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            {{ $testimonials->links('vendor.pagination.custom') }}
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .card-footer {
            text-align: center;
        }
        .card-footer ul {
            float: unset !important;
        }
    </style>
@endpush