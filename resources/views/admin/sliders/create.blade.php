@extends('admin.layouts.app')

@section('page-title')
    السلايدرز
@endsection

@section('content')
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title float-left">  اضافة سلايدر جديد</h3>
        </div>

        <!-- عرض الرسائل -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- نموذج إدارة السلايدر -->
        <form action="{{ route('admin.sliders.store') }}" method="POST" enctype="multipart/form-data" class="form-horizontal" dir="rtl">
            @csrf
            <div class="card-body">
                <!-- العنوان -->
                <div class="form-group row">
                    <label for="title" class="col-sm-2 control-label">العنوان:</label>
                    <div class="col-sm-10">
                        <input type="text" name="title" value="{{ old('title') }}" class="form-control @error('title') is-invalid @enderror" placeholder="أدخل عنوان السلايدر">
                        @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- النص -->
                <div class="form-group row mt-4">
                    <label for="slider-text" class="col-sm-2 control-label">النص:</label>
                    <div class="col-sm-10">
                        <textarea id='slider-text' name="description" class="form-control @error('description') is-invalid @enderror" rows="4" placeholder="أدخل نص السلايدر">{{ old('description') }}</textarea>
                        @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- الصورة -->
                <div class="form-group row mt-4">
                    <label for="image" class="col-sm-2 control-label">الصورة:</label>
                    <div class="col-sm-10">
                        <input type="file" name="image" class="form-control-file @error('image') is-invalid @enderror" id="imageInput" onchange="previewImage(event)">
                        @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <img id="imagePreview" alt="معاينة الصورة" class="img-thumbnail mt-3" style="height: 150px; display: none;">
                    </div>
                </div>

                <!-- نص الزر -->
                <div class="form-group row mt-4">
                    <label for="button_text" class="col-sm-2 control-label">نص الزر:</label>
                    <div class="col-sm-10">
                        <input type="text" name="button_text" value="{{ old('button_text','اطلب الآن') }}" class="form-control @error('button_text') is-invalid @enderror" placeholder="أدخل نص الزر">
                        @error('button_text')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- رابط الزر -->
                <div class="form-group row mt-4">
                    <label for="button_link" class="col-sm-2 control-label">رابط الزر:</label>
                    <div class="col-sm-10">
                        <input type="text" name="button_link" value="{{ old('button_link') }}" class="form-control @error('button_link') is-invalid @enderror" placeholder="أدخل رابط الزر">
                        @error('button_link')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- زر الحفظ -->
            <div class="card-footer">
                <button type="submit" class="btn btn-info float-right">حفظ التعديلات</button>
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
