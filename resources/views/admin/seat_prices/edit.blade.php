@extends('admin.layouts.app')
@section('page-title')
    تعديل سعر التلبيسة
@endsection

@section('content')
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title float-left">تعديل السعر</h3>
        </div>
        <!-- /.card-header -->
        <form class="form-horizontal" method="POST" action="{{ route('admin.seat-prices.update', $seatPrice->id) }}">
            @csrf
            @method('PUT')
            <div class="card-body">
                <!-- حقل نوع التلبيسة -->
                <div class="form-group row">
                    <label for="category_id" class="col-sm-2 control-label">نوع التلبيسة</label>
                    <div class="col-sm-10">
                        <select name="category_id" id="category_id" class="select2 form-control @error('category_id') is-invalid @enderror">
                            <option value="" disabled>اختر نوع التلبيسة</option>
                            @foreach($seatCovers as $seatCover)
                                <option value="{{ $seatCover->id }}" {{ $seatCover->id == $seatPrice->category_id ? 'selected' : '' }}>{{ $seatCover->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                <!-- حقل عدد المقاعد -->
                <div class="form-group row">
                    <label for="seat_count_id" class="col-sm-2 control-label">عدد المقاعد</label>
                    <div class="col-sm-10">
                        <select name="seat_count_id" id="seat_count_id" class="select2 form-control @error('seat_count_id') is-invalid @enderror">
                            <option value="" disabled>اختر عدد المقاعد</option>
                            @foreach($seatCounts as $seatCount)
                                <option value="{{ $seatCount->id }}" {{ $seatCount->id == $seatPrice->seat_count_id ? 'selected' : '' }}>{{ $seatCount->name }}</option>
                            @endforeach
                        </select>
                        @error('seat_count_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                <!-- حقل السعر -->
                <div class="form-group row">
                    <label for="price" class="col-sm-2 control-label">السعر</label>
                    <div class="col-sm-10">
                        <input type="number" name="price" id="price" class="form-control @error('price') is-invalid @enderror" value="{{ $seatPrice->price }}" min="0" required>
                        @error('price')<div class="invalid-feedback">{{ $message }}</div>@enderror
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
