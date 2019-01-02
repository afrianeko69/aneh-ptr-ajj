const { mix } = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */
mix.scripts('public/pintaria/js/custom.js', 'public/js/custom.min.js')
    .scripts([
        // Core Plugins
        'public/pintaria/plugins/jquery.min.js',
        'public/pintaria/plugins/jquery-migrate.min.js',
        'public/pintaria/plugins/bootstrap/js/bootstrap.min.js',
        'public/pintaria/plugins/jquery.easing.min.js',
        'public/pintaria/plugins/reveal-animate/wow.js',
        'public/pintaria/js/reveal-animate/reveal-animate.js',
        // Layout Plugins
        'public/pintaria/plugins/revo-slider/js/jquery.themepunch.tools.min.js',
        'public/pintaria/plugins/revo-slider/js/jquery.themepunch.revolution.min.js',
        'public/pintaria/plugins/revo-slider/js/extensions/revolution.extension.slideanims.min.js',
        'public/pintaria/plugins/revo-slider/js/extensions/revolution.extension.layeranimation.min.js',
        'public/pintaria/plugins/revo-slider/js/extensions/revolution.extension.navigation.min.js',
        'public/pintaria/plugins/revo-slider/js/extensions/revolution.extension.video.min.js',
        'public/pintaria/plugins/revo-slider/js/extensions/revolution.extension.parallax.min.js',
        'public/pintaria/plugins/cubeportfolio/js/jquery.cubeportfolio.min.js',
        'public/pintaria/plugins/owl-carousel/owl.carousel.min.js',
        'public/pintaria/plugins/counterup/jquery.waypoints.min.js',
        'public/pintaria/plugins/counterup/jquery.counterup.min.js',
        'public/pintaria/plugins/fancybox/jquery.fancybox.pack.js',
        'public/pintaria/plugins/smooth-scroll/jquery.smooth-scroll.min.js',
        'public/pintaria/plugins/typed/typed.min.js',
        'public/pintaria/plugins/slider-for-bootstrap/js/bootstrap-slider.min.js',
        'public/pintaria/plugins/js-cookie/js.cookie.js',
        'public/pintaria/plugins/autocomplete/jquery.autocomplete.min.js',
        // Theme Scripts
        'public/pintaria/js/components.min.js',
        'public/pintaria/js/components-shop.js',
        'public/pintaria/js/app.min.js',
    ], 'public/js/vendor.min.js')
    .scripts([
        // Page Scripts
        'public/pintaria/js/revo-slider/slider-5.js',
        'public/pintaria/plugins/isotope/isotope.pkgd.min.js',
        'public/pintaria/plugins/isotope/imagesloaded.pkgd.min.js',
        'public/pintaria/plugins/isotope/packery-mode.pkgd.min.js',
        'public/pintaria/plugins/ilightbox/js/jquery.requestAnimationFrame.js',
        'public/pintaria/plugins/ilightbox/js/jquery.mousewheel.js',
        'public/pintaria/plugins/ilightbox/js/ilightbox.packed.js',
        'public/pintaria/js/pages/isotope-gallery.js',
        'public/pintaria/plugins/spin/spin.min.js',
    ], 'public/js/scripts.min.js')
    .js([
        'resources/assets/js/app.js',
    ], 'public/js')
    .sass('resources/assets/sass/app.scss', 'public/css')
    .styles([
        'public/pintaria/css/custom.css'
    ], 'public/css/custom.min.css')
    .styles([
        // Start Mandatory
        'public/pintaria/plugins/bootstrap-social/bootstrap-social.css',
        'public/pintaria/modified-plugins/font-awesome/css/font-awesome.min.css',
        'public/pintaria/modified-plugins/simple-line-icons/simple-line-icons.min.css',
        'public/pintaria/plugins/animate/animate.min.css',
        'public/pintaria/modified-plugins/bootstrap/css/bootstrap.min.css',
        // End Mandatory
        // Start Base Plugins
        'public/pintaria/plugins/cubeportfolio/css/cubeportfolio.min.css',
        'public/pintaria/plugins/owl-carousel/assets/owl.carousel.css',
        'public/pintaria/modified-plugins/fancybox/jquery.fancybox.css',
        'public/pintaria/plugins/slider-for-bootstrap/css/slider.css',
        'public/pintaria/modified-plugins/ilightbox/css/ilightbox.css',
        // End Base Plugins
        // Start Theme
        'public/pintaria/css/plugins.css',
        'public/pintaria/css/themes/default.css',
        // End Theme
        'public/pintaria/css/components.css',
        'public/pintaria/plugins/revo-slider/css/navigation.css',
        'public/pintaria/plugins/revo-slider/css/settings.css',
        'public/pintaria/plugins/revo-slider/css/layers.css',
        'public/pintaria/plugins/autocomplete/autocomplete.css',
    ], 'public/css/vendor.min.css')
    .version();

mix
.styles([
    'public/pintaria3/css/bootstrap.min.css',
    'public/pintaria3/css/style.css',
    'public/pintaria3/css/menu_2.css',
    'public/pintaria3/css/swal/icons/error.css',
    'public/pintaria3/css/swal/icons/info.css',
    'public/pintaria3/css/swal/icons/success.css',
    'public/pintaria3/css/swal/icons/warning.css',
    'public/pintaria3/css/swal/button-loader.css',
    'public/pintaria3/css/swal/buttons.css',
    'public/pintaria3/css/swal/content.css',
    'public/pintaria3/css/swal/icons.css',
    'public/pintaria3/css/swal/sweetalert.css',
    'public/pintaria3/css/swal/text.css',
    'public/pintaria3/css/blog.css',
    'public/pintaria3/css/mixed/vendors.css',
    'public/pintaria3/css/mixed/all_icons.min.css',
    'public/pintaria3/css/mixed/layerslider.css',
], 'public/css/vendor-v3.min.css')
.styles([
    'public/pintaria3/css/custom.css',
], 'public/css/custom-v3.min.css')
.scripts([
    'public/pintaria3/js/jquery-2.2.4.min.js',
    'public/pintaria3/js/common_scripts.js',
    'public/pintaria3/js/main.js',
    'public/pintaria3/js/jqlight.lazyloadxt.min.js',
    'public/pintaria3/layerslider/js/greensock.js',
    'public/pintaria3/layerslider/js/layerslider.transitions.js',
    'public/pintaria3/layerslider/js/layerslider.kreaturamedia.jquery.js',
], 'public/js/common-v3.min.js')
.scripts([
    'public/pintaria3/js/custom.js'
], 'public/js/custom-v3.min.js')
.version();