@extends('admin.layouts.app')
@section('page-title')
أسعار الشنط
@endsection

@section('content')
    <!-- /.card -->
    <div class="card">
        <div class="card-header">
            <div class="d-flex flex-wrap justify-content-between align-items-center">
                <a href="{{ route('admin.bag-options.create') }}" class="btn btn-primary mb-2">
                    <i class="fas fa-plus mr-1"></i> اضافة سعر شنطة
                </a>
            </div>
        </div>
        <!-- /.card-header -->

        <!-- .card-body -->
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover text-center table-sm">
                    <thead class="thead-light">
                    <tr>
                        <th>#</th>
                        <th>نوع التلبيسة</th>
                        <th>سعر الشنطة</th>
                        <th>العمليات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($bags as $bag)
                        <tr>
                            <td>{{ $loop->iteration }}.</td>
                            <td>{{ $bag->seatCover->name }}</td>
                            <td>{{ $bag->bag_price >0 ? $bag->bag_price.' ر.س' : 'مجاني' }} </td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <a href="{{ route('admin.bag-options.edit', $bag->id) }}" class="btn btn-sm btn-info mb-1 mr-1">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.bag-options.destroy', $bag->id) }}" method="POST" style="display:inline-block;">
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
            {{ $bags->links('vendor.pagination.custom') }}
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
