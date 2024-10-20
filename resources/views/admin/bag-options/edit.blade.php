@extends('admin.layouts.app')
@section('page-title')
    تعديل سعر الشنطة
@endsection

@section('content')
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title float-left">تعديل سعر الشنطة</h3>
        </div>
        <!-- /.card-header -->
        <form class="form-horizontal" method="POST" action="{{ route('admin.bag-options.update',$bagOption->id) }}">
            @csrf
            @method('PUT')
            <div class="card-body">
                <!-- حقل نوع التلبيسة -->
                <div class="form-group row">
                    <label for="category_id" class="col-sm-2 control-label">نوع التلبيسة</label>
                    <div class="col-sm-10">
                        <input name="category_id" type="text" class="form-control" readonly value="{{$bagOption->seatCover->name}} " disabled>
                        @error('category_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                <!-- حقل السعر -->
                <div class="form-group row">
                    <label for="bag_price" class="col-sm-2 control-label">السعر</label>
                    <div class="col-sm-10">
                        <input type="number" name="bag_price" id="bag_price" class="form-control @error('bag_price') is-invalid @enderror" value="{{ $bagOption->bag_price }}" min="0" required>
                        @error('bag_price')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-info float-right">تعديل</button>
            </div>
            <!-- /.card-footer -->
        </form>
    </div>
@endsection
