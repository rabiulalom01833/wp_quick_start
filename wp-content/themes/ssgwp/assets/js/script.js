(function ($) {
    'use strict'

    /*
    ========================================
    Search Nav
    ========================================
    */ 
    $('.nav-button').on('click', function () {
        $('.header-menu').toggleClass('active');
    }); 
    $('.nav-close').on('click', function () {
        $('.header-menu').removeClass('active');
    }); 

    /*
    ========================================
    Testimonial
    ========================================
    */
    if ($('.hero-slider').length) {
        $('.hero-slider').owlCarousel({
            loop: true,
            dots: true,
            autoplay: true,
            autoplayTimeout: 5000,
            smartSpeed: 1500,
            responsiveClass: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 1
                },
                1000: {
                    items: 1
                }
            }
        });
    }


    /*
    ========================================
    Counter
    ========================================
    */
    if ($('.counter').length) {
        $('.counter').countUp({
            'time': 4000,
            'delay': 10
        });
    }



})(jQuery);