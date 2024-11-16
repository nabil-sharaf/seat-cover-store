@extends('admin.layouts.app')

@section('page-title')
    الاكسسوارات
@endsection

@section('content')
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title float-left">إضافة اكسسوار جديد</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form id="product-form" action="{{route('admin.accessories.store')}}" class="form-horizontal"
              enctype="multipart/form-data" dir="rtl" method="post">
            @csrf
            <div class="card-body">
                <!-- الاسم   -->
                <div class="form-group row">
                    <label for="inputName" class="col-sm-2 control-label">اسم المنتج</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="inputName"
                               placeholder="أدخل  اسم المنتج " name='name' value="{{ old('name') }}">
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                <!-- الوصف -->
                <div class="form-group row mt-4">
                    <label for="inputDesc" class="col-sm-2 control-label">الوصف </label>
                    <div class="col-sm-10">
                        <textarea class="form-control @error('description') is-invalid @enderror" id="inputDesc"
                                  rows="3" placeholder="أدخل وصف المنتج "
                                  name='description'>{{ old('description') }}</textarea>
                        @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                <!-- القسم -->
                <div class="form-group row mt-4">
                    <label for="inputCategory" class="col-sm-2 control-label"> القسم</label>
                    <div class="col-sm-10">
                        <select class="form-control select2 @error('category_id') is-invalid @enderror"
                                id="inputCategory" name="category_id" style="width: 100%">
                            @foreach($categories as $category)
                                <option
                                    value="{{ $category->id }}" {{old('category_id')==$category->id ?'selected':''}}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                        <div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                <!-- سعر المنتج   -->
                <div class="form-group row">
                    <label for="price" class="col-sm-2 control-label">سعر المنتج</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control @error('price') is-invalid @enderror" id="price"
                               placeholder="أدخل  سعر المنتج " name='price' value="{{ old('price') }}" required min="0"
                               step=".1">
                        @error('price')
                        <div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <!-- نوع الخصم    -->
                <div class="form-group row">
                    <label for="discount_type" class="col-sm-2 control-label">نوع الخصم </label>
                    <div class="col-sm-10">
                        <select name="discount_type" id="discount_type"
                                class="form-control select2 @error('discount_type') is-invalid @enderror">
                            <option value="" {{ old('discount_type') == '' ? 'selected' : '' }}>لا يوجد</option>
                            <option value="fixed" {{ old('discount_type') == 'fixed' ? 'selected' : '' }}>ثابت</option>
                            <option value="percentage" {{ old('discount_type') == 'percentage' ? 'selected' : '' }}>نسبة
                                مئوية
                            </option>
                        </select>
                        @error('discount_type')
                        <div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <!-- قيمة الخصم -->
                <div class="form-group row mt-4 discount-fields" style="display: none;">
                    <label for="discount_value" class="col-sm-2 control-label">قيمة الخصم</label>
                    <div class="col-sm-10">
                        <input type="number" step="0.01"
                               class="form-control @error('discount_value') is-invalid @enderror" id="discount_value"
                               placeholder="أدخل قيمة الخصم" name='discount_value' value="{{ old('discount_value',0)}}"
                               min="0">
                        @error('discount_value')
                        <div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <!--تاريخ بداية الخصم    -->
                <div class="form-group row discount-fields" style="display: none;">
                    <label for="start_date" class="col-sm-2 control-label">تاريخ بداية الخصم </label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control @error('start_date') is-invalid @enderror"
                               id="start_date" placeholder="أدخل تاريخ بداية الخصم" name='start_date'
                               value="{{ old('start_date') }}">
                        @error('start_date')
                        <div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <!--تاريخ نهاية الخصم الخصم    -->
                <div class="form-group row discount-fields" style="display: none;">
                    <label for="end_date" class="col-sm-2 control-label">تاريخ نهاية الخصم </label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control @error('end_date') is-invalid @enderror" id="end_date"
                               placeholder="أدخل تاريخ نهاية الخصم" name='end_date' value="{{ old('end_date') }}">
                        @error('end_date')
                        <div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                <!--كمية  المنتج   -->
                <div class="form-group row">
                    <label for="quantity" class="col-sm-2 control-label"> الكمية المتاحة</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control @error('quantity') is-invalid @enderror" id="quantity"
                               placeholder="أدخل  كمية المنتج  " name='quantity' value="{{ old('quantity') }}" required
                               min="1" step="1">
                        @error('quantity')
                        <div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                <!-- صورة المنتج -->
                <div class="form-group row mt-4">
                    <label for="images" class="col-sm-2 control-label">صور المنتج</label>
                    <div class="col-sm-10">
                        <input type="file" multiple class="form-control-file @error('images') is-invalid @enderror"
                               id="images" name="images[]" accept="images/*">
                        @error('images')
                        <div class="invalid-feedback">{{ $message }}</div>@enderror
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
                    reader.onload = function (e) {
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
        document.getElementById('images').addEventListener('change', previewImages);

        $(document).ready(function () {
            var discountTypeSelector = $('#discount_type');

            // اظهار أو إخفاء حقول الخصم بناءً على القيمة المحددة
            function toggleDiscountFields() {
                var selectedType = discountTypeSelector.val();
                if (selectedType === "") {
                    $('.discount-fields').hide(); // إخفاء الحقول
                    $('#discount_value').val(null); // تعيين قيمة الخصم إلى null
                    $('#start_date').val(null); // تعيين تاريخ البدء إلى null
                    $('#end_date').val(null); // تعيين تاريخ الانتهاء إلى null
                } else {
                    $('.discount-fields').show(); // إظهار الحقول عند اختيار نوع الخصم
                }
            }

            // استدعاء الوظيفة عند تغيير نوع الخصم
            discountTypeSelector.change(function () {
                toggleDiscountFields();
            });

            // تشغيل الوظيفة عند تحميل الصفحة لتعيين الحالة الأولية
            toggleDiscountFields();
        });
    </script>
@endpush
