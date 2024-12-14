@extends('front.layouts.app')
@section('content')
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-50 to-indigo-50 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <!-- Card Container -->
            <div class="bg-white rounded-2xl shadow-2xl p-8 border border-gray-100">

                <!-- Header -->
                <div class="text-center mb-10 mt-4">
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">
                        {{ __('نسيت كلمة المرور؟') }}
                    </h2>
                    <p class="text-md text-gray-600 dark:text-gray-400 leading-relaxed">
                        {{ __('لا تقلق! فقط أدخل بريدك الإلكتروني وسنرسل لك رابطاً لإعادة تعيين كلمة المرور.') }}
                    </p>
                </div>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('password.email') }}" class="mt-8 space-y-6 text-center">
                    @csrf

                    <!-- Email Input Group -->
                    <div class="space-y-2">
                        <x-input-label for="email" :value="__('البريد الإلكتروني')"
                                       class="block text-sm font-semibold text-gray-700" />
                        <div class="relative">
                            <div class="">
                            </div>
                            <x-text-input
                                id="email"
                                type="email"
                                name="email"
                                :value="old('email')"
                                required
                                autofocus
                                class="email-input"
                                placeholder="ادخل الإيميل هنا"
                            />
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-600" />
                    </div>

                    <!-- Submit Button -->
                    <div class="mt-6 submit-btn">
                        <x-primary-button class="button site-button ">
                            {{ __('إرسال رابط إعادة التعيين') }}
                        </x-primary-button>
                    </div>

                    <!-- Back to Login Link -->
                    <div class="mt-6 text-center back-to-login">
                        <a href="{{ route('login') }}" class="inline-flex items-center text-sm font-medium text-blue-600 hover:text-blue-500 transition duration-150 ease-in-out text-decoration-underline">
                            {{ __('العودة لتسجيل الدخول') }}
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('styles')
    <style>
     .submit-btn .button{
         padding: 8px 31px !important;
         margin: 12px;
     }
     .email-input{
         padding: 6px 30px;
         border: 1px solid #ccc;
         text-align: center;
     }
     .back-to-login{
         margin-bottom:30px;
         margin-top: 10px;
     }

    </style>
@endpush
