@extends('admin.layouts.app')

@section('page-title')
    البراندات
@endsection

@section('content')
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title float-left">إضافة براند جديد</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form id="brand-form" class="form-horizontal" method="POST" action="{{ route('admin.car-brands.store') }}" enctype="multipart/form-data" dir="rtl">
            @csrf
            <div class="card-body">
                <!-- اسم البراند -->
                <div class="form-group row">
                    <label for="inputBrandName" class="col-sm-2 control-label">اسم البراند</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('brand_name') is-invalid @enderror" id="inputBrandName" placeholder="أدخل اسم البراند" name="brand_name" value="{{ old('brand_name') }}">
                        @error('brand_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
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
