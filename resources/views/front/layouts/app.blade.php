@include('front.layouts.head')
@include('front.layouts.main_header')

<main class="main-content">
@yield('content')
    @isset($slot)
        {{$slot}}
    @endisset
</main>

@include('front.layouts.footer')
