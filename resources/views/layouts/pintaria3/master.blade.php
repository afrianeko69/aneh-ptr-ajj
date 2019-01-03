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
    @yield('additional.metas')
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
                <img src="{{url($affiliate_logo)}}" width="149" data-retina="true" alt="" >
                @else
                <img src="{{ asset_cdn('pintaria/Logo-Pintaria.png') }}" alt="Pintaria" width="149" data-retina="true" alt="" class="blue_logo">
                @endif
                </a>
            </div>

            <!-- /top_menu -->
            <a class="btn_mobile">
                <div class="hamburger hamburger--spin" id="hamburger">
                    <div class="hamburger-box">
                        <div class="hamburger-inner"></div>
                    </div>
                </div>
            </a>

            <!-- /trigger_search -->
            <a href="javascript:void(0)" class="trigger-search d-block d-xl-none"><i class="fa fa-search"></i></a>

            <div id="global-search">
                @include('layouts.pintaria3.partials.menu')
                <div class="mobile-search d-block d-xl-none">
                    {!! Form::open(['url' => route('home.global.search'),'method' => 'get', 'id' => 'mobile-global-search']) !!}
                        <global-search {!! !empty($search_placeholder) ? 'search-placeholder=\'' . strip_tags($search_placeholder->description) . '\'' : '' !!}></global-search>
                    {!! Form::close() !!}
                </div>
            </div>
        </header>
        @include('layouts.pintaria3.partials.overflow-menu')

        <main>
            @yield('content')
        </main>

        <footer>
            <div class="container margin_120_95">
                <div class="row">
                    <div class="col-lg-3 col-md-3">
                        <div class="c-container c-first">
                            <div class="c-content-title-1">
                                <h5>PINTARIA</h5>
                            </div>
                            <ul class="c-links">
                                <li><a href="{{url('berita')}}">Berita</a></li>
                                <li><a href="{{url('blog')}}">Blog</a></li>
                                <li><a href="{{url('tentang-kami')}}">Tentang Kami</a></li>
                                <li><a href="{{url('hubungi-kami')}}">Hubungi Kami</a></li>
                                <li><a href="{{url('perjanjian-pengguna')}}">Perjanjian Pengguna</a></li>
                                <li><a href="{{url('kebijakan-privasi')}}">Kebijakan Privasi</a></li>
                                <li><a href="https://harukaedu.com/pengajar" target="_blank">Ayo Mengajar</a></li>
                                <li><a href="https://id.jooble.org" target="_blank">Lowongan Kerja Populer</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-md-6">
                        @include('shared.pintaria3.newsletter')
                    </div>

                    <div class="col-lg-3 col-md-3">

                        <h5>PEMBAYARAN</h5>
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                            <img data-src="{{url('pintaria3/img/payment/visa.png')}}" class="img-responsive payment-icons">
                            <img data-src="{{url('pintaria3/img/payment/mastercard.png')}}" class="img-responsive payment-icons">
                            <img data-src="{{url('pintaria3/img/payment/mandiri.png')}}" class="img-responsive payment-icons">
                            <img data-src="{{url('pintaria3/img/payment/permata.png')}}" class="img-responsive payment-icons">
                            <img data-src="{{url('pintaria3/img/payment/ATMBersama.png')}}" class="img-responsive payment-icons">
                            <img data-src="{{url('pintaria3/img/payment/mandiriclickpay.png')}}" class="img-responsive payment-icons">
                            <img data-src="{{url('pintaria3/img/payment/CIMBclicks.png')}}" class="img-responsive payment-icons">
                            </div>
                        </div>

                        <h5>IKUTI KAMI</h5>
                        <div class="social">
                            <a target="_blank" href="https://www.facebook.com/Pintaria-1279978625403492/"><i class="fa fa-facebook-official fa-2x" aria-hidden="true"></i></a>
                            <a target="_blank" href="https://twitter.com/pintariaid"><i class="fa fa-twitter fa-2x" aria-hidden="true"></i></a>
                            <a target="_blank" href="https://www.youtube.com/channel/UC0xS7uOPfE3uwTtYhYN3tYg"><i class="fa fa-youtube fa-2x" aria-hidden="true"></i></a>
                            <a target="_blank" href="https://plus.google.com/u/3/105831708780258410777"><i class="fa fa-google-plus fa-2x" aria-hidden="true"></i></a>
                            <a target="_blank" href="https://www.instagram.com/pintariaid/"><i class="fa fa-instagram fa-2x" aria-hidden="true"></i></a>
                        </div>
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
    @include('shared.float-help')
</body>
</html> 
