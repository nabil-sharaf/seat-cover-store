@extends('admin.layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">تعديل براند: {{ $brand->brand_name }}</h3>
        </div>

        <!-- /.card-header -->
        <div class="card-body">
            <form action="{{ route('admin.car-brands.update', $brand->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- حقل اسم البراند -->
                <div class="form-group">
                    <label for="brand_name">اسم البراند</label>
                    <input type="text" name="brand_name" id="brand_name" class="form-control @error('brand_name') is-invalid @enderror" value="{{ old('brand_name', $brand->brand_name) }}" required>

                    @error('brand_name')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <!-- أزرار الحفظ والإلغاء -->
                <div class="d-flex justify-content-between align-items-center">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save mr-1"></i> حفظ التغييرات
                    </button>
                    <a href="{{ route('admin.car-brands.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left mr-1"></i> إلغاء
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
