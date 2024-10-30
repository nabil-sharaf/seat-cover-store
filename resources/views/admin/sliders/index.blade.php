@extends('admin.layouts.app')

@section('page-title')
    slider
@endsection

@section('content')
    <div class="container mt-5">
        <h2 class="mb-4">إدارة الـ slider</h2>

        <!-- عرض الرسائل -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- نموذج إدارة السلايدر -->
        <form action="{{ route('admin.sliders.update',$slider->id) }}" method="POST" enctype="multipart/form-data" class="row g-4">
            @csrf
            @method('PUT')

            <!-- العنوان -->
            <div class="col-md-6">
                <label for="title" class="form-label">العنوان:</label>
                <input type="text" name="title" value="{{ old('title', $slider->title ?? '') }}" class="form-control @error('title') is-invalid @enderror" placeholder="أدخل عنوان السلايدر">
                @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- النص -->
            <div class="col-md-12">
                <label for="slider-text" class="form-label">النص:</label>
                <textarea id='slider-text' name="text" class="form-control @error('text') is-invalid @enderror" rows="4" placeholder="أدخل نص السلايدر">{{ old('text', $slider->description ?? '') }}</textarea>
                @error('text')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- الصورة -->
            <div class="col-md-6">
                <label for="image" class="form-label">الصورة:</label>
                <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" id="imageInput" onchange="previewImage(event)">
                @error('image')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                @if(isset($slider->image))
                    <img id="imagePreview" src="{{ asset('storage/' . $slider->image) }}" alt="صورة السلايدر" class="img-fluid mt-3" style="max-height: 150px;">
                @else
                    <img id="imagePreview" alt="معاينة الصورة" class="img-fluid mt-3" style="max-height: 150px; display: none;">
                @endif
            </div>

            <!-- نص الزر -->
            <div class="col-md-6">
                <label for="button_text" class="form-label">نص الزر:</label>
                <input type="text" name="button_text" value="{{ old('button_text', $slider->button_text ?? '') }}" class="form-control @error('button_text') is-invalid @enderror" placeholder="أدخل نص الزر">
                @error('button_text')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- رابط الزر -->
            <div class="col-md-6">
                <label for="button_link" class="form-label">رابط الزر:</label>
                <input type="text" name="button_link" value="{{ old('button_link', $slider->button_link ?? '') }}" class="form-control @error('button_link') is-invalid @enderror" placeholder="أدخل رابط الزر">
                @error('button_link')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- زر الحفظ -->
            <div class="col-12 text-center">
                <button type="submit" class="btn btn-primary mt-4">حفظ التعديلات</button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        function previewImage(event) {
            var imagePreview = document.getElementById('imagePreview');
            var file = event.target.files[0];

            if (file) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    imagePreview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            }
        }
    </script>
@endpush
