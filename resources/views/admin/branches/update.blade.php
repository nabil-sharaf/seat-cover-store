@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="card mt-4">
            <div class="card-header">
                <h4 class="mb-0">{{ isset($branch) ? 'تعديل الفرع' : 'إضافة فرع جديد' }}</h4>
            </div>

            <div class="card-body">
                <form action="{{ isset($branch) ? route('admin.branches.update', $branch->id) : route('admin.branches.store') }}" method="POST" >
                    @csrf
                    @if(isset($branch))
                        @method('PUT')
                    @endif

                    <div class="form-group">
                        <label>اسم الفرع</label>
                        <input type="text" name="name" value="{{ old('name', $branch->name ?? '') }}" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>تليفون الفرع</label>
                        <input type="text" name="phone" value="{{ old('phone', $branch->phone ?? '') }}" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>العنوان</label>
                        <textarea name="address" class="form-control" rows="2" required>{{ old('address', $branch->address ?? '') }}</textarea>
                    </div>

                    <div class="form-group">
                        <label>رابط الخريطة</label>
                        <input type="url" name="map" value="{{ old('map', $branch->map ?? '') }}" class="form-control" placeholder="https://maps.google.com/...">
                    </div>

                    <button type="submit" class="btn btn-success mt-3 w-100">{{ isset($branch) ? 'تحديث' : 'إضافة' }}</button>
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
