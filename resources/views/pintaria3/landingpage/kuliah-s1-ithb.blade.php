@extends('layouts.pintaria3.tryout.master')

@section('title')
    Pintaria: Kuliah S1 Sambil Kerja
@endsection

@section('meta_description')
    Daftar kuliah sambil kerja dengan kelas karyawan campuran offline & online. Kelas fleksibel, biaya bisa dicicil. Cari tahu info selengkapnya!
@endsection

@section('additional.metas')
<meta property="og:title" content="Pintaria: Kuliah S1 Sambil Kerja">
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
            font-family: 'Helvetica'!important;
            background: #fff;
        }

        .dark-grey-bg {
            background-color: #2c3450;
        }

        .logo img {
            height: auto!important;
        }

        .top-logo {
            margin: 0 auto 20px auto;
            background-color: #ffffff;
            position: relative;
        }

        .top-logo .uni-logo {
            margin-left: 0;
            display: inherit;
        }
        .top-banner {
            /* The image used */
            background: url("{{asset_cdn('pintaria/landing-pages/s1-ithb-header.jpg')}}") center center no-repeat;

            /* Set a specific height */
            height: 740px;

            /* Create the parallax scrolling effect */
            background-attachment: fixed;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            position: relative;
        }

        .top-banner .logo{
            margin-bottom: 15px !important;
        }

        .title-banner-text {
            margin: auto;
            font-weight: bold !important;
            font-size: 32px;
        }

        .form-group.no-bottom {
            margin-bottom: 0 !important;
        }

        .form-group input,
        .form-group select {
            border: 1px solid #a8a8a8 !important;
            border-radius: 2px;
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

        .btn-red {
            text-transform: capitalize;
        }

        .info-form{
            background: rgb(255,255,255);
            top: unset;
            right: unset;
            height: unset;
        }

        .info-form h2{
            font-size: 18px;
            color: #323233;
            margin-bottom: 0!important;
            text-transform: capitalize;
            font-family: inherit;
            font-weight: unset;
        }

        .box_grid {
            margin: 0 auto 10px;
            box-shadow: -2px 2px 7px gray;
        }

        .box_grid .wrapper {
            height: 140px;
        }

        .box_grid .wrapper h3{
            font-size: 15px;
            color: #707070;
            min-height: unset;
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

        .feature-kuliah {
            padding-top: 30px;
            height: 100%;
        }

        section{
            padding: 20px 0 0 0!important;
        }

        section.form_more_info {
            margin-top: -560px;
        }

        section.main_description {
            padding-top: 65px !important;
        }

        footer{
            padding: 10px!important;
        }

        footer.black-bg{
            background: rgba(42,42,43,1);
        }

        .btn-red{
            -webkit-border-radius: 2px;
            -moz-border-radius: 2px;
            border-radius: 2px;
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

        .blended-desc {
            font-size: 15px;
        }

        @media(min-width: 769px) {
            .panel-error{
                width: 23%;
                top: 377px;
                position: absolute;
                display: block;
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
            section.form_more_info {
                margin-top: auto;
            }

            section.main_description {
                margin-top: auto !important;
                padding-top: 30px !important;
            }

            .top-logo .uni-logo {
                margin: 0 auto;
                width: 120px;
            }

            .top-banner{
                background: url("{{asset_cdn('pintaria/landing-pages/s1-ithb-header-m.jpg')}}") center center no-repeat;
                height: 600px;
                min-height: 0;
                background-size: cover;
            }

            .top-banner .header-text {
                margin-top: 370px;
            }
            
            h1.logo img{
                display: block;
                margin: -10px auto 15px auto;
            }

            h2.title-banner-text {
                font-size: 20px !important;
                font-family: 'Raleway';
                text-align: center;
                margin: 23px 0 0 30px !important;
            }

            img.lulus-kuliah {
                display: block;
                width: 100%;
                margin: 15px 0;
            }

            p.white-text-mobile{
                font-size: 14px;
                margin: 0 30px 20px 0;
                line-height: 20px;
            }

            .info-form {
                padding: 0;
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
                align-items: center;
                padding-top: 20px;
            }

            .feature-kuliah .desc {
                display: block;
                max-width: 275px;
                margin-left: 10px;
                text-align: left !important;
                margin-top: 8px;
            }

            .feature-kuliah .desc p {
                font-size: 15px;
            }

            .feature-kuliah .desc h3 {
                font-size: 15px !important;
                margin-top: 7px !important;
                margin-bottom: 5px !important;
            }

            .blended-desc {
                font-size: 14px;
            }
        }

        @media(max-width: 340px) {
            .feature-kuliah .desc p {
                font-size: 14px;
            }
            p.white-text-mobile {
                font-size: 12px;
            }
        }

        @media(min-width: 1023px) {
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
    <section class="top-logo" style="padding: 0">
        <div class="container w-960 d-block">
            <img class="img-fluid uni-logo" src="{{ asset_cdn('pintaria/landing-pages/ITHB-logo.png') }}">
        </div>
    </section>
    <section class="top-banner s1" style="padding: 0">
        <div class="container w-960 header-text">
            <h2 class="white-text font24 text-left font-bold m-auto">
                Kuliah dengan Jadwal Fleksibel!
            </h2>
            <h3 class="sub-banner-text white-text font16 text-left font-bold mt-2">
                Sekarang kamu bisa kuliah tanpa harus ke kampus setiap hari!
            </h3>
            <p class="white-text font14 white-text-mobile mt-3">
                <span class="new-line">
                    Dengan metode <span class="font-italic">blended learning</span> kamu bisa atur sendiri waktu kuliahmu.
                    <br />
                    Yuk kuliah di kampus terakreditasi dan dapatkan <span class="font-bold">harga promo spesial</span> sekarang juga!
                </span>
            </p>
        </div>
    </section>
    <section class="form_more_info" style="padding: 0">
        <div class="container w-960">
            <div class="info-form pb-4" id="mohon-info" style="position: relative">
                <h2 class="text-center">Hubungi kami<br/>untuk informasi lengkap</h2>
                <form action="{{ route('submit.hubungi.kami.kuliah.s1.pintaria') }}" method="post" class="landing_form">
                    {{ csrf_field() }}

                    @if (!empty($get['utm_source']))
                        <input type="hidden" name="source" value="{{ $get['utm_source'] }}">
                    @endif

                    <div class="form-group no-bottom">
                        <input id="name" name="name" type="text" placeholder="Nama*" value="{{ old('name') }}"/>
                        <span class="text-danger error error-name"></span>
                    </div>
                    <div class="form-group no-bottom">
                        <input type="text" id="email" name="email" placeholder="Email*" value="{{ old('email') }}">
                        <span class="text-danger error error-email"></span>
                    </div>
                    <div class="form-group no-bottom">
                        <input type="text" id="phone" name="phone" placeholder="Nomor HP*" value="{{ old('phone') }}">
                        <span class="text-danger error error-phone"></span>
                    </div>
                    <div class="form-group no-bottom">
                        <select id="location" name="location">
                            <option value="" selected data-default>Lokasi Tinggal Anda*</option>
                            @foreach($locations as $location)
                                <option value="{{ $location }}">{{ $location }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger error error-location"></span>
                    </div>
                    <div class="form-group no-bottom">
                        <select id="departement" name="departement">
                            <option value="" selected data-default>Jurusan yang Diminati*</option>
                            @foreach($departements as $departement)
                                <option value="{{ $departement }}">{{ $departement }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger error error-departement"></span>
                    </div>
                    <div class="form-group no-bottom">
                        <select id="education" name="education">
                            <option value="" selected data-default>Ijazah Terakhir*</option>
                            @foreach($levelOfEducations as $key => $education)
                                <option value="{{ $key }}">{{ $education }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger error error-education"></span>
                    </div>
                    <input type="submit" id="submit_form" value="mohon info" class="capitalize btn-red full-width mt-3"/>
                </form>
            </div>
        </div>
    </section>
    <section class="main_description orange-bg pb-5">
        <div class="container w-960">
            <h2 class="center font24 capitalize mb-4 white-text helvetica-bold">kuliah metode <i>blended learning</i></h2>
            <p class="blended-desc center w70-percent white-text m-auto">
                Kuliah dengan metode <span class="font-italic">blended learning</span> adalah kuliah dengan menggabungkan kelas <span class="font-italic">online</span> dan kelas <span class="font-italic">offline</span>
                (tatap muka). Kamu bisa jadi sarjana di sela-sela kesibukanmu!
            </p>
            <div class="row mt-5 light-dark-color">
                <div class="col-md-4 center mt-2 mb-2">
                    <div class="feature-kuliah">
                        <img class="img-fluid" src="{{asset_cdn('pintaria/landing-pages/Pintaria-icon-kampus-terakreditasi.png')}}">
                        <div class="desc">
                            <h3 class="uppercase mb-3 font16 helvetica-bold">KAMPUS BERKUALITAS</h3>
                            <p>
                                Jurusan yang terakreditasi <span class="font-bold">B</span> oleh BAN-PT.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 center mt-2 mb-2">
                    <div class="feature-kuliah">
                        <img class="img-fluid" src="{{asset_cdn('pintaria/landing-pages/Pintaria-icon-terjangkau.png')}}">
                        <div class="desc">
                            <h3 class="uppercase mb-3 font16 helvetica-bold">BIAYA TERJANGKAU</h3>
                            <p>
                                Hemat hingga 50% dibanding biaya kuliah reguler serta dapat dicicil setiap bulan.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 center mt-2 mb-2">
                    <div class="feature-kuliah">
                        <img class="img-fluid" src="{{asset_cdn('pintaria/landing-pages/Pintaria-icon-fleksibel.png')}}">
                        <div class="desc">
                            <h3 class="uppercase mb-3 font16 helvetica-bold">JADWAL FLEKSIBEL</h3>
                            <p>
                                Belajar secara <span class="font-italic">online</span> di mana saja dan kapan saja.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="pt-5 pb-5 white-bg">
        <div class="container w-960">
            <h2 class="font20 mb-4 center light-dark-color font-bold">Testimoni dari mahasiswa</h2>
            <p class="center light-dark-color m-auto pb-4">
                Para mahasiswa di kampus mitra Pintaria mendapatkan pengalaman yang sangat bermanfaat 
                untuk mengembangkan keahlian dalam bidang-bidang yang mereka tekuni.
            </p>
            <div class="row s1-testimony pt-5">
                <div class="col-md-6">
                    <div class="item">
                        <figure class="pic">
                            <img class="img-fluid" src="{{ asset_cdn('pintaria/landing-pages/t_Andreas.png') }}">
                        </figure>
                        <div class="content font12">
                            <p class="mb-2">
                                Sambil aktif bekerja di sebuah perusahaan tekstil, saya bisa mengatur jadwal kuliah
                                di ITHB dengan fleksibel. Menambah skill kini tak lagi terhambat masalah waktu.
                            </p>
                            <p class="mb-0">
                                <span class="font-bold">Andreas</span><br>
                                Mahasiswa ITHB <span class="font-italic">Blended Learning</span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="item">
                        <figure class="pic">
                            <img class="img-fluid" src="{{ asset_cdn('pintaria/landing-pages/t_Maya.png') }}">
                        </figure>
                        <div class="content font12">
                            <p class="mb-2">
                                Kuliah dengan metode Blended Learning waktunya sangat fleksibel,
                                jadi tidak menyita waktu saya.
                            </p>
                            <p class="mb-0">
                                <span class="font-bold">Mayaromianti</span><br>
                                Mahasiswi ITHB <span class="font-italic">Blended Learning</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="pt-5 pb-5 gray-bg">
        <div class="container w-960">
            <h2 class="font24 capitalize mb-4 center light-dark-color font-bold">Program Berkualitas</h2>
            <div class="row pt-1" style="justify-content: center">
                <div class="col-md-5 center item">
                    <div class="box_grid">
                        <figure class="no-clip">
                            <img src="{{asset_cdn('pintaria/landing-pages/Data-Science-ITHB.jpg')}}">
                        </figure>
                        <div class="wrapper no-clip">
                            <h3 class="font-bold">S1 Sistem Informasi Institut Teknologi Harapan Bangsa (ITHB)</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 center item">
                    <div class="box_grid">
                        <figure class="no-clip">
                            <img src="{{asset_cdn('pintaria/landing-pages/Manajemen-ITHB.jpg')}}">
                        </figure>
                        <div class="wrapper no-clip">
                            <h3 class="font-bold">S1 Manajemen Institut Teknologi Harapan Bangsa (ITHB)</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="dark-grey-bg center pt-5">
        <p class="center font22 white-text w70-percent m-auto">
            Daftar sekarang & dapatkan <span class="font-bold">harga promo spesial!</span>
        </p>
        <p class="center font16 white-text w70-percent m-auto pt-2">
            Hubungi kami sekarang!
        </p>
        <a href="javascript:scrollToElementWithDistance('#mohon-info', 0);" class="btn-red white-text w-auto mt-2 mb-2">mohon info</a>
        <p class="center font12 yellow-text w70-percent m-auto pb-4">Kuliah dimulai awal tahun 2019</p>
    </section>

    <footer class="black-bg center">
        <img class="img-fluid logo" width="90" src="{{ asset_cdn('pintaria/Logo-Pintaria.png') }}">
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
