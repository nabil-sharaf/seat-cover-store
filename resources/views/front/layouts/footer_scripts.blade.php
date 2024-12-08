<!-- jQuery أولاً - استخدم نسخة واحدة فقط -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="{{asset('front')}}/js/mycustom.js"></script>
<script src="{{asset('front')}}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Swiper JS -->
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
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
            "positionClass": "toast-top-left", // هنا نغير الموقع إلى أعلى اليسار
            "closeButton": true,
            "progressBar": true,
            "showDuration": "2000", // مدة عرض الرسالة
            "hideDuration": "1000", // مدة اختفاء الرسالة
            "timeOut": "4000", // مدة عرض الرسالة قبل الاختفاء (بالملي ثانية)
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

        $(document).on('click', '.add-to-cart-btnnn', function (e) {
            e.preventDefault();
            // الحصول على الفورم المرتبط بالزر
            const form = $(this).closest('form');
            if (!validateForm(form)) {
                return;
            }
            $.ajax({
                url: "{{route('cart.add')}}",
                method: 'POST',
                data: form.serialize(), // تجميع بيانات الفورم

                success: function (response) {
                    if (response.status === 'success') {

                        // عرض رسالة النجاح
                        toastr.success(response.message);
                    }
                },
                error: function (xhr) {
                    console.log(xhr)
                    toastr.error('حدث خطأ أثناء إضافة المنتج للسلة', 'خطأ');
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
</html>
