@extends('layouts.pintaria3.tryout.master')

@section('title')
    Pintaria: Kuliah S1 S2 Sambil Kerja
@endsection

@section('meta_description')
    Daftar kuliah sambil kerja dengan kelas karyawan campuran offline & online. Kelas fleksibel, biaya bisa dicicil. Cari tahu info selengkapnya!
@endsection

@section('additional.metas')
<meta property="og:title" content="Pintaria: Kuliah S1 S2 Sambil Kerja">
<meta property="og:site_name" content="Pintaria">
<meta property="og:description" content="Kuliah sambil kerja? Kenapa nggak! Yuk daftar kuliah sambil kerja di Pintaria sekarang juga. Gunakan kode referral {{ isset($get['code']) ? $get['code'] : '' }} untuk mendapatkan kesempatan memenangkan hadiah voucher belanja senilai 1 JUTA Rupiah! Gunakan di sini">
<meta property="og:url" content="{{ route('landing.kuliah') }}">
<meta property="og:image" content="{{asset_cdn('pintaria/landing-pages/Thumb-Referral.jpg')}}">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="Pintaria - Ajak Temanmu">
<meta name="twitter:description" content="Saya membagikan kode referral {{ isset($get['code']) ? $get['code'] : '' }} untuk kalian yang ingin mendaftar kuliah kelas karyawan di Pintaria. Gunakan di sini:">
<meta name="twitter:image:src" content="{{asset_cdn('pintaria/landing-pages/Thumb-Referral.jpg')}}">
<meta itemprop="image" content="{{asset_cdn('pintaria/landing-pages/Thumb-Referral.jpg')}}">
<meta itemprop="name" content="Pintaria - Ajak Temanmu">
<meta itemprop="description" content="Kuliah sambil kerja? Kenapa nggak! Yuk daftar kuliah sambil kerja di Pintaria sekarang juga. Gunakan kode referral {{ isset($get['code']) ? $get['code'] : '' }} untuk mendapatkan kesempatan memenangkan hadiah voucher belanja senilai 1 JUTA Rupiah! Gunakan di sini">
@endsection

@push('additional.style')
    <style type="text/css">
        body{
            font-family: 'Raleway'!important;
        }

        .dark-grey-bg {
            background: rgba(50,50,51,1);
        }

        .logo img {
            height: auto!important;
        }

        .top-banner {
            /* The image used */
            background: url("{{asset_cdn('pintaria/landing-pages/Pintaria-Header-LP-lulus-kuliah.jpg')}}") center center no-repeat;

            /* Set a specific height */
            min-height: 1072px;

            /* Create the parallax scrolling effect */
            background-attachment: fixed;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }

        .top-banner .logo{
            margin: 0!important;
        }

        .title-banner-text {
            margin: 23px 0 0 0 !important;
            font-weight: bold !important;
            font-size: 32px;
        }

        .form-group.no-bottom {
            margin-bottom: 0 !important;
        }

        .form-group.no-bottom input,
        .form-group.no-bottom select,
        .form-group.no-bottom .g-recaptcha {
            margin: 5px 0 !important;
        }

        .form-group.no-bottom label {
            margin: 0 !important;
            font-size: 14px;
            line-height: 15px;
            color: #323233;
            font-weight: bold;
        }

        .form-group.no-bottom select option[data-default] {
            color: #888;
        }

        .landing_form .form-group {
            margin: 10px 0;
        }

        .info-form{
            background: rgba(170,170,170,0.75);
            top: unset;
            right: unset;
        }

        .info-form h2{
            font-size: 18px;
            color: #323233;
            margin-bottom: 0!important;
        }

        .box_grid {
            margin: 0 -10px 10px;
        }

        .box_grid .wrapper {
            height: 70px;
        }

        .box_grid .wrapper h3{
            font-size: 15px;
            margin: -15px -20px;
        }

        .box_grid figure {
            height: auto!important;
        }

        .box_grid figure.no-clip {
            /*padding: 0 8px!important;*/
        }

        .box_grid figure.no-clip img {
            width: 100%!important;
        }

        section{
            padding: 20px 0 0 0!important;
        }

        footer{
            padding: 10px!important;
        }

        footer.black-bg{
            background: rgba(42,42,43,1);
        }

        .btn-red{
            -webkit-border-radius: 0;
            -moz-border-radius: 0;
            border-radius: 0;
            color: #fff;
            font-weight: bold;
            padding-left: 75px;
            padding-right: 75px;
        }

        .btn-red:hover{
            background: #9832a1;
        }

        .panel-error{
            background: #DF3935;
            font-size: 12px;
            z-index: 1;
        }

        .panel-error a{
            color: #fff;
        }

        .panel-error ul{
            padding: 5px 14px;
            list-style-type: disc;
        }

        .header-error{
            padding: 5px 18px;
            font-weight: bold;
            color: #fff;
            width: 100%;
        }

        .body-error{
            height: auto;
            background: #FFD0D0;
            color: #DF3935;
            padding: 5px 20px;
            width: 100%;
        }

        .arrow-down,
        .arrow-right{
            float: right;
        }

        .header-error.collapsed .arrow-down,
        .panel-error .arrow-right {
            display: none;
        }

        .header-error.collapsed .arrow-right,
        .panel-error .arrow-down {
            display: inline-block;
        }

        .feature-kuliah .desc-mobile {
            display: none;
        }

        @media(min-width: 769px) {
            .panel-error{
                width: 23%;
                top: 377px;
                position: absolute;
                display: block;
            }
        }

        @media(min-width: 768px) {
            .top-banner{
                min-height: 1430px;
            }
        }

        @media(min-width: 1024px) {
            .panel-error{
                left: 387px;
            }
        }

        @media(min-width: 1025px) {
            .panel-error{
                left: 520px;
            }
        }
        img.lulus-kuliah {display: none;}
        @media (max-width: 768px){
            .top-banner{
                background: rgba(15,133,219,1);
                min-height: 1250px;
            }
            
            h1.logo img{
                display: block;
                width: 50%;
                margin: 0 auto;
            }

            h2.title-banner-text {
                font-size: 20px !important;
                font-family: 'Raleway';
                text-align: center;
            }

            img.lulus-kuliah {
                display: block;
                width: 100%;
                margin: 15px 0;
            }

            p.white-text-mobile{
                font-size: 18px;
                margin: 0 30px 20px 30px;
            }

            .info-form {
                height: 758px;
            }

            .panel-error{
                width: 100%;
                z-index: 1;
                position: fixed;
                left: 0;
            }

            .feature-kuliah {
                display: inline-flex;
                justify-content: center;
            }

            .feature-kuliah .desc-mobile {
                display: block;
                max-width: 275px;
                margin-left: 10px;
                text-align: left !important;
            }

            .feature-kuliah .desc {
                display: none;
            }

            .feature-kuliah .desc p {
                font-size: 16px;
            }

            .feature-kuliah .desc-mobile h3 {
                font-size: 16px !important;
                margin-top: 7px !important;
                margin-bottom: 5px !important;
            }

            .feature-kuliah .desc-mobile p {
                font-size: 16px;
            }
        }

        @media(max-width: 340px) {
            .feature-kuliah .desc-mobile p {
                font-size: 14px;
            }
        }

        @media(max-width: 320px) {
            .top-banner {
                min-height: 1280px;
            }
        }

        @media(min-width: 321px) {
            .top-banner {
                min-height: 1258px;
            }
        }

        @media(min-width: 375px) {
            .top-banner {
                min-height: 1265px;
            }
        }

        @media(min-width: 411px) {
            .top-banner {
                min-height: 1290px;
            }
        }

        @media(min-width: 767px) {
            .top-banner {
                min-height: 1430px;
            }
        }

        @media(min-width: 1023px) {
            .top-banner {
                min-height: 1090px;
            }
            p span.new-line
            {
                display: block;
            }
        }
    </style>
@endpush

@section('content')
    @if ($errors->any())
        <div class="panel-error">
            <div class="header-error" data-toggle="collapse" data-target="#demo">
                Please fix the following {{ $errors->count() }} errors: <span class="arrow-down">Hide<i class="fa fa-fw fa-caret-down"></i></span>
                <span class="arrow-right">Show<i class="fa fa-fw fa-caret-right"></i></span>
            </div>
            <div class="panel-body">
                <div id="demo" class="body-error collapse show">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif
    <section class="top-banner" style="padding: 0">
        <div class="container w-960">
            <h1 class="logo">
                    <a href="/"><img src="{{ asset_cdn('pintaria/landing-pages/Pintaria-logo-white.png') }}"
                                              alt="Pintaria"
                                              width="218px" data-retina="true" height="74px" class="blue_logo"></a>
            </h1>
            <h2 class="title-banner-text white-text font32">Dapatkan Gelar S1 & S2 <br/> Sambil Bekerja</h2>
            <img src="{{ asset_cdn('pintaria/landing-pages/Pintaria-Header-LP-lulus-kuliah.jpg') }}"                                              alt="Pintaria"
                                              data-retina="true" class="lulus-kuliah">
            <p class="white-text font18 white-text-mobile mt-2"><span class="new-line">Mau kuliah sambil kerja? Coba kuliah metode <span class="font-italic">blended learning</span>.</span><span class="new-line">
                Kamu bisa kuliah di kampus favorit dengan jadwal fleksibel</span>
                dan biaya terjangkau (mulai dari <span class="font-bold">Rp700 ribu/bulan</span>). </p>
            <div class="info-form" id="mohon-info" style="position: relative">
                <h2>Hubungi kami<br/>untuk informasi lengkap</h2>
                <form action="{{ route('submit.hubungi.kami.kuliah.pintaria') }}" method="post" class="landing_form">
                    {{ csrf_field() }}

                    @if (!empty($get['utm_source']))
                        <input type="hidden" name="source" value="{{ $get['utm_source'] }}">
                    @endif

                    <div class="form-group no-bottom">
                        <label for="name">Nama *</label>
                        <input id="name" name="name" type="text" placeholder="Nama" value="{{ old('name') }}"/>
                        <span class="text-danger error error-name">
                    </span>
                    </div>
                    <div class="form-group no-bottom">
                        <label for="email">Email *</label>
                        <input type="text" id="email" name="email" placeholder="Email" value="{{ old('email') }}">
                        <span class="text-danger error error-email">
                    </span>
                    </div>
                    <div class="form-group no-bottom">
                        <label for="phone">No HP *</label>
                        <input type="text" id="phone" name="phone" placeholder="Handphone" value="{{ old('phone') }}">
                        <span class="text-danger error error-phone">
                    </span>
                    </div>
                    <div class="form-group no-bottom">
                        <label for="location">Lokasi Tinggal Anda *</label>
                        <select id="location" name="location">
                            <option value="" selected data-default>Lokasi</option>
                            @foreach($locations as $location)
                                <option value="{{ $location }}">{{ $location }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger error error-location">
                    </span>
                    </div>
                    <div class="form-group no-bottom">
                        <label for="departement">Jurusan Yang Anda Minati *</label>
                        <select id="departement" name="departement">
                            <option value="" selected data-default>Jurusan Yang Anda minati</option>
                            @foreach($departements as $departement)
                                <option value="{{ $departement }}">{{ $departement }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger error error-departement">
                    </span>
                    </div>
                    <div class="form-group no-bottom">
                        <label for="education">Ijazah Terakhir *</label>
                        <select id="education" name="education">
                            <option value="" selected data-default>Ijazah Terakhir</option>
                            @foreach($levelOfEducations as $key => $education)
                                <option value="{{ $key }}">{{ $education }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger error error-education">
                    </span>
                    </div>
                    <div class="form-group no-bottom">
                        <label for="referral_code">Kode Promo/Referral</label>
                        <input type="text" id="referral_code" name="referral_code"
                               placeholder="Kode Promo/Referral (Opsional)" value="{{ isset($get['code']) ? $get['code'] : old('referral_code') }}">
                        <span class="text-danger error error-referral_code">
                    </span>
                    </div>
                    <input type="submit" id="submit_form" value="mohon info" class="btn-red full-width mt-3"/>
                </form>
            </div>
        </div>
    </section>
    <section class="white-bg mt-2">
        <div class="container w-960">
            <h2 class="center font24 uppercase mb-4 helvetica-bold">kuliah metode <i>blended learning</i></h2>
            <p class="font16 center w70-percent m-auto">
                Kuliah dengan metode <span class="font-italic">blended learning</span> adalah kuliah dengan menggabungkan kelas <span class="font-italic">online</span> dan kelas <span class="font-italic">offline</span>
                (tatap muka). Kamu bisa jadi sarjana di sela-sela kesibukanmu!
            </p>
            <div class="row mt-5">
                <div class="col-md-4 center feature-kuliah">
                    <img class="img-fluid" src="{{asset_cdn('pintaria/landing-pages/Pintaria-icon-kampus-terakreditasi.png')}}">
                    <div class="desc">
                        <h3 class="uppercase mb-3 font18 helvetica-bold">KAMPUS BERKUALITAS</h3>
                        <p>
                            Beragam pilihan kampus favorit dan jurusan yang terakreditasi <span class="font-bold">A</span> dan <span class="font-bold">B</span> oleh BAN-PT.
                        </p>
                    </div>
                    <div class="desc-mobile">
                        <h3 class="uppercase mb-3 font18 helvetica-bold">KAMPUS BERKUALITAS</h3>
                        <p>
                            Jurusan yang terakreditasi <span class="font-bold">A</span> dan <span class="font-bold">B</span> oleh BAN-PT.
                        </p>
                    </div>
                </div>
                <div class="col-md-4 center feature-kuliah">
                    <img class="img-fluid" src="{{asset_cdn('pintaria/landing-pages/Pintaria-icon-terjangkau.png')}}">
                    <div class="desc">
                        <h3 class="uppercase mb-3 font18 helvetica-bold">BIAYA TERJANGKAU</h3>
                        <p>
                            Biaya kuliah yang terjangkau dan dapat dicicil setiap bulan (mulai dari <span class="font-bold">Rp700 ribu/bulan</span>).
                        </p>
                    </div>
                    <div class="desc-mobile">
                        <h3 class="uppercase mb-3 font18 helvetica-bold">BIAYA TERJANGKAU</h3>
                        <p>
                            Biaya kuliah dapat dicicil mulai dari <span class="font-bold">Rp700 ribu/bulan</span>.
                        </p>
                    </div>
                </div>
                <div class="col-md-4 center feature-kuliah">
                    <img class="img-fluid" src="{{asset_cdn('pintaria/landing-pages/Pintaria-icon-fleksibel.png')}}">
                    <div class="desc">
                        <h3 class="uppercase mb-3 font18 helvetica-bold">JADWAL FLEKSIBEL</h3>
                        <p>
                            Jadwal kuliah yang lebih fleksibel. Belajar secara <span class="font-italic">online</span> dapat dilakukan di mana saja dan kapan
                            saja.
                        </p>
                    </div>
                    <div class="desc-mobile">
                        <h3 class="uppercase mb-3 font18 helvetica-bold">JADWAL FLEKSIBEL</h3>
                        <p>
                            Belajar secara <span class="font-italic">online</span> di mana saja dan kapan saja.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container w-960">
            <h2 class="font24 uppercase mb-4 center font-bold">perguruan tinggi berkualitas</h2>
            <div class="row" style="justify-content: center">
                <div class="col-md-2 center item">
                    <div class="box_grid">
                        <figure class="no-clip">
                            <img src="{{asset_cdn('pintaria/landing-pages/Pintaria-labora.jpg')}}">
                        </figure>
                        <div class="wrapper no-clip">
                            <h3 class="font-bold">Sekolah Tinggi Manajemen (STM) Labora</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 center item">
                    <div class="box_grid">
                        <figure class="no-clip">
                            <img src="{{asset_cdn('pintaria/landing-pages/Pintaria-uai-2.jpg')}}">
                        </figure>
                        <div class="wrapper no-clip">
                            <h3 class="font-bold font16">Universitas Al-Azhar Indonesia (UAI)</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 center item">
                    <div class="box_grid">
                        <figure class="no-clip">
                            <img src="{{asset_cdn('pintaria/landing-pages/Pintaria-unkris.jpg')}}">
                        </figure>
                        <div class="wrapper no-clip">
                            <h3 class="font-bold font16">Universitas Krisnadwipayana (UNKRIS)</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 center item">
                    <div class="box_grid">
                        <figure class="no-clip">
                            <img src="{{asset_cdn('pintaria/landing-pages/Pintaria-UKRIDA.jpg')}}">
                        </figure>
                        <div class="wrapper no-clip">
                            <h3 class="font-bold">Universitas Kristen Krida Wacana (UKRIDA)</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" style="justify-content: center">
                <div class="col-md-2 offset-md-1 center item">
                    <div class="box_grid">
                        <figure class="no-clip">
                            <img src="{{asset_cdn('pintaria/landing-pages/Pintaria-umht.jpg')}}">
                        </figure>
                        <div class="wrapper no-clip">
                            <h3 class="font-bold">Universitas MH Thamrin (UMHT)</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 offset-md-1 center item">
                    <div class="box_grid">
                        <figure class="no-clip">
                            <img src="{{asset_cdn('pintaria/landing-pages/UMJ-pintaria.jpg')}}">
                        </figure>
                        <div class="wrapper no-clip">
                            <h3 class="font-bold">Universitas Muhammadiyah Jakarta (UMJ)</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 center item">
                    <div class="box_grid">
                        <figure class="no-clip">
                            <img src="{{asset_cdn('pintaria/landing-pages/Pintaria-usahid.jpg')}}">
                        </figure>
                        <div class="wrapper no-clip">
                            <h3 class="font-bold font16">Universitas Sahid (USAHID)</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="dark-grey-bg center">
        <p class="center font22 white-text w70-percent m-auto">
            Daftar sekarang! Dapatkan cashback <span class="font-bold">Rp100 RIBU</span>!! 
            <br /> Hubungi kami sekarang!
        </p>
        <a href="javascript:scrollToElementWithDistance('#mohon-info', 0);" class="btn-red white-text w-auto mt-4 mb-4">mohon info</a>
        <p class="center font26 white-text w70-percent m-auto pb-4 font-bold">Kuliah Mulai Agustus & September 2018</p>
    </section>

    <footer class="black-bg">
        <p class="center font16 white-text">&copy; Copyright 2018.<br/>Pintaria &amp; HarukaEDU</p>
    </footer>
@endsection

@push('additional.script')
    <script type="text/javascript">

        var onloadCallback = function() {
            grecaptcha.render('submit_form', {
                'sitekey' : '{{env("RECAPTCHA_CLIENT_KEY")}}',
                'callback' : onSubmit
            });
        };

        var onSubmit = function(token) {
            $('#mohon-info .landing_form').submit();
        };

        function topFunction() {
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
        }
    </script>
@endpush
