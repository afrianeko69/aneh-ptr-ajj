<html>
<head>
    <title>{{ $title }}</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style type="text/css"> 
        @font-face {
            font-family:'Titillium Web';
            src: url("{{ asset('fonts/TitiliumWeb/Titillium Web Bold.eot') }}");
            src: url("{{ asset('fonts/TitiliumWeb/Titillium Web Bold.eot?#iefix') }}") format('embedded-opentype'),
                url("{{ asset('fonts/TitiliumWeb/Titillium Web Bold.woff2') }}") format('woff2'),
                url("{{ asset('fonts/TitiliumWeb/Titillium Web Bold.woff') }}") format('woff'),
                url("{{ asset('fonts/TitiliumWeb/Titillium Web Bold.ttf') }}") format('truetype'),
                url("{{ asset('fonts/TitiliumWeb/Titillium Web Bold.otf') }}") format('opentype'),
                url("{{ asset('fonts/TitiliumWeb/Titillium Web Bold.svg#Titillium Web Bold') }}") format('svg');
            font-weight: 700;
            font-style: normal;
            font-stretch: normal;
            unicode-range: U+0020-00FE;
        }
        @font-face {
            font-family:'Titillium Web';
            src: url("{{ asset('fonts/TitiliumWeb/Titillium Web Regular.eot') }}");
            src: url("{{ asset('fonts/TitiliumWeb/Titillium Web Regular.eot?#iefix') }}") format('embedded-opentype'),
                url("{{ asset('fonts/TitiliumWeb/Titillium Web Regular.woff2') }}") format('woff2'),
                url("{{ asset('fonts/TitiliumWeb/Titillium Web Regular.woff') }}") format('woff'),
                url("{{ asset('fonts/TitiliumWeb/Titillium Web Regular.ttf') }}") format('truetype'),
                url("{{ asset('fonts/TitiliumWeb/Titillium Web Regular.otf') }}") format('opentype'),
                url("{{ asset('fonts/TitiliumWeb/Titillium Web Regular.svg#Titillium Web Regular') }}") format('svg');
            font-weight: 275;
            font-style: normal;
            font-stretch: normal;
            unicode-range: U+0020-00FE;
        }
        body {
            margin: 0px;
            color: #3f3f3f;
            font-family: 'Titillium Web', sans-serif !important;
            font-weight: 275;
            font-size:32px;
        }
        .background-image {
            position: absolute;
            width: 100%;
            height: 100%;
        }
        .content-wrapper {
            position: relative;
            padding-left: 600px;
            margin-top: 190px;
            display: inline-block;
            width: 100%;
        }
        .content-wrapper .pintaria-logo {
            width: auto;
            height: 100px;
        }
        .content-wrapper .cert-completion {
            position: absolute;
            left: 260px;
            top: 90px;
            color: #FFF;
        }
        .content-wrapper .certify-text {
            margin: 75px 0px 15px;
        }
        .content-wrapper .username {
            color: #f80060;
            text-transform: uppercase;
            font-size: 60px;
            border-bottom: #5a5a5a solid 1px;
            line-height: 30px;
        }
        .content-wrapper .detail {
            margin-top: 95px;
            padding-right: 50px;
            height: 80px;
            letter-spacing: 1px;
            width: 60%;
        }
        .content-wrapper .course-name {
            text-transform: uppercase;
        }
        .signature-wrapper {
            margin: 140px 0 100px;
            display: inline-block;
            width: 100%;
        }
        .clear {
            display: block;
            clear: both;
        }
        .signature-wrapper .lecturer-wrapper {
            float: left;
            max-width: 20%;
            height: 250px;
            text-align: left;
            margin-right: 30px;
        }
        .signature-wrapper .lecturer-wrapper .signature {
            max-width: 100%;
            max-height: 100px;
            display: inline-block;
        }
        .lecturer-signature-wrapper {
            height: 100px;
            width: 100%;
            white-space: nowrap;
        }
        .lecturer-wrapper .lecturer-name {
            margin-top: -3px;
            font-size: 26px;
            height: {{ (20 * $instructor_detail['instructor_name_detail']['rows']) . 'px' }};
        }
        .lecturer-wrapper .lecturer-title {
            margin-top: -15px;
            font-size: 24px;
        }
        .footer {
            width: 66%;
        }
        .info-wrapper {
            font-size: 20px;
            line-height: 10px;
            position: relative;
            top: 40px;
            display: inline-block;
        }
        .info-wrapper .info {
            width: 300px;
            float: left;
        }
        .providers-logo-wrapper {
            width: 710px !important;
            white-space: nowrap;
            text-align: right;
        }
        .providers-logo-wrapper .provider-logo {
            display: inline-block;
            max-width: 100%;
            max-height: 60px;
            padding: 5px 15px;
        }
        .username, .course-name, p.detail b, .lecturer-name, .certify-text {
            font-family: 'Titillium Web', sans-serif !important;
            font-weight: 700;
        }
    </style>
</head>
<body>
    <img src="{{ $images['background'] }}"class="background-image">
    <div class="content-wrapper">
        <p class="cert-completion">CERTIFICATE<br/>of Completion</p>
        <img class="pintaria-logo" src="{{ $images['pintaria_logo'] }}" />
        <p class="certify-text">
            This is to certify that
        </p>
        <span class="username">{{ $user->name }}</span>
        <p class="detail">has successfully completed a training course named
            <br/><span class="course-name">{{ $course_detail->course_name }}</span>&nbsp;&nbsp;an online learning initiative of
            @foreach($providers as $key => $provider)
                @if($providers->count() > 1 && $key == $providers->count() - 1)
                    <span> and </span>
                @elseif($providers->count() > 1 && $key > 0 && $key < $providers->count() - 1)
                    <span>, </span>
                @endif
                <b>{{ $provider->name }}</b>
            @endforeach
            through <b>Pintaria</b>
        </p>

        <div class="signature-wrapper">
            @foreach($instructor_detail['instructors'] as $instructor)
                <div class="lecturer-wrapper">
                    <div class="lecturer-signature-wrapper">
                        <img class="signature" src="{{ $instructor->base64_image }}">
                    </div>
                    <p class="lecturer-name">{{ $instructor->instructor_name }}</p>
                    <p class="lecturer-title">Instructor</p>
                </div>
            @endforeach
        </div>
        <div class="clear"></div>
        <div class="footer">
            <div class="info-wrapper">
                <div class="info">
                    <p><b>Pintaria Certificate</b></p>
                    <p>issued on {{ $certificate['issue_date'] }}</p>
                </div>
                <div class="info">
                    <p><b>Certificate No.</b></p>
                    <p>{{ $certificate['number'] }}</p>
                </div>
                <div class="info providers-logo-wrapper">
                    @foreach($providers as $provider)
                        <img src="{{ $provider->base64_logo }}" class="provider-logo">
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</body>
</html>