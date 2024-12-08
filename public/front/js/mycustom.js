jQuery(document).ready(function () {
    'use strict';

    // تعريف دالة handleSupport
    function handleSupport() {

    }

    // تهيئة Magnific Popup
    $('.mfp-gallery').magnificPopup({
        delegate: 'a.mfp-link',
        type: 'image',
        tLoading: 'Loading image #%curr%...',
        mainClass: 'mfp-img-mobile',
        gallery: {
            enabled: true,
            navigateByImgClick: true,
            preload: [0, 1]
        }
    });


// تعريف الدالة في النطاق العام إذا كان مطلوباً
    window.handleSupport = function () {

    };
});
