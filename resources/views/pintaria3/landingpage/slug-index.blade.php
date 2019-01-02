@extends('layouts.pintaria3.tryout.master')

@section('title')
    {{ $lp->title }}
@endsection

@section('meta_description')
    {{ $lp->meta_description }}
@endsection

@push('additional.style')
    <style type="text/css">
        .top-banner {
            background: url("{{ asset_cdn($lp->main_image) }}") center center no-repeat;
            height: 890px;
            background-attachment: fixed;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            position: relative;
        }

        .features-bg {
            background: {{ $lp->feature_bg_color ?: '#1168f2' }};
        }

        @media (max-width: 768px){
            .top-banner{
                height: 600px;
                min-height: 0;
                background-size: cover;
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

    <!-- Header -->
    <section class="lp top-banner s1 pl-0 pb-4 pt-4">
        <div class="container w-960">
            <h1 class="logo pb-1 mb-3">
                <a href="/">
                    <img src="{{ asset_cdn('pintaria/landing-pages/Pintaria-logo-white.png') }}"
                        alt="Pintaria" width="218px" data-retina="true" height="74px" class="blue_logo img-fluid">
                </a>
            </h1>
            @if (!empty($lp->main_title))
                <div class="lp_title text-left m-auto">
                    {!! $lp->main_title !!}
                </div>
            @endif
            @if (!empty($lp->main_description))
                <div class="lp_description mt-3">
                    {!! $lp->main_description !!}
                </div>
            @endif
        </div>
    </section>
    <!-- End header -->

    <!-- Form -->
    <section class="lp form_more_info pb-4 pt-4">
        <div class="container w-960">
            <div class="info-form pb-4" id="mohon-info" style="position: relative">
                <h2 class="text-center">Hubungi kami<br/>untuk informasi lengkap</h2>
                <form method="post" class="landing_form"
                    action="{{ route('submit.hubungi.kami.kuliah', [
                        'redirect_to' => route('landing.kuliah.index.terimakasih', $lp->slug),
                    ]) }}">

                    {{ csrf_field() }}

                    @if (!empty($get['utm_source']))
                        <input type="hidden" name="source" value="{{ $get['utm_source'] }}">
                    @endif

                    <div class="form-group no-bottom">
                        <input id="name" name="name" type="text" placeholder="Nama*" value="{{ old('name') }}"/>
                        <span class="text-danger error error-name">
                    </span>
                    </div>
                    <div class="form-group no-bottom">
                        <input type="text" id="email" name="email" placeholder="Email*" value="{{ old('email') }}">
                        <span class="text-danger error error-email">
                    </span>
                    </div>
                    <div class="form-group no-bottom">
                        <input type="text" id="phone" name="phone" placeholder="Nomor HP*" value="{{ old('phone') }}">
                        <span class="text-danger error error-phone">
                    </span>
                    </div>
                    <div class="form-group no-bottom">
                        <select id="location" name="location">
                            <option value="" selected data-default>Lokasi Tinggal Anda*</option>
                            @foreach($locations as $location)
                                <option value="{{ $location }}">{{ $location }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger error error-location">
                    </span>
                    </div>
                    <div class="form-group no-bottom">
                        <select id="departement" name="departement">
                            <option value="" selected data-default>Jurusan yang Diminati*</option>
                            @foreach($interests as $interest)
                                <option value="{{ $interest->name }}">{{ $interest->name }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger error error-departement">
                    </span>
                    </div>
                    <div class="form-group no-bottom">
                        <select id="education" name="education">
                            <option value="" selected data-default>Ijazah Terakhir*</option>
                            @foreach($levelOfEducations as $key => $education)
                                <option value="{{ $key }}">{{ $education }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger error error-education">
                    </span>
                    </div>
                    <input type="submit" id="submit_form" value="mohon info" class="text-capitalize info-cta-btn full-width mt-3"/>
                </form>
            </div>
        </div>
    </section>
    <!-- End form -->

    <!-- Features -->
    <section class="lp lp_features features-bg pb-5 pt-4">
        <div class="container w-960">
            @if (!empty($lp->feature_title))
                <div class="feature_title mb-4 helvetica-bold font24 center">
                    {!! $lp->feature_title !!}
                </div>
            @endif
            @if (!empty($lp->feature_description))
                <div class="center blended_desc m-auto w70-percent feature_description">
                    {!! $lp->feature_description !!}
                </div>
            @endif
            <div class="row mt-5 light-dark-color">
                @foreach ($icons as $icon)
                    <div class="col-md-4 center mt-2 mb-2">
                        <div class="feature-kuliah">
                            @if (!empty($icon->image))
                                <img class="img-fluid" src="{{ asset_cdn($icon->image) }}">
                            @endif
                            <div class="desc">
                                <h3 class="uppercase mb-3 font16 helvetica-bold">{{ $icon->title }}</h3>
                                <div class="icon_description">
                                    {!! $icon->description !!}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- End features -->

    <!-- Testimonies -->
    <section class="lp pt-5 pb-5 white-bg">
        <div class="container w-960">
            @if (!empty($lp->testimony_title))
                <div class="testimony_title font20 mb-4 center">
                    {!! $lp->testimony_title !!}
                </div>
            @endif
            @if (!empty($lp->testimony_description))
                <div class="testimony_description center m-auto pb-4">
                    {!! $lp->testimony_description !!}
                </div>
            @endif
            <div class="row s1-testimony pt-5">
                @foreach ($testimonies as $testimony)
                    <div class="col-md-6">
                        <div class="item">
                            @if (!empty($testimony->person_image))
                                <figure class="pic">
                                    <img class="img-fluid" src="{{ asset_cdn($testimony->person_image) }}">
                                </figure>
                            @endif
                            <div class="content">
                                @if (!empty($testimony->description))
                                    <p class="font12 mb-2">
                                        {!! $testimony->description !!}
                                    </p>
                                @endif
                                <p class="font12 mb-0">
                                    <span class="font-bold">{{ $testimony->person_name }}</span><br>
                                    {{ $testimony->person_title }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- end Testimonies -->

    <!-- Universities -->
    <section class="lp pt-5 pb-5 gray-bg">
        <div class="container">
            @if (!empty($lp->university_title))
                <div class="university_title font20 mb-4 center pb-1">
                    {!! $lp->university_title !!}
                </div>
            @endif
            @foreach ($universities->chunk(5) as $chunk)
                <div class="row" style="justify-content: center">
                    @foreach ($chunk as $university)
                        <div class="col-md-2 center item pr-2 pl-2">
                            <div class="box_grid">
                                <figure class="no-clip">
                                    <img src="{{ asset_cdn($university->image) }}">
                                </figure>
                                <div class="wrapper no-clip">
                                    <div class="content font-bold university_name">
                                        <h3 class="font-bold">{{ $university->name }}</h3>
                                        <span class="font-bold">{{ $university->location }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </section>
    <!-- End universities -->

    <section class="lp lp_footer dark-grey-bg center pt-5 pb-0">
        <div class="footer_content center w70-percent m-auto">
            {!! $lp->footer_content !!}
        </div>
        <a href="javascript:scrollToElementWithDistance('#mohon-info', 0);" class="info-cta-btn text-capitalize white-text w-auto mt-2 mb-2">mohon info</a>
        <div class="footer_note center w70-percent m-auto pb-4">
            {!! $lp->footer_note !!}
        </div>
    </section>

    <footer class="black-bg2 center p-2">
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
            return false;
        };

        function topFunction() {
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
        }
    </script>
@endpush

