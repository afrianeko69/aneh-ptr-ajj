<!DOCTYPE html>
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en"  >
<!--<![endif]-->
<head>
    <meta charset="utf-8"/>
    <title>@if (!empty($affiliate_site_title)){{$affiliate_site_title}} @else @yield('title') @endif</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport"content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <meta name="description" content="@yield('meta_description')" />
    <meta name="author" content="Pintaria" />

    @include('shared.gtm-js')
    <link href='//fonts.googleapis.com/css?family=Roboto+Condensed:300italic,400italic,700italic,400,300,700&amp;subset=all' rel='stylesheet' type='text/css'>
    <link href="{{ mix('css/vendor.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ mix('css/custom.min.css') }}" rel="stylesheet" type="text/css"/>
    @yield('additional.styles')
    
    @if (!empty($affiliate_favicon))
    <link rel="icon" type="image/png" href="{{url($affiliate_favicon)}}" />
    @else
    <link rel="icon" type="image/png" href="{{url('pintaria/favicon.png')}}" />
    @endif
    @include('shared.zopim')
</head>
<body class="c-layout-header-fixed c-layout-header-mobile-fixed"> 
    
    @include('shared.gtm-no-js')

    <div class="c-layout-page">
        @include('shared.notification')
        @yield('content')
    </div>

    @include('layouts.pintaria.partials.modal')

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
        var baseUrl = "{{ url('') }}";
    </script>
    <script src="{{ mix('js/custom.min.js') }}" type="text/javascript"></script>
    @yield('additional.scripts')
</body>
</html>