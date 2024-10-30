@extends('admin.layouts.app')

@section('page-title')
    تفاصيل المنتج: {{ $accessory->name }}
@endsection

@section('content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h2 class="mb-0">{{ $accessory->name }}</h2>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        @if($accessory->images)
                            <div class="product-image-gallery">
                                <div class="swiper-container">
                                    <div class="swiper-wrapper">
                                        @foreach($accessory->images as $image)
                                            <div class="swiper-slide">
                                                <img src="{{ asset('storage/' . $image) }}" alt="{{ $accessory->name }}">
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="swiper-pagination"></div>
                                    <div class="swiper-button-next"></div>
                                    <div class="swiper-button-prev"></div>
                                </div>
                            </div>
                        @else
                            <div class="alert alert-info">لا توجد صور للمنتج</div>
                        @endif
                    </div>
                    <div class="col-md-6">

                        <h4 class="text-primary mt-4">التفاصيل</h4>
                        <ul class="list-group">
                            <li class="list-group-item"><strong>السعر:</strong> {{ $accessory->price }}  ج</li>
                            <li class="list-group-item"><strong>الكمية المتاحة:</strong> {{ $accessory->quantity }}</li>
                            <li class="list-group-item"><strong>القسم:</strong> {{ $accessory->category->name}}</li>
                        </ul>

                        <h4 class="text-primary">الوصف</h4>
                        <p>{!! $accessory->description ?? ' لا يوجد ' !!}</p>

                        <h4 class="text-primary text-decoration-underline">معلومات وتفاصيل اضافية:- </h4>
                        <p>{!! $accessory->info ?? 'لا يوجد' !!}  </p>



                    </div>
                </div>

                <div class="mt-4">
                    <a href="{{ route('admin.products.edit', $accessory->id) }}" class="btn btn-warning">تعديل</a>
                    <form action="{{ route('admin.products.destroy', $accessory->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('هل أنت متأكد من حذف هذا المنتج؟')">حذف</button>
                    </form>
                    <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">العودة للقائمة</a>
                </div>
            </div>
        </div>
    </div>

    <style>
        .product-image-gallery {
            width: 100%;
            height: 400px;
            background-color: #f8f9fa;
            border-radius: 8px;
            overflow: hidden;
        }
        .swiper-container {
            width: 100%;
            height: 100%;
        }
        .swiper-slide {
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .swiper-slide img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }

        .swiper-button-prev ,.swiper-button-next{
            top:200px;
        }
    </style>

@endsection

@push('scripts')
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            new Swiper('.swiper-container', {
                loop: true,
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
            });
        });
    </script>
@endpush
