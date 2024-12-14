<!-- jQuery أولاً - استخدم نسخة واحدة فقط -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="{{asset('front')}}/js/mycustom.js"></script>
<script src="{{asset('front')}}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Swiper JS -->
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css"/>
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>


<!-- المكتبات المساعدة -->
<script
    src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-touchspin/4.3.0/jquery.bootstrap-touchspin.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

<!-- Revolution Slider -->
<script src="{{asset('front')}}/plugins/revolution/js/jquery.themepunch.tools.min.js"></script>
<script src="{{asset('front')}}/plugins/revolution/js/jquery.themepunch.revolution.min.js"></script>

<!-- Revolution Slider Extensions -->
<script src="{{asset('front')}}/plugins/revolution/js/extensions/revolution.extension.actions.min.js"></script>
<script src="{{asset('front')}}/plugins/revolution/js/extensions/revolution.extension.carousel.min.js"></script>
<script src="{{asset('front')}}/plugins/revolution/js/extensions/revolution.extension.kenburn.min.js"></script>
<script src="{{asset('front')}}/plugins/revolution/js/extensions/revolution.extension.layeranimation.min.js"></script>
<script src="{{asset('front')}}/plugins/revolution/js/extensions/revolution.extension.migration.min.js"></script>
<script src="{{asset('front')}}/plugins/revolution/js/extensions/revolution.extension.navigation.min.js"></script>
<script src="{{asset('front')}}/plugins/revolution/js/extensions/revolution.extension.parallax.min.js"></script>
<script src="{{asset('front')}}/plugins/revolution/js/extensions/revolution.extension.slideanims.min.js"></script>
<script src="{{asset('front')}}/plugins/revolution/js/extensions/revolution.extension.video.min.js"></script>

<!-- Custom Scripts -->
<script>
    var imagesPath = "{{ asset('front/images') }}";
    var logoWhitePath = "{{ asset('storage/'.$siteImages?->footer_image) }}";
</script>
<script src="{{asset('front')}}/js/custom.min.js"></script>
<script src="{{asset('front')}}/js/dz.carousel.min.js"></script>
<script src="{{asset('front')}}/js/dz.ajax.js"></script>
<script src="{{asset('front')}}/js/rev.slider.js"></script>

<!-- Select2 -->
<script src="{{asset('admin/plugins/select2/js/select2.full.min.js')}}"></script>

@if(session('error'))
    <script>
        toastr.error("{{ session('error') }}");
        @endif
    </script>
    @if(session('success'))
        <script>
            toastr.success("{{ session('success') }}");
            @endif
        </script>

        <script>
            $(document).ready(function () {
                'use strict';


                // تهيئة Revolution Slider
                if (typeof $.fn.revolution !== 'undefined') {
                    dz_rev_slider_1();
                }

                // select2
                initializeSelect2();

                toastr.options = {
                    "positionClass": "toast-top-right", // هنا نغير الموقع إلى أعلى اليسار
                    "closeButton": true,
                    "progressBar": true,
                    "showDuration": "1000", // مدة عرض الرسالة
                    "hideDuration": "1000", // مدة اختفاء الرسالة
                    "timeOut": "2000", // مدة عرض الرسالة قبل الاختفاء (بالملي ثانية)
                };


// دالة للتحقق من نوع المنتج
                function isAccessory(form) {
                    return form.find('input[name="product_type"]').val() === 'accessory';
                }


// دالة للتحقق من صحة بيانات المنتج
// دالة للتحقق من صحة بيانات المنتج
                function validateForm(form) {
                    if (isAccessory(form)) {
                        // إذا كان المنتج من نوع إكسسوار، لا نحتاج إلى التحقق
                        return true;
                    }

                    // التحقق من اختيار لون التلبيسة
                    if (!form.find('input[name="cover_color"]:checked').length) {
                        toastr.error('الرجاء اختيار لون التلبيسة');
                        return false;
                    }

                    // التحقق من اختيار عدد المقاعد
                    if (!form.find('input[name="seat_count"]:checked').length) {
                        toastr.error('الرجاء اختيار عدد المقاعد');
                        return false;
                    }

                    // التحقق من اختيار البراند والموديل
                    if (!form.find('select[name="car_brand"]').val()) {
                        toastr.error('الرجاء اختيار براند السيارة');
                        return false;
                    }

                    if (!form.find('select[name="car_model"]').val()) {
                        toastr.error('الرجاء اختيار موديل السيارة');
                        return false;
                    }


                    return true;
                }

                $(document).on('click', '.add-to-cart-btn', function (e) {
                    e.preventDefault();

                    // Get button reference
                    const $button = $(this);

                    // If button is already disabled, return early
                    if ($button.prop('disabled')) {
                        return;
                    }

                    // Get the form associated with the button
                    const form = $button.closest('form');
                    if (!validateForm(form)) {
                        return;
                    }

                    // Disable the button and maybe change its text/appearance
                    $button.prop('disabled', true);
                    $button.css('opacity', '0.5'); // Optional: visual feedback

                    $.ajax({
                        url: "{{route('cart.add')}}",
                        method: 'POST',
                        data: form.serialize(),

                        success: function (response) {
                            if (response.status === 'success') {
                                toastr.success(response.message);
                                form.find('.go-to-cart').fadeIn();

                                $('#cart-count-span').show();
                                $('#cart-count-span').text(response.cart_count);
                            }
                        },
                        error: function (xhr) {
                            console.log(xhr);
                            toastr.error('حدث خطأ أثناء إضافة المنتج للسلة', 'خطأ');
                        },
                        complete: function () {
                            // Re-enable the button after request completes (success or error)
                            $button.prop('disabled', false);
                            $button.css('opacity', '1'); // Optional: restore appearance
                        }
                    });
                });
            });

            function initializeSelect2() {
                $('.select2').select2({
                    theme: 'bootstrap4',
                    width: '100%',
                    language: {
                        noResults: function () {
                            return "لا توجد نتائج";
                        }
                    }
                });
            }
        </script>
        @stack('scripts')
        </body>
        <a href="https://wa.me/{{\App\Models\Admin\Setting::getValue('phone')}}" class="floating-whatsapp-head "
           target="_blank">
            <div class="whatsapp-icon">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 32"
                     class="wa-messenger-svg-whatsapp">
                    <path
                        d="M19.11 17.205c-.372 0-1.088 1.39-1.518 1.39a.63.63 0 0 1-.315-.1c-.802-.402-1.504-.817-2.163-1.447-.545-.516-1.146-1.29-1.46-1.963a.426.426 0 0 1-.073-.215c0-.33.99-.945.99-1.49 0-.143-.73-2.09-.832-2.335-.143-.372-.214-.487-.6-.487-.187 0-.36-.043-.53-.043-.302 0-.53.115-.746.315-.688.645-1.032 1.318-1.06 2.264v.114c-.015.99.472 1.977 1.017 2.78 1.23 1.82 2.506 3.41 4.554 4.34.616.287 2.035.888 2.722.888.817 0 2.15-.515 2.478-1.318.13-.33.244-.73.244-1.088 0-.058 0-.144-.03-.215-.1-.172-2.434-1.39-2.678-1.39zm-2.908 7.593c-1.747 0-3.48-.53-4.942-1.49L7.793 24.41l1.132-3.337a8.955 8.955 0 0 1-1.72-5.272c0-4.955 4.04-8.995 8.997-8.995S25.2 10.845 25.2 15.8c0 4.958-4.04 8.998-8.998 8.998zm0-19.798c-5.96 0-10.8 4.842-10.8 10.8 0 1.964.53 3.898 1.546 5.574L5 27.176l5.974-1.92a10.807 10.807 0 0 0 16.03-9.455c0-5.958-4.842-10.8-10.802-10.8z"
                        fill="#ffffff"
                        fill-rule="evenodd"/>
                </svg>
            </div>
            <span>تواصل معنا</span>
        </a>
        </html>
