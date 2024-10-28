@include('front.layouts.head')
@include('front.layouts.main_header')

<div class="page-content bg-white">
    @yield('content')
    @isset($slot)
        {{$slot}}
    @endisset
</div>>

@include('front.layouts.footer')
@include('front.layouts.footer_scripts')
