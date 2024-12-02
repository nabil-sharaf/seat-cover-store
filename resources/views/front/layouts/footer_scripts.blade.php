
<!-- JavaScript  files ========================================= -->
<script src="{{asset('front')}}/js/jquery.min.js"></script><!-- JQUERY.MIN JS -->
<script src="{{asset('front')}}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script><!-- BOOTSTRAP.MIN JS -->
<script src="{{asset('front')}}/plugins/bootstrap-select/bootstrap-select.min.js"></script><!-- FORM JS -->
<script src="{{asset('front')}}/plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.js"></script><!-- FORM JS -->
<script src="{{asset('front')}}/plugins/magnific-popup/magnific-popup.js"></script><!-- MAGNIFIC POPUP JS -->
<script src="{{asset('front')}}/plugins/counter/waypoints-min.js"></script><!-- WAYPOINTS JS -->
<script src="{{asset('front')}}/plugins/counter/counterup.min.js"></script><!-- COUNTERUP JS -->
<script src="{{asset('front')}}/plugins/imagesloaded/imagesloaded.js"></script><!-- IMAGESLOADED -->
<script src="{{asset('front')}}/plugins/masonry/masonry-3.1.4.js"></script><!-- MASONRY -->
<script src="{{asset('front')}}/plugins/masonry/masonry.filter.js"></script><!-- MASONRY -->
<script src="{{asset('front')}}/plugins/owl-carousel/owl.carousel.js"></script><!-- OWL SLIDER -->
<script src="{{asset('front')}}/plugins/rangeslider/rangeslider.js" ></script><!-- Rangeslider -->
<script>
    var imagesPath = "{{ asset('front/images') }}";
    var logoWhitePath = "{{ asset('storage/'.$siteImages?->footer_image) }}";
</script>
<script src="{{asset('front')}}/js/custom.min.js"></script><!-- CUSTOM FUCTIONS  -->
<script src="{{asset('front')}}/js/dz.carousel.min.js"></script><!-- SORTCODE FUCTIONS  -->

<script src="{{asset('front')}}/js/dz.ajax.js"></script><!-- CONTACT JS -->

<!-- REVOLUTION JS FILES -->
<script src="{{asset('front')}}/plugins/revolution/js/jquery.themepunch.tools.min.js"></script>
<script src="{{asset('front')}}/plugins/revolution/js/jquery.themepunch.revolution.min.js"></script>
<!-- Slider revolution 5.0 Extensions  (Load Extensions only on Local File Systems !  The following part can be removed on Server for On Demand Loading) -->
<script src="{{asset('front')}}/plugins/revolution/js/extensions/revolution.extension.actions.min.js"></script>
<script src="{{asset('front')}}/plugins/revolution/js/extensions/revolution.extension.carousel.min.js"></script>
<script src="{{asset('front')}}/plugins/revolution/js/extensions/revolution.extension.kenburn.min.js"></script>
<script src="{{asset('front')}}/plugins/revolution/js/extensions/revolution.extension.layeranimation.min.js"></script>
<script src="{{asset('front')}}/plugins/revolution/js/extensions/revolution.extension.migration.min.js"></script>
<script src="{{asset('front')}}/plugins/revolution/js/extensions/revolution.extension.navigation.min.js"></script>
<script src="{{asset('front')}}/plugins/revolution/js/extensions/revolution.extension.parallax.min.js"></script>
<script src="{{asset('front')}}/plugins/revolution/js/extensions/revolution.extension.slideanims.min.js"></script>
<script src="{{asset('front')}}/plugins/revolution/js/extensions/revolution.extension.video.min.js"></script>
<script src="{{asset('front')}}/js/rev.slider.js"></script>
<script>
    jQuery(document).ready(function() {
        'use strict';
        dz_rev_slider_1();
    });	/*ready*/
</script>
@stack('scripts')
</body>
</html>
