@extends('admin.layouts.app')
@section('page-title')
    موديلات السيارات
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex flex-wrap justify-content-between align-items-center">
                <a href="{{ route('admin.car-models.create') }}" class="btn btn-primary mb-2">
                    <i class="fas fa-plus mr-1"></i> إضافة موديل جديد
                </a>
            </div>
        </div>

        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <div class="table-responsive">
                <table class="table table-bordered table-hover text-center table-sm">
                    <thead class="thead-light">
                    <tr>
                        <th>#</th>
                        <th>اسم الموديل</th>
                        <th>سنة الصنع</th>
                        <th>اسم البراند</th>
                        <th>عدد المقاعد</th>
                        <th>العمليات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($carModels as $carModel)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $carModel->model_name }}</td>
                            <td>{{ $carModel->made_year_from }} - {{ $carModel->made_year_to }}</td>
                            <td>{{ $carModel->brand->brand_name }}</td> <!-- عرض اسم البراند من العلاقة -->
                           <td>{{$carModel->seatCount->name}}</td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <a href="{{ route('admin.car-models.edit', $carModel->id) }}" class="btn btn-sm btn-info mb-1 mr-1">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.car-models.destroy', $carModel->id) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger mb-1" onclick="return confirm('هل أنت متأكد من الحذف؟')">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card-footer">
            {{ $carModels->links('vendor.pagination.custom') }}
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .card-footer{
            text-align: center;
        }
        .card-footer ul {
            float: unset !important;
        }
    </style>
@endpush
