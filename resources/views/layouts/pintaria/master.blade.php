<!DOCTYPE html>
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en"  >
<!--<![endif]-->
<head>
    <meta charset="utf-8"/>
    <title>
    @if (!empty($affiliate_site_title))
        {{$affiliate_site_title}}
    @else
        @yield('title')
    @endif
    </title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <meta name="description" content="@yield('meta_description')" />
    <meta name="author" content="Pintaria" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    @include('shared.gtm-js')
    <link href='//fonts.googleapis.com/css?family=Roboto+Condensed:300italic,400italic,700italic,400,300,700&amp;subset=all' rel='stylesheet' type='text/css'>
    <link href="{{ mix('css/vendor.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ mix('css/custom.min.css') }}" rel="stylesheet" type="text/css"/>
    @yield('additional.styles')

    @if (!empty($affiliate_favicon))
    <link rel="icon" type="image/png" href="{{ $affiliate_favicon }}" />
    @else
    <link rel="icon" type="image/png" href="{{url('pintaria/favicon.png')}}" />
    @endif
    @include('shared.zopim')

    <script>
        // Picture element HTML5 shiv
        document.createElement( "picture" );
    </script>
    <script type="text/javascript" src="https://cdn.rawgit.com/scottjehl/picturefill/3.0.2/dist/picturefill.min.js" async></script>

</head>
<body class="c-layout-header-fixed c-layout-header-mobile-fixed"> 
    @include('shared.gtm-no-js')
    <div id="app">
        <!-- BEGIN: LAYOUT/HEADERS/HEADER-1 -->
        <!-- BEGIN: HEADER -->
        <header class="c-layout-header c-layout-header-4 c-bordered c-layout-header-default-mobile" data-minimize-offset="80">
            <div class="c-navbar">
                    <!-- BEGIN: BRAND -->
                <div class="c-navbar-wrapper clearfix">
                    <div class="c-brand c-pull-left">
                        <a href="{{url('/')}}" class="c-logo">
                            @if (!empty($affiliate_logo))
                            <img src="{{ $affiliate_logo }}" alt="Pintaria" class="c-desktop-logo" style="height: 90px;width:auto;">  
                            <img src="{{ $affiliate_logo }}" alt="Pintaria" class="c-mobile-logo"  style="height: 60px;width:auto;">
                            <img src="{{ $affiliate_logo }}" alt="Pintaria" class="c-desktop-logo-inverse"   style="height: 60px;width:auto;">
                            @else
                            <img src="{{ asset_cdn('Logo-Pintaria.png') }}" alt="Pintaria" class="c-desktop-logo">
                            <img src="{{ asset_cdn('Logo-Pintaria.png') }}" alt="Pintaria" class="c-desktop-logo-inverse">
                            <img src="{{ asset_cdn('Logo-Pintaria.png') }}" alt="Pintaria" class="c-mobile-logo">
                            @endif
                        </a>
                        <button class="c-hor-nav-toggler" type="button" data-target=".c-mega-menu">
                            <span class="c-line"></span>
                            <span class="c-line"></span>
                            <span class="c-line"></span>
                        </button>
                    </div>
                    <!-- END: BRAND -->
                    {!! Form::open(['url' => route('home.global.search'),'method' => 'get']) !!}
                    <global-search {!! !empty($search_placeholder) ? 'search-placeholder=\'' . strip_tags($search_placeholder->description) . '\'' : '' !!}></global-search>
                    {!! Form::close() !!}
                    @include('layouts.pintaria.partials.menu')
                </div>
            </div>
        </header>
        <!-- END: HEADER -->
        <!-- END: LAYOUT/HEADERS/HEADER-1 -->
        <div class="c-layout-page">
            @include('shared.notification')
            @yield('content')
        </div>
        
        @if (!empty($affiliate_name))
        <!-- BEGIN: LAYOUT/FOOTERS/FOOTER-5 -->
        <a name="footer"></a>
        <footer class="c-layout-footer c-layout-footer-3 c-bg-grey">
            <div class="c-prefooter links-affiliate">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="c-container c-first">
                                <div class="col-md-3">
                                    <center><a href="{{url('tentang-kami')}}">Tentang Kami</a></center>
                                </div>
                                <div class="col-md-3">
                                    <center><a href="{{url('hubungi-kami')}}">Hubungi Kami</a></center>
                                </div>
                                <div class="col-md-3">
                                    <center> <a href="{{url('perjanjian-pengguna')}}">Perjanjian Pengguna</a></center>
                                </div>
                                <div class="col-md-3">
                                    <center><a href="{{url('kebijakan-privasi')}}">Kebijakan Privasi</a></center>
                                </div>
                            </div>
                        </div>
                    </div>      
                </div>
            </div>
            <div class="c-postfooter">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 c-col">
                            <p class="c-copyright c-font-black">{{date('Y')}} &copy; {{strtoupper($affiliate_name)}}. Powered by Pintaria
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- END: LAYOUT/FOOTERS/FOOTER-5 -->
        @else
        <!-- BEGIN: LAYOUT/FOOTERS/FOOTER-5 -->
        <a name="footer"></a>
        <footer class="c-layout-footer c-layout-footer-3 c-bg-grey">
            <div class="c-prefooter">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="c-container c-first">
                                <div class="c-content-title-1">
                                    <h3 class="c-font-uppercase c-font-bold text-grey">PINTARIA</h3>
                                    <div class="c-line-left hide"></div>
                                </div>
                                <ul class="c-links">
                                    <li><a href="{{url('blog')}}">Blog</a></li>
                                    <li><a href="{{url('tentang-kami')}}">Tentang Kami</a></li>
                                    <li><a href="{{url('hubungi-kami')}}">Hubungi Kami</a></li>
                                    <li><a href="{{url('perjanjian-pengguna')}}">Perjanjian Pengguna</a></li>
                                    <li><a href="{{url('kebijakan-privasi')}}">Kebijakan Privasi</a></li>
                                    <li><a href="https://harukaedu.com/pengajar" target="_blank">Ayo Mengajar</a></li>
                                </ul>
                            </div>
                        </div>
                        
                        @include('shared.blog')

                        <div class="col-md-3">
                            <div class="c-container c-last">
                                <div class="c-content-title-1">
                                    <h3 class="c-font-uppercase c-font-bold text-grey">TERHUBUNG</h3>
                                    <div class="c-line-left hide"></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2 col-sm-1 col-xs-2"><a target="_blank" href="https://www.facebook.com/Pintaria-1279978625403492/"><i class="fa fa-facebook-official fa-2x" aria-hidden="true"></i></a></div>
                                    <div class="col-md-2 col-sm-1 col-xs-2"><a target="_blank" href="https://twitter.com/pintariaid"><i class="fa fa-twitter fa-2x" aria-hidden="true"></i></a></div>
                                    <div class="col-md-2 col-sm-1 col-xs-2"><a target="_blank" href="https://www.youtube.com/channel/UC0xS7uOPfE3uwTtYhYN3tYg"><i class="fa fa-youtube fa-2x" aria-hidden="true"></i></a></div>
                                    <div class="col-md-2 col-sm-1 col-xs-2"><a target="_blank" href="https://plus.google.com/u/3/105831708780258410777"><i class="fa fa-google-plus fa-2x" aria-hidden="true"></i></a></div>
                                    <div class="col-md-2 col-sm-1 col-xs-2"><a target="_blank" href="https://www.instagram.com/pintariaid/"><i class="fa fa-instagram fa-2x" aria-hidden="true"></i></a></div>
                                </div>
                            </div>
                            <br clear="both">
                            <div class="c-container c-last">
                                <div class="c-content-title-1">
                                    <h3 class="c-font-uppercase c-font-bold text-grey">PEMBAYARAN</h3>
                                    <div class="c-line-left hide"></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                    <img src="{{url('pintaria/img/shared/visa1.png')}}" class="img-responsive payment-icons">
                                    <img src="{{url('pintaria/img/shared/mastercard1.png')}}" class="img-responsive payment-icons">
                                    <img src="{{url('pintaria/img/shared/mandiri1.png')}}" class="img-responsive payment-icons">
                                    <img src="{{url('pintaria/img/shared/permata1.png')}}" class="img-responsive payment-icons">
                                    <img src="{{url('pintaria/img/shared/ATMBersama1.png')}}" class="img-responsive payment-icons">
                                    <img src="{{url('pintaria/img/shared/mandiriclickpay1.png')}}" class="img-responsive payment-icons">
                                    <img src="{{url('pintaria/img/shared/CIMBclicks1.png')}}" class="img-responsive payment-icons">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>      
                </div>
            </div>
            <div class="c-postfooter">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 col-sm-12 c-col">
                            <p class="c-copyright c-font-black">{{date('Y')}} &copy; Pintaria. Powered by HarukaEDU
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- END: LAYOUT/FOOTERS/FOOTER-5 -->

        @endif

        @include('layouts.pintaria.partials.modal')

        <!-- BEGIN: LAYOUT/FOOTERS/GO2TOP -->
        <div class="c-layout-go2top">
            <i class="icon-arrow-up"></i>
        </div>
        <!-- END: LAYOUT/FOOTERS/GO2TOP -->
    </div>
    <!--[if lt IE 9]>
    <script src="{{url('global/pintaria/plugins/excanvas.min.js')}}"></script> 
    <![endif]-->
    <script src="{{ mix('js/vendor.min.js') }}" type="text/javascript"></script>
    <script>
    $(document).ready(function() {
        App.init(); // init core
    });
    </script>
    <script src="{{ mix('js/scripts.min.js') }}" type="text/javascript"></script>
    @include('shared.sentry-js')
    <script type="text/javascript">
        var sayaBerminatURL = "{{ route('submit.saya.berminat') }}";
        var newsletterURL = "{{ route('newsletter.store') }}";
        var mohonInfoURL = "{{ route('mohon.info.thankyou') }}";
        var baseUrl = "{{ url('') }}";
        var is_login = "{{ (\Auth::check()) ? true : false }}";
        var login_url = "{{ route('masuk') }}";
        var formToken = "{{ csrf_token() }}";
    </script>
    <script src="{{ mix('js/custom.min.js') }}" type="text/javascript"></script>
    <script src="{{ mix('js/app.js') }}" type="text/javascript"></script>

    @yield('additional.scripts')
</body>
</html>