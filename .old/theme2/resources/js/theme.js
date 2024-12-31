/*-----------------------------------------------------------------------------------

    Template Name: Pesco - eCommerce HTML Template
    URI: site.com
    Description: Pesco is a clean, modern, and elegant fashion e-commerce HTML template. It allows you to easily create a well-designed e-commerce website that is easily customizable to fit your brand colors and requirements.
    Author: Pixelfit
    Author URI: https://themeforest.net/user/pixelfit
    Version: 1.0

    Note: This is Main Js file
-----------------------------------------------------------------------------------
    Js INDEX
    ===================
    ## Main Menu
    ## Document Ready
    ## Nav Overlay
    ## Preloader
    ## Sticky
    ## Back to top
    ## Magnific-popup js
    ## Nice select
    ## Slick Slider
    ## Quantity Number js
    ## Jquery Slider Range
    ## Simply Countdown Js
    ## Show More Active JS
    ## AOS Js

-----------------------------------------------------------------------------------*/

import AOS from 'aos';

(function($) {
    'use strict';

    //===== Main Menu
    function mainMenu() {

        // Variables
        var var_window = $(window),
        navContainer = $('.header-navigation'),
        navbarToggler = $('.navbar-toggler'),
        navMenu = $('.pesco-nav-menu'),
        navMenuLi = $('.pesco-nav-menu ul li ul li'),
        closeIcon = $('.navbar-close');

        // navbar toggler

        navbarToggler.on('click', function() {
            navbarToggler.toggleClass('active');
            navMenu.toggleClass('menu-on');
        });

        // close icon

        closeIcon.on('click', function() {
            navMenu.removeClass('menu-on');
            navbarToggler.removeClass('active');
        });

        // adds toggle button to li items that have children

        navMenu.find("li a").each(function() {
            if ($(this).children('.dd-trigger').length < 1) {
                if ($(this).next().length > 0) {
                    $(this).append('<span class="dd-trigger"><i class="far fa-angle-down"></i></span>')
                }
            }
        });

        // expands the dropdown menu on each click

        navMenu.find(".dd-trigger").on('click', function(e) {
            e.preventDefault();
            $(this).parent().parent().siblings().children('ul.sub-menu').slideUp();
            $(this).parent().next('ul.sub-menu').stop(!0, !0).slideToggle(350);
            $(this).toggleClass('sub-menu-open')
        });

    };

    // Offcanvas Overlay

    function offCanvas(){
        $(".cart-button").on("click", function() {
            $(".sidemenu-wrapper-cart").addClass("info-open");
        });
        $(".navbar-toggler, .offcanvas__overlay,.cart-button").on('click', function (e) {
            $(".offcanvas__overlay").toggleClass("overlay-open");
        });
        $(".offcanvas__overlay").on('click', function (e) {
            $(".navbar-toggler").removeClass("active");
            $(".pesco-nav-menu").removeClass("menu-on");
            $(".sidemenu-wrapper-cart").removeClass("info-open");
        });
        $(".sidemenu-cart-close").on("click", function() {
            $(".sidemenu-wrapper-cart").removeClass("info-open");
            $(".offcanvas__overlay").removeClass("overlay-open");
        });
    }

    // Document Ready
    $(function() {
        mainMenu();
        offCanvas();
    });


    //===== Preloader
    $(window).on('load', function(event) {
        //===== Preloader
        $('.preloader').delay(500).fadeOut(500);
    })


    //===== Sticky

    $(window).on('scroll', function(event) {
        var scroll = $(window).scrollTop();
        if (scroll < 100) {
            $(".header-navigation").removeClass("sticky");
        } else {
            $(".header-navigation").addClass("sticky");
        }
    });

    //===== Back to top

    $(window).on('scroll', function(event) {
        if ($(this).scrollTop() > 600) {
            $('.back-to-top').fadeIn(200)
        } else {
            $('.back-to-top').fadeOut(200)
        }
    });
    $('.back-to-top').on('click', function(event) {
        event.preventDefault();
        $('html, body').animate({
            scrollTop: 0,
        }, 1500);
    });

    //===== Magnific-popup js

    if ($('.video-popup').length){
        $('.video-popup').magnificPopup({
            type: 'iframe',
            removalDelay: 300,
            mainClass: 'mfp-fade'
        });
    }

    if ($('.img-popup').length){
        $(".img-popup").magnificPopup({
            type: "image",
             gallery: {
              enabled: true
            }
        });
    }

    //===== Nice select js

    if ($('select').length){
        $('select').niceSelect();
    }

    //===== Slick slider js

    if ($('.hero-slider-one').length) {
        var sliderDots = $('.hero-dots');
        $('.hero-slider-one').slick({
            dots: true,
            arrows: false,
            infinite: true,
            speed: 800,
            appendArrows: sliderArrows,
            appendDots: sliderDots,
            autoplay: false,
            vertical: true,
            slidesToShow: 1,
            slidesToScroll: 1,
            prevArrow: '<div class="prev"><i class="flaticon-arrow-left"></i><img src="assets/images/hero/arrow-bg.png" alt=""></div>',
            nextArrow: '<div class="next"><img src="assets/images/hero/arrow-bg.png" alt=""><i class="flaticon-arrow-right"></i></div>',
            responsive: [
                {
                    breakpoint: 1200,
                    settings: {
                        dots: false
                    }
                },
                {
                    breakpoint: 767,
                    settings: {
                        vertical: false,
                    }
                }
            ]
        });
    }
    if ($('.hero-post-slider').length) {
        var sliderDots = $('.hero-dots');
        $('.hero-post-slider').slick({
            dots: true,
            arrows: false,
            infinite: true,
            speed: 800,
            appendDots: sliderDots,
            autoplay: false,
            slidesToShow: 1,
            slidesToScroll: 1,
            prevArrow: '<div class="prev"><i class="flaticon-arrow-left"></i></div>',
            nextArrow: '<div class="next"><i class="flaticon-arrow-right"></i></div>'
        });
    }


    if ($('.category-slider-one').length) {
        var sliderArrows = $('.category-arrows');
        $('.category-slider-one').slick({
            dots: false,
            arrows: true,
            infinite: true,
            speed: 800,
            appendArrows: sliderArrows,
            autoplay: false,
            slidesToShow: 6,
            slidesToScroll: 1,
            prevArrow: '<div class="prev"><i class="flaticon-arrow-left"></i></div>',
            nextArrow: '<div class="next"><i class="flaticon-arrow-right"></i></div>',
            responsive: [
                {
                    breakpoint: 1200,
                    settings: {
                        slidesToShow: 3,
                    }
                },
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 2,
                    }
                },
                {
                    breakpoint: 767,
                    settings: {
                        slidesToShow: 1,
                    }
                }
            ]
        });
    }

    if ($('.feature-slider-one').length) {
        var sliderArrows = $('.feature-arrows');
        $('.feature-slider-one').slick({
            dots: false,
            arrows: true,
            infinite: true,
            speed: 800,
            appendArrows: sliderArrows,
            autoplay: false,
            slidesToShow: 4,
            slidesToScroll: 1,
            prevArrow: '<div class="prev"><i class="flaticon-arrow-left"></i></div>',
            nextArrow: '<div class="next"><i class="flaticon-arrow-right"></i></div>',
            responsive: [
                {
                    breakpoint: 1200,
                    settings: {
                        slidesToShow: 3,
                    }
                },
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 2,
                    }
                },
                {
                    breakpoint: 767,
                    settings: {
                        slidesToShow: 1,
                    }
                }
            ]
        });
    }

    if ($('.trending-products-slider').length) {
        var sliderArrows = $('.trending-product-arrows');
        $('.trending-products-slider').slick({
            dots: false,
            arrows: true,
            infinite: true,
            speed: 800,
            appendArrows: sliderArrows,
            autoplay: false,
            slidesToShow: 5,
            slidesToScroll: 1,
            prevArrow: '<div class="prev"><i class="flaticon-arrow-left"></i></div>',
            nextArrow: '<div class="next"><i class="flaticon-arrow-right"></i></div>',
            responsive: [
                {
                    breakpoint: 1600,
                    settings: {
                        slidesToShow: 4
                    }
                },
                {
                    breakpoint: 1400,
                    settings: {
                        slidesToShow: 3
                    }
                },
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 2
                    }
                },
                {
                    breakpoint: 767,
                    settings: {
                        slidesToShow: 1
                    }
                }
            ]
        });
    }
    if ($('.today-deals-slider').length) {
        var sliderArrows = $('.today-deals-arrows');
        $('.today-deals-slider').slick({
            dots: false,
            arrows: true,
            infinite: true,
            speed: 800,
            centerMode: true,
            appendArrows: sliderArrows,
            autoplay: false,
            slidesToShow: 3,
            slidesToScroll: 1,
            prevArrow: '<div class="prev"><i class="flaticon-arrow-left"></i></div>',
            nextArrow: '<div class="next"><i class="flaticon-arrow-right"></i></div>',
            responsive: [
                {
                    breakpoint: 1500,
                    settings: {
                        centerMode: false,
                        variableWidth: true,
                        slidesToShow: 2
                    }
                },
                {
                    breakpoint: 1024,
                    settings: {
                        centerMode: false,
                        variableWidth: true,
                        slidesToShow: 2
                    }
                },
                {
                    breakpoint: 575,
                    settings: {
                        slidesToShow: 1,
                        centerMode: false,
                        variableWidth: false
                    }
                }
            ]
        });
    }
    if ($('.testimonial-slider-one').length) {
        var sliderArrows = $('.testimonial-arrows');
        $('.testimonial-slider-one').slick({
            dots: false,
            arrows: true,
            infinite: true,
            speed: 800,
            appendArrows: sliderArrows,
            autoplay: true,
            slidesToShow: 1,
            variableWidth: true,
            slidesToScroll: 1,
            prevArrow: '<div class="prev"><i class="flaticon-arrow-left"></i></div>',
            nextArrow: '<div class="next"><i class="flaticon-arrow-right"></i></div>',
            responsive: [
                {
                    breakpoint: 1200,
                    settings: {
                        slidesToShow: 2
                    }
                },
                {
                    breakpoint: 767,
                    settings: {
                        variableWidth: false,
                        slidesToShow: 1
                    }
                }
            ]
        });
    }
    if ($('.testimonial-slider-two').length) {
        $('.testimonial-slider-two').slick({
            dots: false,
            arrows: true,
            infinite: true,
            speed: 800,
            autoplay: true,
            slidesToShow: 1,
            slidesToScroll: 1,
            prevArrow: '<div class="prev"><i class="flaticon-arrow-left"></i></div>',
            nextArrow: '<div class="next"><i class="flaticon-arrow-right"></i></div>'
        });
    }
    if ($('.weekly-top-product-slider').length) {
        $('.weekly-top-product-slider').slick({
            dots: false,
            arrows: false,
            infinite: true,
            speed: 800,
            autoplay: true,
            slidesToShow: 3,
            variableWidth: true,
            slidesToScroll: 1,
            prevArrow: '<div class="prev"><i class="flaticon-arrow-left"></i></div>',
            nextArrow: '<div class="next"><i class="flaticon-arrow-right"></i></div>',
            responsive: [
                {
                    breakpoint: 1200,
                    settings: {
                        slidesToShow: 2
                    }
                },
                {
                    breakpoint: 767,
                    settings: {
                        slidesToShow: 1
                    }
                }
            ]
        });
    }
    if ($('.team-slider-one').length) {
        var sliderDots = $('.team-slider-dots');
        var sliderArrows = $('.team-arrows');
        $('.team-slider-one').slick({
            dots: true,
            arrows: true,
            infinite: true,
            speed: 800,
            appendArrows: sliderArrows,
            appendDots: sliderDots,
            autoplay: true,
            centerMode: true,
            slidesToShow: 6,
            slidesToScroll: 1,
            prevArrow: '<div class="prev"><i class="flaticon-arrow-left"></i></div>',
            nextArrow: '<div class="next"><i class="flaticon-arrow-right"></i></div>',
            responsive: [
                {
                    breakpoint: 1400,
                    settings: {
                        slidesToShow: 4
                    }
                },
                {
                    breakpoint: 1200,
                    settings: {
                        slidesToShow: 2
                    }
                },
                {
                    breakpoint: 767,
                    settings: {
                        slidesToShow: 1
                    }
                }
            ]
        });
    }

    if ($('.releted-product-slider').length) {
        var sliderArrows = $('.releted-product-arrows');
        $('.releted-product-slider').slick({
            dots: false,
            arrows: true,
            infinite: true,
            speed: 800,
            appendArrows: sliderArrows,
            autoplay: false,
            slidesToShow: 4,
            slidesToScroll: 1,
            prevArrow: '<div class="prev"><i class="flaticon-arrow-left"></i></div>',
            nextArrow: '<div class="next"><i class="flaticon-arrow-right"></i></div>',
            responsive: [
                {
                    breakpoint: 1200,
                    settings: {
                        slidesToShow: 3,
                    }
                },
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 2
                    }
                },
                {
                    breakpoint: 767,
                    settings: {
                        slidesToShow: 1
                    }
                }
            ]
        });
    }

    if ($('.product-big-slider').length) {
        $('.product-big-slider').slick({
            dots: false,
            arrows: false,
            speed: 800,
            autoplay: true,
            fade: true,
            asNavFor: '.product-thumb-slider',
            slidesToShow: 1,
            slidesToScroll: 1,
            prevArrow: '<div class="prev"><i class="far fa-angle-left"></i></div>',
            nextArrow: '<div class="next"><i class="far fa-angle-right"></i></div>'
        });
    }
    if ($('.product-thumb-slider').length) {
        $('.product-thumb-slider').slick({
            dots: false,
            arrows: false,
            speed: 800,
            autoplay: true,
            asNavFor: '.product-big-slider',
            focusOnSelect: true,
            slidesToShow: 4,
            slidesToScroll: 1,
            prevArrow: '<div class="prev"><i class="far fa-angle-left"></i></div>',
            nextArrow: '<div class="next"><i class="far fa-angle-right"></i></div>'
        });
    }

    if ($('.blogs-slider-one').length) {
        var sliderArrows = $('.blogs-arrows');
        $('.blogs-slider-one').slick({
            dots: false,
            arrows: true,
            infinite: true,
            speed: 800,
            appendArrows: sliderArrows,
            autoplay: false,
            slidesToShow: 4,
            slidesToScroll: 1,
            prevArrow: '<div class="prev"><i class="flaticon-arrow-left"></i></div>',
            nextArrow: '<div class="next"><i class="flaticon-arrow-right"></i></div>',
            responsive: [
                {
                    breakpoint: 1200,
                    settings: {
                        slidesToShow: 2,
                    }
                },
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 2,
                    }
                },
                {
                    breakpoint: 575,
                    settings: {
                        slidesToShow:1,
                    }
                }
            ]
        });
    }
    if ($('.instagram-slider-one').length) {
        $('.instagram-slider-one').slick({
            dots: false,
            arrows: false,
            infinite: true,
            speed: 800,
            appendArrows: sliderArrows,
            autoplay: false,
            slidesToShow: 6,
            slidesToScroll: 1,
            prevArrow: '<div class="prev"><i class="flaticon-arrow-left"></i></div>',
            nextArrow: '<div class="next"><i class="flaticon-arrow-right"></i></div>',
            responsive: [
                {
                    breakpoint: 1200,
                    settings: {
                        slidesToShow: 2,
                    }
                },
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 2,
                    }
                },
                {
                    breakpoint: 575,
                    settings: {
                        slidesToShow:1,
                    }
                }
            ]
        });
    }
    //======= Quantity Number js

    $('.quantity-down').on('click', function(){
        var numProduct = Number($(this).next().val());
        if(numProduct > 1) $(this).next().val(numProduct - 1);
    });
    $('.quantity-up').on('click', function(){
        var numProduct = Number($(this).prev().val());
        $(this).prev().val(numProduct + 1);
    });

    //===== Slider Range

    $( "#slider-range" ).slider({
        range: true,
        min: 0,
        max: 200,
        values: [ 19, 140 ],
        slide: function( event, ui ) {
          $( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
        }
    });
    $( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) + " - $" + $( "#slider-range" ).slider( "values", 1 ) );




    //===== Simply Countdown

    if ($('.simply-countdown').length){
        simplyCountdown('.simply-countdown', {
            year: 2024,
            month: 12,
            day: 31,
            words: { //words displayed into the countdown
                days: { singular: 'day', plural: 'Days' },
                hours: { singular: 'hour', plural: 'Hours' },
                minutes: { singular: 'minute', plural: 'Min' },
                seconds: { singular: 'second', plural: 'Sec' }
            },
        });
        simplyCountdown('.simply-countdown-two', {
            year: 2024,
            month: 12,
            day: 31,
            words: { //words displayed into the countdown
                days: { singular: 'day', plural: 'Days' },
                hours: { singular: 'hour', plural: 'Hours' },
                minutes: { singular: 'minute', plural: 'Min' },
                seconds: { singular: 'second', plural: 'Sec' }
            },
        });
    }


    //===== Show More Burtton

    $(".more_slide_open").slideUp();
    $(".more_categories").on("click", function () {
        $(this).toggleClass("show");
        $(".more_slide_open").slideToggle();
    });

    //====== Aos JS

    AOS.init({
        offset: 0
    });

})(window.jQuery);
