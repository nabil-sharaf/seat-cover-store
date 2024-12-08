<!DOCTYPE html>
<html lang="ar">
<head>
    <!-- META -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="" />
    <meta name="author" content="" />
    <meta name="robots" content="" />
    <meta name="description" content="AutoCare is well designed creating websites of automotive repair shops, stores with spare parts and accessories for car repairs, car washes, car danting and panting, service stations, car showrooms painting, major auto centers and other sites related to cars and car services." />
    <meta property="og:title" content="Auto Care - Car Services Template" />
    <meta property="og:description" content="AutoCare is well designed creating websites of automotive repair shops, stores with spare parts and accessories for car repairs, car washes, car danting and panting, service stations, car showrooms painting, major auto centers and other sites related to cars and car services." />
    <meta property="og:image" content="http://autocare.dexignlab.com/xhtml/social-image.png" />
    <meta name="format-detection" content="telephone=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- FAVICONS ICON -->
    <link rel="icon" href="{{asset('front')}}/images/favicon.ico" type="image/x-icon" />
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('front')}}/images/favicon.png" />

    <!-- PAGE TITLE HERE -->
    <title>Auto Care - Car Services Template</title>

    <!-- MOBILE SPECIFIC -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--[if lt IE 9]>
    <script src="{{asset('front')}}/js/html5shiv.min.js"></script>
    <script src="{{asset('front')}}/js/respond.min.js"></script>
    <![endif]-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap" rel="stylesheet">
    <!-- STYLESHEETS -->
    <link rel="stylesheet" type="text/css" href="{{asset('front')}}/css/style.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('front')}}/css/templete.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('front')}}/css/rtl.css">
    <link rel="stylesheet" type="text/css" href="{{asset('front')}}/css/custom.css">
    <link class="skin"  rel="stylesheet" type="text/css" href="{{asset('front')}}/css/skin/skin-3.css">
    <link class="skin"  rel="stylesheet" type="text/css" href="{{asset('front')}}/plugins/rangeslider/rangeslider.css">
    <!-- Revolution Slider Css -->
    <link rel="stylesheet" type="text/css" href="{{asset('front')}}/plugins/revolution/css/settings.css">
    <link rel="stylesheet" type="text/css" href="{{asset('front')}}/plugins/revolution/css/navigation.css">

    {{--    select2--}}
    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('admin/plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@stack('styles')
    <style>
        /*select 2 styles*/
        .select2-container--bootstrap4 .select2-selection--single .select2-selection__arrow,
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            display: none !important;
        }

        .select2-container--bootstrap4 .select2-selection--single,
        .select2-container--default .select2-selection--single {
            padding-right: 0.75rem !important;
        }

        .select2-container--bootstrap4 .select2-selection--single .select2-selection__rendered,
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            padding-right: 0 !important;
        }

        .select2-container--bootstrap4 .select2-selection--single::after,
        .select2-container--default .select2-selection--single::after {
            content: '\25BC';
            position: absolute;
            top: 50%;
            left: 0.75rem;
            transform: translateY(-50%);
            pointer-events: none;
        }

        /* Additional styles for better consistency */
        .select2-container--default .select2-selection--single {
            border: 1px solid #ced4da !important;
            border-radius: 0.25rem !important;
            padding: 0.375rem 0.75rem !important;
            height: calc(2.25rem + 2px) !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 1.5 !important;
            color: #495057 !important;
        }

        .select2-container--default .select2-results__option--highlighted[aria-selected] {
            background-color: #007bff !important;
        }
    </style>
</head>
