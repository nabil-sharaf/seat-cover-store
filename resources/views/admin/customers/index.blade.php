@extends('admin.layouts.app')

@section('page-title')
    المستخدمون
@endsection

@section('content')
    <!-- /.card -->
    <div class="card">
        <div class="card-header">
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered ">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>الاسم</th>
                        <th>رقم الموبايل</th>
                        <th>نوع المستخدم</th>
                        <th>الحالة</th>
                        <th>العمليات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($users as $user)
                        @php
                            $customer_type = $user->customer_type == 'goomla' ? 'جملة' : 'قطاعي';
                        @endphp
                        <tr id="customer-data-{{$user->id}}" style="background-color:{{$user->status ? '#fff':'#ccc'}}">
                            <td data-label="#">{{ $loop->iteration }}.</td>
                            <td data-label="الاسم" id="user-name-{{$user->id}}">{{ $user->name }}</td>
                            <td data-label="رقم الموبايل">{{ $user->phone }}</td>
                            <td data-label="نوع المستخدم" id="user-type-{{$user->id}}">
                                {{$customer_type}}
                            </td>
                            <td data-label="الحالة" id="user-status-{{$user->id}}">
                                <span class="btn btn-sm {{$user->status==1 ? 'btn-success' : 'btn-danger'}}">
                                    {{$user->status==1 ? 'مفعل' : 'غير مفعل'}}
                                </span>
                            </td>
                            <td data-label="العمليات" id="vip-td-change-{{$user->id}}">
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.customers.show', $user->id) }}" class="btn btn-sm btn-warning mr-1 mb-1" title="عرض التفاصيل">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <button class="btn-edit-customer btn btn-sm btn-info mr-1 mb-1" data-toggle="modal" data-target="#editCustomerModal-{{ $user->id }}" title="تعديل">
                                        <i class="fas fa-user-edit"></i>
                                    </button>
                                </div>

                                <!-- Edit Customer Modal -->
                                <div class="modal fade" id="editCustomerModal-{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="editCustomerModalLabel-{{ $user->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header customer-edit-label bg-primary text-white">
                                                <h5 class="modal-title" id="editCustomerModalLabel-{{ $user->id }}">تعديل بيانات العميل</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form id="editCustomerForm-{{ $user->id }}">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="mb-4">
                                                        <label for="customerName-{{ $user->id }}" class="form-label mb-3">اسم العميل :</label>
                                                        <input type="text" class="form-control form-control-lg" id="customerName-{{ $user->id }}" name="name" value="{{ $user->name }}">
                                                    </div>
                                                    <div class="mb-4">
                                                        <label for="customerType-{{ $user->id }}" class="form-label mb-3">نوع العميل :</label>
                                                        <select class="form-control form-select form-select-lg" id="customerType-{{ $user->id }}" name="type">
                                                            <option value="goomla" {{ $user->customer_type == 'goomla' ? 'selected' : '' }}>جملة</option>
                                                            <option value="regular" {{ $user->customer_type == 'regular' ? 'selected' : '' }}>قطاعي</option>
                                                        </select>
                                                    </div>
                                                    <div class="mb-4">
                                                        <label for="customerStatus-{{ $user->id }}" class="form-label mb-3">حالة الحساب :</label>
                                                        <select class="form-control form-select form-select-lg" id="customerStatus-{{ $user->id }}" name="status">
                                                            <option value="1" {{ $user->status == 1 ? 'selected' : '' }}>مفعل</option>
                                                            <option value="0" {{ $user->status == 0 ? 'selected' : '' }}>غير مفعل</option>
                                                        </select>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" id="save-customer-changes-{{$user->id}}" class="save-customerChanges btn btn-primary" data-id="{{ $user->id }}">حفظ التغييرات</button>
                                                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">إغلاق</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9">لا يوجد مستخدمين حاليا</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            {{ $users->links('vendor.pagination.custom') }}
        </div>
    </div>

@endsection

@push('scripts')

    <script>
        $(document).ready(function() {
            // تعديل بيانات المستخدم
            $('.btn-edit-customer').on('click', function(event) {
                event.preventDefault();

                var userId = $(this).data('id');
                var modalId = '#editCustomerModal-' + userId;

                // تعبئة بيانات المستخدم داخل المودال
                $(modalId).find('#customerName-' + userId).val($(this).data('name'));
                $(modalId).find('#customerType-' + userId).val($(this).data('type'));
                $(modalId).find('#customerStatus-' + userId).val($(this).data('status'));
            });

                // ربط الحدث عند الضغط على زر الحفظ
                $('.save-customerChanges').on('click', function(e) {
                    e.preventDefault();
                    var userId = $(this).data('id');
                    var modalId = '#editCustomerModal-' + userId;

                    console.log('Save button clicked');
                    // احصل على بيانات النموذج
                    var formData = {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        name: $(modalId).find('input[name="name"]').val(),
                        customer_type: $(modalId).find('select[name="type"]').val(),
                        status: $(modalId).find('select[name="status"]').val(),
                        _method: 'PUT',
                        'update_user': true,
                    };

                    var url = "{{ route('admin.customers.update', ':id') }}".replace(':id', userId);
                    // إرسال طلب Ajax لتحديث البيانات
                    $.ajax({
                        url: url,
                        method: 'POST',
                        data: formData,
                        success: function(response) {
                            toastr.success(response.success);
                            $(modalId).fadeOut(400);
                            $('.modal-backdrop').remove(); // إزالة الخلفية للمودال

                            // تحديث البيانات في الجدول
                            var userRow = $('#customer-data-'+userId);

                            var userType;
                            switch (response.userType) {
                                case 'goomla':
                                    userType='جملة';
                                    break;
                                default:
                                    userType='قطاعي';
                                    break;
                            }


                            // تحديث البيانات في الجدول
                            userRow.find('#user-status-' + userId).html(response.status == 1 ? '<span class="btn btn-sm btn-success">مفعل</span>' : '<span class="btn btn-sm btn-danger">غير مفعل</span>')
                            userRow.find('#user-type-' + userId).html(userType + ' ');
                            userRow.find('#user-name-' + userId).text(response.userName);

                        },
                        error: function(response) {
                            toastr.error(response.error);
                        }
                    });
                });



        });

    </script>
@endpush

@push('styles')
    <style>
        .customer-edit-label{
            background-color: #17a2b8 !important;
        }
        .save-customerChanges{
            background-color: #17a2b8 !important;
        }

        @media  (max-width: 767px) {
            .table-responsive {
                border: 0;
            }
            .table-responsive table {
                border: 0;
            }
            .table-responsive table thead {
                display: none;
            }
            .table-responsive table tr {
                margin-bottom: 10px;
                display: block;
                border-bottom: 2px solid #ddd;
            }
            .table-responsive table td {
                display: block;
                text-align: right;
                font-size: 13px;
                border-bottom: 1px dotted #ccc;
            }
            .table-responsive table td:last-child {
                border-bottom: 0;
            }
            .table-responsive table td:before {
                content: attr(data-label);
                float: right;
                text-transform: uppercase;
                font-weight: bold;
                margin-left:10px;
            }
            .table-responsive .btn-group {
                display: flex;
                flex-wrap: wrap;
                justify-content: flex-end;
            }
            .table-responsive table td.hide-vip {
                display: none;
            }
        }

        @media (min-width: 768px){
            .table-responsive{
                text-align: center;
            }
        }
        label:not(.form-check-label):not(.custom-file-label){
            float:right;
        }
    </style>
@endpush
