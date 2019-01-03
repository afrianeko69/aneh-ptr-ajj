<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <meta name="description" content="@yield('meta_description')" />
    <meta name="author" content="Pintaria" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>
        @if (!empty($affiliate_site_title))
            {{$affiliate_site_title}}
        @else
            @yield('title')
        @endif
    </title>

    @include('shared.gtm-js')
    <!-- Favicons-->
    @if (!empty($affiliate_favicon))
    <link rel="icon" type="image/png" href="{{url($affiliate_favicon)}}" />
    @else
    <link rel="icon" type="image/png" href="{{ asset_cdn('pintaria/favicon.png') }}" />
    @endif
    @include('shared.zopim')
    <link href='fonts/fontawesome-webfont.woff2' rel='stylesheet' type='text/css'>

    <!-- <link href='//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' rel='stylesheet' type='text/css'> -->
    <link rel="stylesheet" type="text/css" href="{{ mix('css/vendor-v3.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ mix('css/custom-v3.min.css') }}">

    @yield('additional.styles')
    @include('layouts.pintaria3.partials.stylesheet')

    <script>
        // Picture element HTML5 shiv
        document.createElement( "picture" );
    </script>
    <script type="text/javascript" src="https://cdn.rawgit.com/scottjehl/picturefill/3.0.2/dist/picturefill.min.js" async></script>
</head>
<body>
    @include('shared.gtm-no-js')
    <div id="page">
        <header class="header mm-slideout fadeInDown">
            <div id="preloader"><div data-loader="circle-side"></div></div><!-- /Preload -->
            <div id="logo">
                <a href="{{route('home')}}">
                @if (!empty($affiliate_logo))
                <img src="{{url($affiliate_logo)}}" height="65" data-retina="true" alt="" >
                @else
                <img src="{{ asset_cdn('pintaria/Logo-Pintaria.png') }}" alt="Pintaria" height="65" data-retina="true" alt="" class="blue_logo">
                @endif
                </a>
            </div>

            <div class="float-right" style="margin: 20px;">
                @if (!empty(auth()->user()))
                    <a href="{{ route('affiliate.logout') }}" >LOGOUT</a>
                @else
                    <a href="{{ route('affiliate.index') }}" >LOGIN</a>
                @endif
            </div>
        </header>
        @include('layouts.pintaria3.partials.overflow-menu')

        <main class="add_top_120 add_bottom_60">
            @yield('content')
        </main>

        <footer>
            <div class="container margin_20_50">
                <br clear="both">
                <div class="row ">
                    <div class="col-3">
                        <center><a href="{{url('tentang-kami')}}">Tentang Kami</a></center>
                    </div>
                    <div class="col-3">
                        <center><a href="{{url('hubungi-kami')}}">Hubungi Kami</a></center>
                    </div>
                    <div class="col-3">
                        <center> <a href="{{url('perjanjian-pengguna')}}">Perjanjian Pengguna</a></center>
                    </div>
                    <div class="col-3">
                        <center><a href="{{url('kebijakan-privasi')}}">Kebijakan Privasi</a></center>
                    </div>
                </div>
                <!--/row-->
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <div id="copy">{{date('Y')}} &copy; Pintaria. Powered by HarukaEDU</div>
                    </div>
                </div>
            </div>
        </footer>
        <!--/footer-->
    </div>

    <!-- COMMON SCRIPTS -->
    @include('layouts.pintaria3.partials.javascript')
    @include('layouts.pintaria3.partials.modal')
    <script src="//unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="{{ mix('js/common-v3.min.js') }}"></script>
    <script type="text/javascript">
        'use strict';
        $('#layerslider').layerSlider({
            autoStart: true,
            navButtons: false,
            navStartStop: false,
            showCircleTimer: false,
            responsive: true,
            responsiveUnder: 1280,
            layersContainer: 1200,
            skinsPath: 'pintaria3/layerslider/skins/'
                // Please make sure that you didn't forget to add a comma to the line endings
                // except the last line!
        });
    </script>
    <script src="{{ mix('js/custom-v3.min.js') }}"></script>
    <script src="{{ mix('js/app.js') }}"></script>
    @stack('scripts')
    @yield('additional.scripts')
</body>
</html>