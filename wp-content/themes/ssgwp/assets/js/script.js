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
    Logo Footer
    ========================================
    */
    if ($('.clients-testimonials-slider').length) {
        $('.clients-testimonials-slider').owlCarousel({
            loop: true,
            dots: false,
            margin: 50,
            autoplay: true,
            autoplayTimeout: 4000,
            smartSpeed: 1000,
            nav: true,
            navText: ['<i class="fas fa-angle-left"></i>', '<i class="fas fa-angle-right"></i>'],
            responsiveClass: true,
            responsive: {
                0: {
                    items: 1,
                    nav: false,
                    dots: true,
                },
                600: {
                    items: 2
                },
                1000: {
                    items: 3
                }
            }
        });
    }


    /*
    ========================================
    Counter
    ========================================
    */
    // if ($('.counter').length) {
    //     $('.counter').countUp({
    //         'time': 4000,
    //         'delay': 10
    //     });
    // }



})(jQuery);