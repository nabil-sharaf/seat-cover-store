@extends('admin.layouts.app')
@section('page-title')
    تعديل المنتج
@endsection
@section('content')
    @if(isset($errors))
        @foreach($errors as $error)
            <div class="btn btn-danger">{{$error}}</div>
        @endforeach
    @endif
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title float-left">تعديل المنتج</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form class="form-horizontal" action="{{ route('admin.accessories.update', $accessory->id) }}" method="POST"
              enctype="multipart/form-data" dir="rtl">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group row">
                    <label for="inputName" class="col-sm-2 control-label">اسم المنتج</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="inputName"
                               placeholder="أدخل اسم المنتج" name='name' value="{{ old('name', $accessory->name) }}">
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <!-- الوصف -->
                <div class="form-group row mt-4">
                    <label for="inputDesc" class="col-sm-2 control-label">الوصف </label>
                    <div class="col-sm-10">
                        <textarea class="form-control @error('description') is-invalid @enderror" id="inputDesc" rows="3" placeholder="أدخل وصف المنتج" name='description'>{{ old('description',$accessory->description) }}</textarea>
                        @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                <!-- القسم -->
                <div class="form-group row mt-4">
                    <label for="inputCategory" class="col-sm-2 control-label">القسم </label>
                    <div class="col-sm-10">
                        <select class="form-control select2 @error('category_id') is-invalid @enderror" id="inputCategory" name="category_id" style="width: 100%">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{$accessory->category_id == $category->id ?'selected':''}}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
               <!-- سعر المنتج -->
                <div class="form-group row mt-4">
                    <label for="price" class="col-sm-2 control-label">سعر المنتج  </label>
                    <div class="col-sm-10">
                        <input class="form-control @error('price') is-invalid @enderror" id="price" name="price" style="width: 100%" value="{{$accessory->price}}"/>
                        @error('price')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <!--كمية  المنتج   -->
                <div class="form-group row">
                    <label for="quantity" class="col-sm-2 control-label"> الكمية المتاحة</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control @error('quantity') is-invalid @enderror" id="quantity" placeholder="أدخل  كمية المنتج" name='quantity' value="{{$accessory->quantity}}" required min="1" step="1">
                        @error('quantity')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                <div class="form-group row mt-4">
                    <label for="images" class="col-sm-2 control-label">صور المنتج</label>
                    <div class="col-sm-10">
                        <input type="file" multiple class="form-control-file @error('images') is-invalid @enderror"
                               id="images" name="images[]" accept="image/*"
                               onchange="previewImages(event)">
                        @error('images')
                        <div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="form-group row mt-4">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-10">
                        <div id="imagePreviewContainer" class="d-flex flex-wrap">
                            <div class="m-2" id="img-preview">
                                @foreach($accessory->images as $key => $image)
                                    <div style="display: inline-block; position: relative;">
                                        <img src="{{ asset('storage/'.$image) }}" class="img-thumbnail"
                                             style="height: 100px; width: 100px; object-fit: cover;">
{{--                                        <button type="button" onclick="deleteImage({{ $key }})"--}}
{{--                                                style="position: absolute; top: 5px; right: 5px; background-color: red; color: white; border: none;">--}}
{{--                                            x--}}
{{--                                        </button>--}}
                                    </div>
                                @endforeach
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
            var OldpreviewContainer = $('#img-preview');
            OldpreviewContainer.html('');
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

        {{--function deleteImage(imageIndex) {--}}
        {{--    if (confirm("هل أنت متأكد من حذف هذه الصورة؟")) {--}}
        {{--        fetch(`admin/accessories/delete-image/{{ $accessory->id }}`, {--}}
        {{--            method: 'POST',--}}
        {{--            headers: {--}}
        {{--                'Content-Type': 'application/json',--}}
        {{--                'X-CSRF-TOKEN': '{{ csrf_token() }}'--}}
        {{--            },--}}
        {{--            body: JSON.stringify({ imageIndex: imageIndex })--}}
        {{--        })--}}
        {{--            .then(response => response.json())--}}
        {{--            .then(data => {--}}
        {{--                if (data.success) {--}}
        {{--                    location.reload(); // تحديث الصفحة لعرض الصور بعد الحذف--}}
        {{--                } else {--}}
        {{--                    alert("حدث خطأ أثناء حذف الصورة.");--}}
        {{--                }--}}
        {{--            })--}}
        {{--            .catch(error => console.error('Error:', error));--}}
        {{--    }--}}
        {{--}--}}
    </script>
@endpush