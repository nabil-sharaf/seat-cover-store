@extends('admin.layouts.app')
@section('page-title')
المقاعد
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex flex-wrap justify-content-between align-items-center">
                <a href="{{ route('admin.seat-counts.create') }}" class="btn btn-primary mb-2">
                    <i class="fas fa-plus mr-1"></i> إضافة مقعد جديد
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
                        <th>الاسم</th>
                        <th>صورة السيارة</th>
                        <th>العمليات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($seatCounts as $seatCount)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $seatCount->name }}</td>
                            <td><img src="{{ asset('storage/'.$seatCount->image) }}" alt="صورة السيارة" style="max-width: 60px; max-height: 40px;"></td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <a href="{{ route('admin.seat-counts.edit', $seatCount->id) }}" class="btn btn-sm btn-info mb-1 mr-1">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.seat-counts.destroy', $seatCount->id) }}" method="POST" style="display: inline-block;">
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
            {{ $seatCounts->links('vendor.pagination.custom') }}
        </div>
    </div>
@endsection

@push('styles')

    <style>
        .table-responsive-md {
            overflow-x: auto;
            /* تحسين التمرير الأفقي على الشاشات الصغيرة */
        }
        .btn-sm {
            padding: 0.25rem 0.5rem;
            font-size: 0.75rem;
        }
    </style>
@endpush
