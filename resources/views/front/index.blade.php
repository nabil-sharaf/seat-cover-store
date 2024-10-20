@extends('front.layouts.app')
@section('title','الرئيسية')
@section('content')

@endsection


@push('scripts')
    <script>
        @if(isset($popup) && $popup->status==1)

            @if(!session()->has('popup_show'))
                document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                title: '{{ $popup->title }}',
                html: '{!! $popup->text !!} ',
                iconHtml: '<img src="{{ asset('storage/' . $popup->image_path) }}" style="width:200px; max-height:100px;" />',
                background: '#f0f0f0',
                color: '#333333',
                confirmButtonText: '<a class="pop-up-button" href="{{ $popup->button_link }}">{{ $popup->button_text }}</a>',
                confirmButtonColor: '#f379a7',
                footer: '<a href="{{ $popup->footer_link_url }}" style="color: #f379a7;">{{ $popup->footer_link_text }}</a>',
                customClass: {
                    title: 'custom-title',
                    popup: 'custom-popup',
                    footer: 'custom-footer'
                }
            });
        });
               <?php session()->put('popup_show', true); ?>
           @endif
        @endif

        $(document.ready(function () {
            $('.slick-prev, .slick-next').css('display', 'block');
            $('.product-tab1-slider').slick({
                arrows: true,
            });
        }))
    </script>
@endpush
