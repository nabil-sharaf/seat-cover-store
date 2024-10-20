@extends('admin.layouts.app')

@section('page-title')
تفاصيل المستخدم
@endsection


@section('content')
    <div class="container mt-4">
        <div class="row mb-3">
            <div class="col">
                <a href="{{ route('admin.customers.index') }}" class="btn btn-secondary mb-3">العودة إلى قائمة العملاء</a>
            </div>
        </div>

        <div class="card shadow-sm mb-4">
            <div class="card-header bg-info text-white">
                <h3 id = 'customer-name-label' class="mb-0">{{ $user->name }}</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <p><strong>رقم التليفون:</strong> {{ $user->phone }}</p>
                        <p id="customer-status-label"><strong>حالة الحساب:</strong> {{ $user->status == 1 ? 'مفعل' : 'غير مفعل' }}</p>
                        <p><strong>تاريخ الانضمام:</strong> {{ $user->created_at->format('d-m-Y') }}</p>
                        <p><strong>عنوان العميل:</strong> {{ $user?->address?->address != null ? $user->address->address : 'لم يسجل العنوان' }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <p id="customer-type-label"><strong>نوع العميل:</strong> {{ $user->customer_type == 'goomla' ? 'جملة' : 'قطاعي' }}</p>
                        <p><strong>الإنفاق الكلي:</strong> {{ number_format($totalSpending > 0 ? $totalSpending : 0, 2) }} ج.م</p>
                        <p><strong>الإنفاق آخر شهر:</strong> {{ number_format($lastMonthSpending > 0 ? $lastMonthSpending : 0, 2) }} ج.م</p>
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-between">
                <a href="{{ route('admin.customers.edit', $user->id) }}" class="btn btn-primary" id="editCustomerBtn">تعديل بيانات العميل</a>

            </div>
        </div>
    </div>

    <!-- تعديل نموذج بيانات العميل -->
    <div class="modal fade" id="editCustomerModal{{$user->id}}" tabindex="-1" aria-labelledby="editCustomerModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white customer-edit-label">
                    <h5 class="modal-title" id="editCustomerModalLabel">تعديل بيانات العميل</h5>
                </div>
                <div class="modal-body">
                    <form id="editCustomerForm">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="update_user" value="1">
                        <div class="mb-4">
                            <label for="customerName" class="form-label">اسم العميل:</label>
                            <input type="text" class="form-control form-control-lg" id="customerName" name="name" value="{{ $user->name }}">
                        </div>
                        <div class="mb-4">
                            <label for="customerType" class="form-label">نوع العميل:</label>
                            <select class="form-control form-select form-select-lg" id="customerType" name="customer_type">
                                <option value="goomla" {{ $user->customer_type == 'goomla' ? 'selected' : '' }}>جملة</option>
                                <option value="regular" {{ $user->customer_type == 'regular' ? 'selected' : '' }}>قطاعي</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="customerStatus" class="form-label">حالة الحساب:</label>
                            <select class="form-control form-select form-select-lg" id="customerStatus" name="status">
                                <option value="1" {{ $user->status == 1 ? 'selected' : '' }}>مفعل</option>
                                <option value="0" {{ $user->status == 0 ? 'selected' : '' }}>غير مفعل</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" form="editCustomerForm" class="btn btn-primary  save-customerChanges">حفظ التغييرات</button>
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">إغلاق</button>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('scripts')
    <script>
        $(document).ready(function() {

            var editCustomerModal = new bootstrap.Modal(document.getElementById('editCustomerModal{{$user->id}}'));
            // عرض نموذج التعديل عند النقر على زر التعديل
            $('#editCustomerBtn').on('click', function(event) {
                event.preventDefault();
                editCustomerModal.show();
            });

            // إغلاق المودال عند النقر على زر الإغلاق
            $('#closeModalBtn').on('click', function() {
                editCustomerModal.hide();
            });

            // تعديل بيانات المستخدم  عبر AJAX
            $('#editCustomerForm').on('submit', function(event) {
                event.preventDefault();

                var formData = $(this).serialize();
                const myForm = new FormData(this);
                const formObject = Object.fromEntries(myForm.entries());


                $.ajax({
                    url: "{{ route('admin.customers.update', $user->id) }}",
                    type: 'PUT',
                    data: formData,
                    success: function(response) {
                        toastr.success(response.success);
                        editCustomerModal.hide();
                           if (formObject.customer_type =='goomla'){

                                 var customerType = 'نوع المستخدم : جملة';
                           }else{
                               var customerType = 'نوع المستخدم : قطاعي';
                           }

                           if (formObject.status === '1'){

                                 var customerStatus = 'حالة الحساب  : مفعل';
                           }else{
                               var customerStatus = 'حالة الحساب  : غير مفعل';
                           }

                        $('#customer-name-label').text(formObject.name);
                        $('#customer-status-label').text(customerStatus);
                        $('#customer-type-label').text(customerType);

                    },
                    error: function(xhr) {
                        toastr.error(response.error);
                        var errors = xhr.responseJSON.errors;
                        for (var key in errors) {
                            toastr.error(errors[key][0]);
                        }
                    }
                });
            });

            // إغلاق المودال عند النقر خارجه
            $(document).on('click', function(event) {
                if ($(event.target).hasClass('modal') && $(event.target).is(':visible')) {
                    editCustomerModal.hide();
                }
            });
        });


    </script>
@endpush

@push('styles')
    <style>
        @media (max-width: 576px) {
            .modal-dialog {
                margin: 0.5rem;
                max-width: calc(100% - 1rem);
            }

            .modal-content {
                border-radius: 0;
            }

            .modal-header {
                padding: 0.5rem;
            }

            .modal-body {
                padding: 1rem;
            }

            .modal-footer {
                padding: 0.5rem;
            }

            .form-label {
                font-size: 0.9rem;
            }

            .form-control, .form-select {
                font-size: 0.9rem;
            }

            .btn {
                font-size: 0.9rem;
                padding: 0.375rem 0.75rem;
            }
        }


        @media (max-width: 576px) {
            #editCustomerModal .modal-dialog {
                margin: 0.5rem;
                max-width: calc(100% - 1rem);
            }

            #editCustomerModal .modal-content {
                border-radius: 10px;
            }

            #editCustomerModal .modal-header,
            #editCustomerModal .modal-body,
            #editCustomerModal .modal-footer {
                padding: 15px;
            }

            #editCustomerModal .modal-title {
                font-size: 1.2rem;
            }

            #editCustomerModal .form-label {
                font-size: 0.9rem;
            }

            #editCustomerModal .form-control,
            #editCustomerModal .form-select,
            #editCustomerModal .btn {
                font-size: 0.9rem;
                padding: 8px 12px;
            }
        }
        #editCustomerBtn{
            background-color:#17a2b8 !important;
        ;
        }
        .save-customerChanges{
            background-color:#17a2b8 !important;
        ;
        }
        .customer-edit-label{
            background-color:#17a2b8 !important;

        }
        #customerVip{
          margin-right:10px;
            margin-top:8px;
        }
        .form-check-label{
            margin-right: -12px;
        }
    </style>
@endpush
