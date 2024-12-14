@extends('front.layouts.app')
@section('content')

    <!--== Start Page Title Area ==-->
    <section class="page-title-area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12 m-auto">
                    <div class="page-title-content text-right text-white">
                        {{ __('auth.welcome_message') }}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--== End Page Title Area ==-->

    {{-- Register Form --}}
    <div id="register-form" style="display: none;">
        <section class="login-register-area">
            <div class="container">
                <div class="row">
                    <!-- Register Section -->
                    <div class="col-md-8 offset-md-2 login-register-border">
                        <div class="login-register-content login-register-pl" style="direction: rtl;">
                            <div class="login-register-style">
                                <div class="login-register-title mb-30">
                                    <h2>{{ __('auth.register_title') }}</h2>
                                    <p>{{ __('auth.register_description') }}</p>
                                </div>
                                <form action="{{ route('register') }}" method="post">
                                    @csrf
                                    <div class="login-register-input">
                                        <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" placeholder="{{ __('auth.username_placeholder') }}"/>
                                        @error('name', 'registerErrors')
                                        <div style="color: red; font-size: 12px;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="login-register-input">
                                        <input id="phone" type="text" name="phone" value="{{ old('phone') }}" required autocomplete="phone" placeholder="{{ __('auth.phone_placeholder') }}"/>
                                        @error('phone', 'registerErrors')
                                        <div style="color: red; font-size: 12px;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="login-register-input">
                                        <input id="email" type="text" name="email" value="{{ old('email') }}"  autocomplete="email" placeholder="{{ __('auth.email_placeholder') }}"/>
                                        @error('email', 'registerErrors')
                                        <div style="color: red; font-size: 12px;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="login-register-input">
                                        <input id="password" type="password" name="password" required autocomplete="new-password" placeholder="{{ __('auth.password_placeholder') }}"/>
                                        @error('password', 'registerErrors')
                                        <div style="color: red; font-size: 12px;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="login-register-input">
                                        <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="{{ __('auth.confirm_password_placeholder') }}"/>
                                        @error('password_confirmation', 'registerErrors')
                                        <div style="color: red; font-size: 12px;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="btn-style-3">
                                        <button class="btn" type="submit"><strong>{{ __('auth.register_button') }}</strong></button>
                                    </div>
                                </form>
                                <div class="text-center mt-3">
                                    <a href="#" id="show-login" class="btn btn-link">{{ __('auth.login_link') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    {{-- Login form --}}
    <div id="login-form">
        <section class="login-register-area">
            <div class="container">
                <div class="row">
                    <!-- Login Section -->
                    <div class="col-md-8 offset-md-2 login-register-border">
                        <div class="login-register-content">
                            <div class="login-register-style login-register-pr" style="direction: rtl;">
                                <div class="login-register-title mb-30">
                                    {{ __('auth.login_welcome') }}
                                    <a href="#" id="show-register" class="btn btn-link">{{ __('auth.no_account') }}</a>
                                    <h2 class=""><strong>{{ __('auth.login_button') }}</strong></h2>
                                </div>
                                <form id="login-form" action="{{ route('login') }}" method="post">
                                    @csrf
                                    <div class="login-register-input">
                                        <input type="text" name="phone" value="{{ old('phone') }}" placeholder="{{ __('auth.phone_placeholder') }}">
                                        @error('phone')
                                        <div style="color: red; font-size: 12px;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="login-register-input">
                                        <input type="password" name="password" placeholder="{{ __('auth.password_placeholder') }}">
                                        @error('password')
                                        <div style="color: red; font-size: 12px;">{{ $message }}</div>
                                        @enderror
                                    </div>

{{--                                    <div class="forgot mb-3 text-right">--}}
{{--                                        <a href="{{route('password.request')}}">{{ __('auth.forgot_password') }}</a>--}}
{{--                                    </div>--}}
                                    <div class="btn-style-3">
                                        <button class="btn" type="submit"><strong>{{ __('auth.login_button') }}</strong></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection

@push('styles')
    <style>
        /* General Styles */
        .login-register-area {
            padding: 25px 0 60px 0;
            background: #f8f9fa;
        }

        .login-register-border {
            background: white;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .login-register-content {
            padding: 40px;
        }

        .login-register-title {
            text-align: right;
        }

        .login-register-title h2 {
            font-size: 28px;
            margin-bottom: 15px;
            color: #333;
        }

        .login-register-title p {
            color: #666;
            font-size: 16px;
            margin-bottom: 25px;
        }

        /* Input Styles */
        .login-register-input {
            margin-bottom: 20px;
            position: relative;
        }

        .login-register-input input {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #eee;
            border-radius: 8px;
            font-size: 15px;
            transition: all 0.3s ease;
            direction: rtl;
        }

        .login-register-input input:focus {
            border-color: #4a90e2;
            box-shadow: 0 0 0 3px rgba(74, 144, 226, 0.1);
            outline: none;
        }

        .login-register-input input::placeholder {
            color: #999;
        }

        /* Button Styles */
        .btn-style-3 {
            margin-top: 25px;
        }

        .btn-style-3 .btn {
            width: 100%;
            padding: 14px 20px;
            background: #b38700;
            color: #ffffff;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        .btn-style-3 .btn:hover {
            background: #937721;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(227, 180, 35, 0.32);
        }

        /* Remember Me & Forgot Password */
        .remember-me-btn {
            display: inline-block;
            margin-right: 15px;
        }

        .forgot {
            display: inline-block;
            float: right;
            padding-right:12px;
        }

        .forgot a {
            color: #4a90e2;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .forgot a:hover {
            color: #357abd;
        }

        /* Error Messages */
        .login-register-input div[style*="color: red"] {
            margin-top: 5px;
            padding-right: 5px;
        }

        /* Switch Form Links */
        .btn-link {
            color: #4a90e2;
            text-decoration: none;
            font-size: 15px;
            transition: color 0.3s ease;
        }

        .btn-link:hover {
            color: #357abd;
            text-decoration: underline;
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            .login-register-content {
                padding: 30px 20px;
            }

            .login-register-title h2 {
                font-size: 24px;
            }

            .login-register-border {
                margin: 0 15px;
            }
        }

        @media (max-width: 480px) {
            .remember-me-btn,
            .forgot {
                display: block;
                float: none;
                margin-bottom: 10px;
                text-align: right;
            }

            .login-register-title h2 {
                font-size: 20px;
            }
        }
        .page-title-area{
            background: #b88b00;
            padding: 12px 30px 12px 0;
        }
    </style>
@endpush
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#show-register').click(function(e) {
                e.preventDefault();
                $('#login-form').fadeOut(function() {
                    $('#register-form').fadeIn();
                });
            });

            $('#show-login').click(function(e) {
                e.preventDefault();
                $('#register-form').fadeOut(function() {
                    $('#login-form').fadeIn();
                });
            });
        });
    </script>
@endpush
