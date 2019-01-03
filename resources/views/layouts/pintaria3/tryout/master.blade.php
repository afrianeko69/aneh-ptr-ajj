<!DOCTYPE HTML>
<html>
<head>
    @include('shared.gtm-js')
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no" />
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <meta name="author" content="Pintaria" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="description" content="@yield('meta_description')">
    @yield('additional.metas')
    <title>@yield('title')</title>

    @if (!empty($affiliate_favicon))
        <link rel="icon" type="image/png" href="{{url($affiliate_favicon)}}" />
    @else
        <link rel="icon" type="image/png" href="{{ asset_cdn('pintaria/favicon.png') }}" />
    @endif

    <link href="https://fonts.googleapis.com/css?family=Leckerli+One" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
    <link href='//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" type="text/css" href="{{ mix('css/vendor-v3.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ mix('css/custom-v3.min.css') }}">
    <link href="{{ asset('pintaria3/css/custom-tryout.css')}}" rel="stylesheet">
    @stack('additional.style')
</head>
<body>
    @include('shared.gtm-no-js')
    @yield('content')
    @include('layouts.pintaria3.partials.modal')
    @include('layouts.pintaria3.partials.javascript')
    <script src="{{ asset('pintaria3/js/jquery-2.2.4.min.js')}}"></script>
    <script src="pintaria3/js/sweetalert.min.js"></script>
    <script src="{{ mix('js/common-v3.min.js') }}"></script>
    <script src="{{ mix('js/custom-v3.min.js') }}"></script>
    @stack('additional.script')
</body>
</html>
