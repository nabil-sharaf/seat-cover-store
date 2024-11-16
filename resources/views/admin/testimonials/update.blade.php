@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="card mt-4">
            <div class="card-header">
                <h4 class="mb-0">{{ isset($testimonial) ? 'تعديل التقييم' : 'إضافة تقييم جديد' }}</h4>
            </div>

            <div class="card-body">
                <form action="{{ isset($testimonial) ? route('admin.testimonials.update', $testimonial->id) : route('admin.testimonials.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if(isset($testimonial))
                        @method('PUT')
                    @endif

                    <div class="form-group">
                        <label>اسم العميل</label>
                        <input type="text" name="client_name" value="{{ old('client_name', $testimonial->client_name ?? '') }}" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>تعليق العميل</label>
                        <textarea name="testimonial" class="form-control" rows="4" required>{{ old('testimonial', $testimonial->testimonial ?? '') }}</textarea>
                    </div>

{{--                    <div class="form-group">--}}
{{--                        <label>صورة العميل</label>--}}
{{--                        <input type="file" name="client_image" class="form-control-file">--}}
{{--                        @if(isset($testimonial) && $testimonial->client_image)--}}
{{--                            <div class="mt-2">--}}
{{--                                <img src="{{ asset('storage/' . $testimonial->client_image) }}" width="100" height="100" class="img-thumbnail">--}}
{{--                            </div>--}}
{{--                        @endif--}}
{{--                    </div>--}}

                    <button type="submit" class="btn btn-success mt-3 w-100">{{ isset($testimonial) ? 'تحديث' : 'إضافة' }}</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .card {
            max-width: 600px;
            margin: 0 auto;
        }
    </style>
@endpush
