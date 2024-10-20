@extends('admin.layouts.app')

@section('page-title')
    الألوان والتطريزات
@endsection

@section('content')
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title float-left">إضافة الوان  تلبيسة</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form id="product-form" class="form-horizontal" enctype="multipart/form-data" dir="rtl">
            @csrf
            <div class="card-body">
                <!-- لون  التلبيسة -->
                <div class="form-group row">
                    <label for="inputName" class="col-sm-2 control-label">لون التلبيسة</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="inputName" placeholder="أدخل لون التلبيسة " name='name' value="{{ old('name') }}">
                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                <!-- لون التطريز -->
                <div class="form-group row">
                    <label for="inputTatriz" class="col-sm-2 control-label">لون التطريز</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('tatriz_color') is-invalid @enderror" id="inputTatriz" placeholder="أدخل لون التطريز" name='tatriz_color' value="{{ old('tatriz_color') }}">
                        @error('tatriz_color')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                <!-- الوصف -->
                <div class="form-group row mt-4">
                    <label for="inputDesc" class="col-sm-2 control-label">الوصف </label>
                    <div class="col-sm-10">
                        <textarea class="form-control @error('description') is-invalid @enderror" id="inputDesc" rows="3" placeholder="أدخل وصف اللون او اتركه فارغا" name='description'>{{ old('description') }}</textarea>
                        @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                <!-- القسم -->
                <div class="form-group row mt-4">
                    <label for="inputCategory" class="col-sm-2 control-label">نوع التلبيسة</label>
                    <div class="col-sm-10">
                        <select class="form-control select2 @error('category_id') is-invalid @enderror" id="inputCategory" name="category_id" style="width: 100%">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{old('category_id')==$category->id ?'selected':''}}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>


                <!-- صورة المنتج -->
                <div class="form-group row mt-4">
                    <label for="inputImage" class="col-sm-2 control-label">صورة التلبيسة</label>
                    <div class="col-sm-10">
                        <input type="file" class="form-control-file @error('image') is-invalid @enderror" id="inputImages" name="image" accept="image/*">
                        @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                <!-- قسم لمعاينة الصور -->
                <div class="form-group row mt-4">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-10">
                        <div id="imagePreviewContainer" class="d-flex flex-wrap"></div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="submit" class="btn btn-info float-right">حفظ البيانات</button>
            </div>
            <!-- /.card-footer -->
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        // معاينة الصور قبل رفعها
        function previewImages(event) {
            var previewContainer = document.getElementById('imagePreviewContainer');
            previewContainer.innerHTML = ''; // مسح المعاينات السابقة

            if (event.target.files) {
                [...event.target.files].forEach(file => {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        var imgWrapper = document.createElement('div');
                        imgWrapper.className = 'm-2';

                        var img = document.createElement('img');
                        img.src = e.target.result;
                        img.className = 'img-thumbnail';
                        img.style = 'height: 100px; width: 100px; object-fit: cover;';

                        imgWrapper.appendChild(img);
                        previewContainer.appendChild(imgWrapper);
                    }
                    reader.readAsDataURL(file);
                });
            }
        }

        // إضافة الحدث عند تغيير الصور
        document.getElementById('inputImages').addEventListener('change', previewImages);

        $(document).ready(function() {
            // تقديم النموذج عبر AJAX
            $('#product-form').submit(function(event) {
                event.preventDefault(); // منع إرسال النموذج بالطريقة التقليدية

                var formData = new FormData(this);

                $.ajax({
                    url: "{{ route('admin.products.store') }}",
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        toastr.success(response.success);
                        resetForm();
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            // إظهار أول خطأ فقط
                            var errors = xhr.responseJSON.errors;
                            var firstError = Object.values(errors)[0][0]; // أول خطأ
                            toastr.error(firstError);

                        } else {
                            toastr.error('حدث خطأ غير متوقع.');
                        }
                    }

                });
            });

            function resetForm() {
                $('#product-form')[0].reset();
                $('.select2').val(null).trigger('change');
                $('#imagePreviewContainer').empty();

                $('html, body').animate({
                    scrollTop: $("#product-form").offset().top
                }, 500);
            }
        });
    </script>
@endpush
