@extends('admin.layouts.app')

@section('page-title')
إضافة عدد مقاعد جديد
@endsection

@section('content')
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title float-left">إضافة مقعد جديد</h3>
        </div>
        <!-- /.card-header -->
        <form class="form-horizontal" method="POST" action="{{ route('admin.seat-counts.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <!-- حقل الاسم -->
                <div class="form-group row">
                    <label for="name" class="col-sm-2 control-label">الاسم</label>
                    <div class="col-sm-10">
                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                <!-- حقل الصورة -->
                <div class="form-group row">
                    <label for="image" class="col-sm-2 control-label">الصورة</label>
                    <div class="col-sm-10">
                        <input type="file" name="image" id="image" class="form-control-file @error('image') is-invalid @enderror">
                        @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                <!-- عرض الصورة -->
                <div class="form-group row">
                    <label class="col-sm-2 control-label"></label>
                    <div class="col-sm-10">
                        <img id="image-preview" style="max-width: 120px;">
                    </div>
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-info float-right">حفظ</button>
            </div>
            <!-- /.card-footer -->
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function () {
                var output = document.getElementById('image-preview');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }
        document.getElementById('image').addEventListener('change', previewImage);
    </script>
@endpush
