@extends('admin.layouts.app')
@section('page-title')
    الفروع
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex flex-wrap justify-content-between align-items-center">
                <a href="{{ route('admin.branches.create') }}" class="btn btn-primary mb-2">
                    <i class="fas fa-plus mr-1"></i> إضافة فرع جديد
                </a>
            </div>
        </div>
        <!-- /.card-header -->

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover text-center table-sm">
                    <thead class="thead-light">
                    <tr>
                        <th>#</th>
                        <th>اسم الفرع</th>
                        <th>تليفون الفرع</th>
                        <th>العنوان</th>
                        <th>العمليات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($branches as $index => $branch)
                        <tr>
                            <td class="align-middle">{{ $index + 1 }}.</td>
                            <td class="align-middle">{{ $branch->name }}</td>
                            <td class="align-middle">{{ $branch->phone }}</td>
                            <td class="align-middle">{{ $branch->address }}</td>
                            <td class="align-middle">
                                <div class="d-flex justify-content-center">
                                    <a href="{{ route('admin.branches.edit', $branch->id) }}" class="btn btn-sm btn-info mb-1 mr-1">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.branches.destroy', $branch->id) }}" method="POST" style="display:inline-block;">
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
        <!-- /.card-body -->

        <div class="card-footer">
            {{ $branches->links('vendor.pagination.custom') }}
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .card-footer {
            text-align: center;
        }
        .card-footer ul {
            float: unset !important;
        }
    </style>
@endpush
