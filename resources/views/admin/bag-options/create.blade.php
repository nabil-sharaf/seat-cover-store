@extends('admin.layouts.app')

@section('page-title')
 اضافة سعر شنطة
@endsection

@section('content')
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title float-left">إضافة سعر شنطة</h3>
        </div>
        <!-- /.card-header -->
        <form class="form-horizontal" method="POST" action="{{ route('admin.bag-options.store') }}">
            @csrf
            <div class="card-body">
                <!-- حقل نوع التلبيسة -->
                <div class="form-group row">
                    <label for="category_id" class="col-sm-2 control-label">نوع التلبيسة</label>
                    <div class="col-sm-10">
                        <select name="category_id" id="category_id" class="select2 form-control @error('category_id') is-invalid @enderror" required>
                            <option value="" disabled selected>اختر نوع التلبيسة</option>
                            @foreach($seatCovers as $seatCover)
                                <option value="{{ $seatCover->id }}" {{ old('category_id') == $seatCover->id ? 'selected' : '' }}>
                                    {{ $seatCover->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>


                <!-- حقل السعر -->
                <div class="form-group row">
                    <label for="price" class="col-sm-2 control-label">سعر الشنطة</label>
                    <div class="col-sm-10">
                        <input type="number" name="bag_price" id="bag_price" class="form-control @error('bag_price') is-invalid @enderror" min="0" required value="{{old('bag_price')}}">
                        @error('bag_price')<div class="invalid-feedback">{{ $message }}</div>@enderror
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
