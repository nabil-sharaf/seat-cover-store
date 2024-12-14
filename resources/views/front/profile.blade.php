@extends('front.layouts.app')
@section('title', __('profile.my_account'))
@section('content')
<!--== Start Page Title Area ==-->
<section class="page-title-area">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-12 m-auto">
                <div class="page-title-content text-center">
                    <h2 class="title">{{ __('profile.my_account') }}</h2>
                    <div class="bread-crumbs">
                        <a href="{{ route('home.index') }}">{{ __('home.title') }}</a>
                        <span class="breadcrumb-sep"> // </span>
                        <span class="active">{{ __('profile.my_account') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--== End Page Title Area ==-->

<!--== Start My Account Wrapper ==-->
<section class="my-account-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 m-auto">
                <div class="section-title text-center">
                    <h2 class="title">{{ __('profile.info') }}</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="myaccount-page-wrapper">
                    <div class="row">
                        <div class="col-lg-3 col-md-4">
                            <nav>
                                <div class="myaccount-tab-menu nav nav-tabs" id="nav-tab" role="tablist">
                                    <button class="nav-link {{ $errors->any()|| $errors->addressErrors->any() ? '' : 'active' }}" id="dashboad-tab" data-bs-toggle="tab" data-bs-target="#dashboad" type="button" role="tab" aria-controls="dashboad" aria-selected="true">{{ __('profile.dashboard') }}</button>
                                    <button class="nav-link {{ $errors->addressErrors->any() ? 'active' : '' }}" id="address-edit-tab" data-bs-toggle="tab" data-bs-target="#address-edit" type="button" role="tab" aria-controls="address-edit" aria-selected="false">{{ __('profile.address') }}</button>
                                    <button class="nav-link {{ $errors->any() ? 'active' : '' }}" id="account-info-tab" data-bs-toggle="tab" data-bs-target="#account-info" type="button" role="tab" aria-controls="account-info" aria-selected="false">{{ __('profile.account_details') }}</button>
                                    <button class="nav-link" id="orders-tab" data-bs-toggle="tab" data-bs-target="#orders" type="button" role="tab" aria-controls="orders" aria-selected="false">{{ __('profile.orders') }}</button>
                                </div>
                            </nav>
                        </div>
                        <div class="col-lg-9 col-md-8">
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade {{ $errors->any() || $errors->addressErrors->any() ? '' : 'show active' }}" id="dashboad" role="tabpanel" aria-labelledby="dashboad-tab">
                                    <div class="myaccount-content">
                                        <h3>{{ __('profile.dashboard') }}</h3>
                                        <div class="welcome">
                                            <p>{{ __('profile.hello') }} <strong>{{ auth()->user()->name }}</strong></p>
                                        </div>
                                        <p class="mb-0">{{ __('profile.dashboard_desc') }}</p>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="orders" role="tabpanel" aria-labelledby="orders-tab">
                                    <div class="myaccount-content">
                                        <h3>{{ __('profile.orders') }}</h3>
                                        <div class="myaccount-table table-responsive text-center">
                                            <table class="table table-bordered">
                                                <thead class="thead-light">
                                                <tr>
                                                    <th>{{ __('profile.order') }}</th>
                                                    <th>{{ __('profile.date') }}</th>
                                                    <th>{{ __('profile.status') }}</th>
                                                    <th>{{ __('profile.total') }}</th>
                                                    <th>{{ __('profile.action') }}</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse( $orders as $order)
                                                <tr>
                                                        <td>{{$loop->iteration}}</td>
                                                        <td>{{date_format($order->created_at,'y-m-d')}}</td>
                                                        <td>{{$order->status->name}}</td>
                                                        <td>{{$order->final_total}}</td>
                                                        <td><a href="{{route('order.show',$order->id)}}" class="check-btn sqr-btn show-order-btn">{{ __('profile.view') }}</a></td>
                                                    @empty
                                                        <td colspan="5"> لا توجد اوردرات خاصة بك حاليا</td>
                                                </tr>
                                                    @endforelse

                                                </tbody>
                                            </table>

                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="payment-method" role="tabpanel" aria-labelledby="payment-method-tab">
                                    <div class="myaccount-content">
                                        <h3>{{ __('profile.payment_method') }}</h3>
                                        <p class="saved-message">{{ __('profile.saved_payment_message') }}</p>
                                    </div>
                                </div>
                                <div class="tab-pane fade {{ $errors->addressErrors->any() ? 'show active' : '' }}" id="address-edit" role="tabpanel" aria-labelledby="address-edit-tab">
                                    <div class="myaccount-content">
                                        <h3>{{ __('profile.billing_address') }}</h3>
                                        <div class="account-details-form">
                                            <form action="{{ route('profile.updateAddress') }}" method="POST">
                                                @csrf
                                                <div class="single-input-item">
                                                    <label for="full_name" class="required">{{ __('profile.full_name') }}</label>
                                                    <input type="text" id="full_name" name="full_name"
                                                           value="{{ old('full_name', $address?->full_name) }}"
                                                           placeholder="{{ __('profile.full_name_placeholder') }}" />
                                                    @error('full_name','addressErrors')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="single-input-item">
                                                    <label for="phone" class="required">{{ __('profile.phone') }}</label>
                                                    <input type="text" id="phone" name="phone"
                                                           value="{{ old('phone', $address?->phone) }}"
                                                           placeholder="{{ __('profile.phone_placeholder') }}" />
                                                    @error('phone','addressErrors')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="single-input-item">
                                                    <label for="state" class="required">{{ __('profile.state') }}</label>
                                                    <div class="select-style ">
                                                        <select class=" select-active select2" name="state">
                                                            <option value="" disabled selected>اختر اسم محافظتك</option>
                                                            @foreach($states as $state)
                                                                <option value="{{$state->state}}"{{ $address?->state == $state->state ? 'selected' : '' }}>{{$state->state}}</option>
                                                            @endforeach
                                                         </select>
                                                    </div>
                                                    @error('state','addressErrors')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="single-input-item">
                                                    <label for="city" class="required">{{ __('profile.city') }}</label>
                                                    <input type="text" id="city" name="city"
                                                           value="{{ old('city', $address?->city) }}"
                                                           placeholder="{{ __('profile.city_placeholder') }}" />
                                                    @error('city','addressErrors')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="single-input-item">
                                                    <label for="address" class="required">{{ __('profile.address_line') }}</label>
                                                    <input type="text" id="address" name="address"
                                                           value="{{ old('address', $address?->address) }}"
                                                           placeholder="{{ __('profile.address_line_placeholder') }}" />
                                                    @error('address','addressErrors')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="single-input-item">
                                                    <button class="check-btn sqr-btn">{{ __('profile.save_changes') }}</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade  {{ $errors->any() ? 'show active' : '' }}" id="account-info" role="tabpanel" aria-labelledby="account-info-tab">
                                    <div class="myaccount-content">
                                        <h3>{{ __('profile.account_details') }}</h3>
                                        <div class="account-details-form">
                                            @if ($errors->any())
                                                <div class="alert alert-danger" style="background-color: #f8d7da; color: #721c24; border-color: #f5c6cb; padding: 10px; border-radius: 4px; margin-bottom: 35px;">
                                                    <ul style="list-style-type: none; padding-left: 0; margin: 0;">
                                                        @foreach ($errors->all() as $error)
                                                            <li><i class="fa fa-exclamation-circle" style="margin-right: 5px;"></i>&nbsp; {{ $error }}&nbsp; </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif
                                            <form action="{{route('profile.Update')}}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="single-input-item">
                                                            <label for="name" class="required">{{ __('profile.first_name') }}</label>
                                                            <input type="text" id="name" name="name" value="{{ old('name', auth()->user()->name) }}" placeholder="{{ __('profile.first_name_placeholder') }}" />
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="single-input-item">
                                                            <label for="last-name" class="required">{{ __('profile.last_name') }}</label>
                                                            <input type="text" id="last-name" name="last_name" value="{{ old('last_name', auth()->user()->last_name) }}" placeholder="{{ __('profile.last_name_placeholder') }}" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="single-input-item">
                                                    <label for="phone" class="required">{{ __('profile.phone') }}</label>
                                                    <input type="text" id="phone" name="phone" value="{{ old('phone', auth()->user()->phone) }}" placeholder="{{ __('profile.phone_placeholder') }}" />
                                                </div>
                                                <fieldset>
                                                    <legend>{{ __('profile.password_change') }}:</legend>
                                                    <div class="single-input-item">
                                                        <label for="current-pwd" class="required">{{ __('profile.current_password') }}</label>
                                                        <input type="password" id="current-pwd" name="current_password" placeholder="{{ __('profile.current_password_placeholder') }}" />
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="single-input-item">
                                                                <label for="new-pwd" class="required">{{ __('profile.new_password') }}</label>
                                                                <input type="password" id="new-pwd" name="new_password" placeholder="{{ __('profile.new_password_placeholder') }}" />
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="single-input-item">
                                                                <label for="confirm-pwd" class="required">{{ __('profile.confirm_password') }}</label>
                                                                <input type="password" id="confirm-pwd" name="new_password_confirmation" placeholder="{{ __('profile.confirm_password_placeholder') }}" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </fieldset>
                                                <div class="single-input-item">
                                                    <button class="check-btn sqr-btn">{{ __('profile.save_changes') }}</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--== End My Account Wrapper ==-->

@endsection
@push('styles')
    <style>
        .select-style .select-active {
            padding-inline-start: 36px;
            line-height: 38px;
        }
        /* Account Page General Styles */
        .my-account-area {
            padding: 60px 0;
        }

        /* Tab Menu Styles */
        .myaccount-tab-menu {
            display: flex;
            flex-direction: column;
            background: #f7f7f7;
            border-radius: 8px;
        }

        .myaccount-tab-menu .nav-link {
            border: none;
            padding: 12px 20px;
            text-align: left;
            font-weight: 500;
            color: #333;
            border-radius: 0;
            transition: all 0.3s ease;
        }

        .myaccount-tab-menu .nav-link.active {
            background-color: #984702;
            color: white;
        }

        .myaccount-tab-menu .nav-link:hover {
            background-color: rgb(246 130 32 / 80%);
            color: white;
        }

        /* Tab Content Styles */
        .myaccount-content {
            background: #ffffff;
            padding: 30px;
            border: 1px solid #eeeeee;
            border-radius: 8px;
        }

        .myaccount-content h3 {
            font-size: 24px;
            margin-bottom: 25px;
            border-bottom: 1px solid #eeeeee;
            padding-bottom: 15px;
        }

        /* Form Styles */
        .single-input-item {
            margin-bottom: 25px;
        }

        .single-input-item label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #333;
        }

        .single-input-item label.required::after {
            content: '*';
            color: red;
            margin-left: 5px;
        }

        .single-input-item input,
        .single-input-item select {
            width: 100%;
            height: 45px;
            padding: 10px 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            transition: border-color 0.3s ease;
        }

        .single-input-item input:focus,
        .single-input-item select:focus {
            border-color: #007bff;
            outline: none;
            box-shadow: 0 0 0 2px rgba(0, 123, 255, 0.25);
        }

        /* Button Styles */
        .check-btn.sqr-btn {
            background-color: #007bff;
            color: white;
            padding: 6px 15px;
            border: none;
            border-radius: 6px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .show-order-btn{
            padding: 2px 15px !important;
        }

        .check-btn.sqr-btn:hover {
            background-color: #0056b3;
        }

        /* Table Styles */
        .myaccount-table {
            margin-top: 20px;
        }

        .myaccount-table table {
            border-collapse: collapse;
            width: 100%;
        }

        .myaccount-table th,
        .myaccount-table td {
            padding: 12px;
            border: 1px solid #dee2e6;
        }

        .myaccount-table thead th {
            background-color: #f8f9fa;
            font-weight: 600;
        }

        /* Select Styles */
        .select-style {
            position: relative;
        }

        .select-style .select-active {
            width: 100%;
            height: 45px;
            padding: 10px 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            appearance: none;
            background: #fff url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 4 5'%3E%3Cpath fill='%23333333' d='M2 0L0 2h4zm0 5L0 3h4z'/%3E%3C/svg%3E") no-repeat right 0.75rem center;
            background-size: 8px 10px;
        }

        /* Alert Styles */
        .alert-danger {
            border-radius: 4px;
            margin-bottom: 20px;
        }

        /* Responsive Styles */
        @media (max-width: 991px) {
            .myaccount-tab-menu {
                margin-bottom: 30px;
            }
        }

        @media (max-width: 767px) {
            .myaccount-content {
                padding: 20px;
            }

            .single-input-item {
                margin-bottom: 20px;
            }

            .myaccount-table {
                overflow-x: auto;
            }

            .myaccount-table table {
                min-width: 600px;
            }
        }

        @media (max-width: 575px) {
            .myaccount-content h3 {
                font-size: 20px;
            }

            .check-btn.sqr-btn {
                width: 100%;
            }
        }

    </style>
@endpush
