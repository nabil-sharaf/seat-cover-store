@extends('front.layouts.app')
@section('content')
    <!-- Content -->
    <div class="page-content">
        <!-- inner page banner -->
        <!-- inner page banner -->
        <div class="dlab-bnr-inr overlay-black-middle"
             style="background-image:url({{asset('storage/'.$siteImages?->about_us_image)}}); opacity: .91">
            <div class="container">
                <div class="dlab-bnr-inr-entry">
                    <h1 class="text-white"> فروعنا</h1>
                </div>
            </div>
        </div>
        <!-- inner page banner END -->
        <!-- Breadcrumb row -->
        <div class="breadcrumb-row">
            <div class="container">
                <ul class="list-inline">
                    <li><a href="#">الرئيسية</a></li>
                    <li>فروعنا</li>
                </ul>
            </div>
        </div>
        <!-- Breadcrumb row END -->
        <div class="section-full content-inner bg-white contact-style-1">
            <div class="container">
                @foreach($branches as $branch)
                    <div class="row branch-section">
                        <!-- right part start -->
                        <div class="col-lg-4 col-md-6 d-md-flex d-lg-flex">
                            <div class="p-a30 m-b30 border contact-area border-1">
                                <h2 class="m-b10 branch-name">{{$branch->name}}</h2>
                                <p></p>
                                <ul class="no-margin">
                                    <li class="icon-bx-wraper left m-b30">
                                        <div class="icon-bx-xs border-1"><a href="#" class="icon-cell"><i
                                                    class="ti-location-pin"></i></a></div>
                                        <div class="icon-content">
                                            <h6 class="text-uppercase m-tb0 dlab-tilte">عنوان الفرع:</h6>
                                            <p>{{$branch->address}}</p>
                                        </div>
                                    </li>
                                    <li class="icon-bx-wraper left">
                                        <div class="icon-bx-xs border-1"><a href="#" class="icon-cell"><i
                                                    class="ti-mobile"></i></a></div>
                                        <div class="icon-content">
                                            <h6 class="text-uppercase m-tb0 dlab-tilte">تليفون الفرع</h6>
                                            <p><a href="https://wa.me/966{{$branch->phone}}" target="_blank"><i
                                                        class="fab branch-whats fa-whatsapp"></i>{{$branch->phone}} </a>
                                            </p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- right part END -->
                        <!-- Left part start -->
                        <div class="col-lg-8 col-md-6 d-flex align-items-center">
                            <iframe src="{{$branch->map}}" style="border:0; width:100%;; height:300px;"
                                    allowfullscreen></iframe>
                        </div>
                        <!-- Left part END -->
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Content END-->
@endsection
@push('styles')
    <style>
        iframe {
            margin-top: -10px;
        }

        .branch-section {
            margin-bottom: 40px;
        }

        .branch-whats {
            color: green;
            padding-left: 5px;
        }
        .branch-section .contact-area {
            width: 100%; /* يجعل العنصر يأخذ عرض العمود بالكامل */
            box-sizing: border-box; /* لضمان أن البوردر يتم حسابه ضمن العرض */
            display: flex;
            flex-direction: column; /* إذا كان لديك محتوى داخلي يتم ترتيبه عموديًا */
        }
        .branch-name{
            font-size: 23px !important;
        }
    </style>
@endpush
