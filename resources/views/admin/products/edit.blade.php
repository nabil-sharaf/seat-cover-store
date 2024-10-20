@extends('admin.layouts.app')
@section('page-title')
    تعديل المنتج
@endsection
@section('content')

    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title float-left">تعديل المنتج</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form class="form-horizontal" action="{{ route('admin.products.update', $product->id) }}" method="POST"
              enctype="multipart/form-data" dir="rtl">
            @method('PUT')
            @csrf
            <div class="card-body">
                <!-- الحقول السابقة مثل اسم المنتج، الوصف، السعر، الكمية -->
                <div class="form-group row">
                    <label for="inputName" class="col-sm-2 control-label">اسم المنتج</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="inputName"
                               placeholder="أدخل اسم المنتج" name='name' value="{{ old('name', $product->name) }}">
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <!-- لون التطريز -->
                <div class="form-group row">
                    <label for="inputTatriz" class="col-sm-2 control-label">لون التطريز</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('tatriz_color') is-invalid @enderror" id="inputTatriz" placeholder="أدخل لون التطريز" name='tatriz_color' value="{{ old('tatriz_color',$product->tatriz_color) }}">
                        @error('tatriz_color')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                <!-- الوصف -->
                <div class="form-group row mt-4">
                    <label for="inputDesc" class="col-sm-2 control-label">الوصف </label>
                    <div class="col-sm-10">
                        <textarea class="form-control @error('description') is-invalid @enderror" id="inputDesc" rows="3" placeholder="أدخل وصف اللون او اتركه فارغا" name='description'>{{ old('description',$product->description) }}</textarea>
                        @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                <!-- القسم -->
                <div class="form-group row mt-4">
                    <label for="inputCategory" class="col-sm-2 control-label">نوع التلبيسة</label>
                    <div class="col-sm-10">
                        <select class="form-control select2 @error('category_id') is-invalid @enderror" id="inputCategory" name="category_id" style="width: 100%">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{$product->category_id == $category->id ?'selected':''}}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

               <!-- الحالة -->
                <div class="form-group row mt-4">
                    <label for="inputStatus" class="col-sm-2 control-label">الحالة</label>
                    <div class="col-sm-10">
                        <select class="form-control select2 @error('status') is-invalid @enderror" id="inputStatus" name="status" style="width: 100%">
                                <option value="1" {{$product->status == 1 ?'selected':''}}>متاح</option>
                                <option value="0" {{$product->status == 0 ?'selected':''}}>غير متاح</option>
                        </select>
                        @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>


                <div class="form-group row mt-4">
                    <label for="inputImage" class="col-sm-2 control-label">صور المنتج</label>
                    <div class="col-sm-10">
                        <input type="file" class="form-control-file @error('image') is-invalid @enderror"
                               id="inputImage" name="image" accept="image/*"
                               onchange="previewImages(event)">
                        @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="form-group row mt-4">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-10">
                        <div id="imagePreviewContainer" class="d-flex flex-wrap">
                                <div class="m-2">
                                    <img src="{{ asset('storage/' . $product->image) }}" class="img-thumbnail"
                                         style="height: 100px; width: 100px; object-fit: cover;">

                                </div>
                            <div id="newImagePreviewContainer" class="d-flex flex-wrap mt-2">
                                <!-- معاينات الصور الجديدة -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="submit" class="btn btn-info float-right">حفظ التعديلات</button>
            </div>
            <!-- /.card-footer -->
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        function previewImages(event) {
            var previewContainer = $('#newImagePreviewContainer');
            previewContainer.html(''); // مسح المعاينات السابقة

            if (event.target.files) {
                $.each(event.target.files, function(_, file) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        var imgWrapper = $('<div>').addClass('m-2');
                        var img = $('<img>').attr('src', e.target.result)
                            .addClass('img-thumbnail')
                            .css({ height: '100px', width: '100px', objectFit: 'cover' });
                        imgWrapper.append(img);
                        previewContainer.append(imgWrapper);
                    }
                    reader.readAsDataURL(file);
                });
            }
        }

        var removeImageUrl = "{{ route('admin.products.remove-image', ':id') }}";

        function removeImage(button, imageId) {
            let csrfToken = $('input[name="_token"]').val();
            if (confirm('هل أنت متأكد من حذف هذه الصورة؟')) {
                $.ajax({
                    url: removeImageUrl.replace(':id', imageId),
                    type: 'DELETE',
                    data: { _token: csrfToken },
                    success: function(response) {
                        if (response.success) {
                            $(button).closest('.m-2').remove();
                        } else {
                            alert('حدث خطأ أثناء حذف الصورة.');
                        }
                    },
                    error: function() {
                        alert('حدث خطأ أثناء حذف الصورة.');
                    }
                });
            }
        }

        $(document).ready(function(){


            // إخفاء أو إظهار الحقول بناءً على قيمة نوع الخصم عند تحميل الصفحة
            toggleDiscountFields();

            // تنفيذ الدالة عند تغيير نوع الخصم
            $('#inputDiscountType').change(function () {
                toggleDiscountFields();
            });

            // دالة لإخفاء أو إظهار الحقول
            function toggleDiscountFields() {
                var discountType = $('#inputDiscountType').val();

                if (discountType === '') {
                    // إخفاء الحقول وتفريغ القيم عند اختيار "بدون خصم"
                    $('.discount-fields').hide();
                    $('#inputDiscount').val(null);
                    $('#inputStartDate').val(null);
                    $('#inputEndDate').val(null);
                } else {
                    // إظهار الحقول عند اختيار "ثابت" أو "نسبة مئوية"
                    $('.discount-fields').show();
                }
            }


        });
    </script>
@endpush
