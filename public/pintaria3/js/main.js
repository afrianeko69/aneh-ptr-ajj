(function ($) {

    "use strict";
    
    $(window).on('load', function () {
        $('[data-loader="circle-side"]').fadeOut(); // will first fade out the loading animation
        $('#preloader').delay(350).fadeOut('slow'); // will fade out the white DIV that covers the website.
        $('body').delay(350);
        $('#hero_in h1').addClass('animated');
        $('.hero_single, #hero_in').addClass('start_bg_zoom');
        $(window).scroll();
    });
    
    // Sticky nav
    $(window).on('scroll', function () {
        if ($(this).scrollTop() > 1) {
            $('.header').addClass("sticky");
        } else {
            if($(window).width() < 992) {
                fixSearchBoxForTabletToMobile();
            } else {
                $('.header').removeClass("sticky");
            }
        }
    });
    
    // Sticky sidebar
    $('#sidebar').theiaStickySidebar({
        additionalMarginTop: 150
    });
    
    // Header button explore
    $('a[href^="#"].btn_explore').on('click', function (e) {
            e.preventDefault();
            var target = this.hash;
            var $target = $(target);
            $('html, body').stop().animate({
                'scrollTop': $target.offset().top
            }, 800, 'swing', function () {
                window.location.hash = target;
            });
        });
    
    // WoW - animation on scroll
    var wow = new WOW(
      {
        boxClass:     'wow',      // animated element css class (default is wow)
        animateClass: 'animated', // animation css class (default is animated)
        offset:       0,          // distance to the element when triggering the animation (default is 0)
        mobile:       true,       // trigger animations on mobile devices (default is true)
        live:         true,       // act on asynchronously loaded content (default is true)
        callback:     function(box) {
          // the callback is fired every time an animation is started
          // the argument that is passed in is the DOM node being animated
        },
        scrollContainer: null // optional scroll container selector, otherwise use window
      }
    );
    wow.init();

    // tooltips
     $('[data-toggle="tooltip"]').tooltip();
    
    // Accordion
    function toggleChevron(e) {
        $(e.target)
            .prev('.card-header')
            .find("i.indicator")
            .toggleClass('ti-minus ti-plus');
    }
    $('#accordion_lessons').on('hidden.bs.collapse shown.bs.collapse', toggleChevron);
        function toggleIcon(e) {
        $(e.target)
            .prev('.panel-heading')
            .find(".indicator")
            .toggleClass('ti-minus ti-plus');
    }
    $('.panel-group').on('hidden.bs.collapse', toggleIcon);
    $('.panel-group').on('shown.bs.collapse', toggleIcon);

    function toggleMenuOfHamburger() {
        var $menu= $('#main_menu');
        $menu.toggleClass('show');
        $menu.find('nav').toggleClass('animated fadeIn');
        $('.header').toggleClass('sticky_menu_active');

        var hamburgerMenu = $('.hamburger');
        hamburgerMenu.toggleClass('float-right');

        var triggerSearch = $('.trigger-search');
        if(hamburgerMenu.hasClass('float-right')) {
            triggerSearch.removeClass('d-block').addClass('d-none');
        } else {
            triggerSearch.removeClass('d-none').addClass('d-block');
        }
    }

    // Hamburger icon
    $('.hamburger').on('click', function () {
        toggleMenuOfHamburger();
    });
    var forEach=function(t,o,r){if("[object Object]"===Object.prototype.toString.call(t))for(var c in t)Object.prototype.hasOwnProperty.call(t,c)&&o.call(r,t[c],c,t);else for(var e=0,l=t.length;l>e;e++)o.call(r,t[e],e,t)};
    var hamburgers = document.querySelectorAll(".hamburger");
    if (hamburgers.length > 0) {
      forEach(hamburgers, function(hamburger) {
        hamburger.addEventListener('click', function() {
          this.classList.toggle('is-active');
        }, false);
      });
    };

    // Selectbox
    $(".selectbox").selectbox();

    // Check and radio input styles
    $('input.icheck').iCheck({
        checkboxClass: 'icheckbox_square-grey',
        radioClass: 'iradio_square-grey'
    });
    
    // Carousels
    $('#carousel').owlCarousel({
        center: true,
        items: 2,
        loop: true,
        margin: 10,
        responsive: {
            0: {
                items: 1,
                dots:false
            },
            600: {
                items: 2
            },
            1000: {
                items: 4
            }
        }
    });
    
    $('.carousels').owlCarousel({
        center: true,
        items: 2,
        lazyLoad: true,
        loop: true,
        margin: 0,
        nav: true,
        responsive: {
            0: {
                items: 1
            },
            767: {
                items: 2
            },
            1000: {
                items: 3
            },
            1400: {
                items: 4
            }
        }
    });

    // Sticky filters
    $(window).bind('load resize', function () {
        var width = $(window).width();
        if (width <= 991) {
            $('.sticky_horizontal').stick_in_parent({
                offset_top: 50
            });
        } else {
            $('.sticky_horizontal').stick_in_parent({
                offset_top: 73
            });
        }
    });
                
    // Secondary nav scroll
    var $sticky_nav= $('.secondary_nav');
    $sticky_nav.find('a').on('click', function(e) {
        e.preventDefault();
        var target = this.hash;
        var $target = $(target);
        $('html, body').animate({
            'scrollTop': $target.offset().top - 150
        }, 800, 'swing');
    });
    $sticky_nav.find('ul li a').on('click', function () {
        $sticky_nav.find('ul li a.active').removeClass('active');
        $(this).addClass('active');
    });

    // Scrollto any div
    $('a[rel="relativeanchor"]').click(function(){
        $('html, body').animate({
            'scrollTop': $( this.hash ).offset().top - 70
        }, 500);
        toggleMenuOfHamburger();
        $('.hamburger').toggleClass('is-active');
        return false;
    });

    // show hide mobile search
    $('.trigger-search').click(function(evt){
        evt.stopPropagation();
        $('.mobile-search').addClass('show');
        $('.header').addClass('sticky');
    });
    $(document).on('click', '.search-box', function(evt) {
        evt.stopPropagation();
        $('.mobile-search').addClass('show');
    });
    $(document).on('click', '.search-btn', function(){
        $('#mobile-global-search').submit();
    });
    $(document).click(function(e) {
        if ( $(e.target).closest('.mobile-search').length === 0 ) {
            $('.mobile-search').removeClass('show');
            var scroll = $(window).scrollTop();
            if (scroll == 0) {
                $('.header').removeClass('sticky');
            }
        }
    });

    // Hide filter program on mobile
    if ( $(window).width() <= 768 ) {
        $('#filters_col a[data-toggle="collapse"]').addClass('collapsed').attr('aria-expanded','false');
        $('#filters_col .collapse').removeClass('show');

        //define width scroll tab detail program
        var tabList = $('.scroll-tab ul li');
        var scrollTabWidth = 40;
        $.each(tabList, function(q, value){
            scrollTabWidth += $(value).width() + 20;
        });

        $('.scroll-tab ul').width(scrollTabWidth);
    }

    function fixSearchBoxForTabletToMobile() {
        var wrapper = $('header #global-search .mobile-search');
        if(wrapper.hasClass('show')) {
            $('header .mm-slideout').addClass('sticky');
        } else {
            $('.header').removeClass("sticky");
        }
    }

    // Slider Initial
    $('.carousel').carousel({
        pause: "hover"
    });
    
})(window.jQuery);