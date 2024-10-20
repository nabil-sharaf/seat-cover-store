@extends('admin.layouts.app')

@section('page-title')
    تعديل الموديل
@endsection
@section('content')
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title float-left">تعديل الموديل: {{ $carModel->model_name }}</h3>
        </div>
        <!-- /.card-header -->
        <form class="form-horizontal" method="POST" action="{{ route('admin.car-models.update', $carModel->id) }}">
            @csrf
            @method('PUT')
            <div class="card-body">
                <!-- حقل اسم الموديل -->
                <div class="form-group row">
                    <label for="model_name" class="col-sm-2 control-label">اسم الموديل</label>
                    <div class="col-sm-10">
                        <input type="text" name="model_name" id="model_name" class="form-control @error('model_name') is-invalid @enderror" value="{{ $carModel->model_name }}" required>
                        @error('model_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                <!-- حقل اختيار البراند -->
                <div class="form-group row">
                    <label for="brand_id" class="col-sm-2 control-label">اختيار البراند</label>
                    <div class="col-sm-10">
                        <select name="brand_id" id="brand_id" class="select2 form-control @error('brand_id') is-invalid @enderror" required>
                            @foreach($brands as $brand)
                                <option value="{{ $brand->id }}" {{ $carModel->brand_id == $brand->id ? 'selected' : '' }}>
                                    {{ $brand->brand_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('brand_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                <!-- حقل اختيار السنة من -->
                <div class="form-group row">
                    <label for="made_year_from" class="col-sm-2 control-label">سنة التصنيع من</label>
                    <div class="col-sm-10">
                        <select name="made_year_from" id="made_year_from" class="select2 form-control @error('made_year_from') is-invalid @enderror" required>
                            <option value="">اختر السنة</option>
                            @for ($year = 2000; $year <= now()->year; $year++)
                                <option value="{{ $year }}" {{ old('made_year_from',$carModel->made_year_from) == $year ? 'selected' : '' }}>
                                    {{ $year }}
                                </option>
                            @endfor
                        </select>
                        @error('made_year_from')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                <!-- حقل اختيار السنة إلى -->
                <div class="form-group row">
                    <label for="made_year_to" class="col-sm-2 control-label">سنة التصنيع إلى</label>
                    <div class="col-sm-10">
                        <select name="made_year_to" id="made_year_to" class="select2 form-control @error('made_year_to') is-invalid @enderror" required>
                            <option value="">اختر السنة</option>
                            @for ($year = 2000; $year <= now()->year; $year++)
                                <option value="{{ $year }}" {{ old('made_year_to', $carModel->made_year_to) == $year ? 'selected' : '' }}>
                                    {{ $year }}
                                </option>
                            @endfor
                        </select>
                        @error('made_year_to')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="seat_count_id" class="col-sm-2 control-label">عدد المقاعد</label>
                    <div class="col-sm-10">
                        <select name="seat_count_id" id="seat_count_id" class="select2 form-control @error('seat_count_id') is-invalid @enderror" required>
                            <option value="">اختر عدد المقاعد</option>
                            @foreach($seatCounts as $seatCount)
                                <option value="{{ $seatCount->id }}" {{ old('seat_count_id', $carModel->seatCount?->id) == $seatCount->id ? 'selected' : '' }}>
                                    {{ $seatCount->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('seat_count_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="submit" class="btn btn-info float-right">تحديث</button>
            </div>
            <!-- /.card-footer -->
        </form>
    </div>
@endsection
