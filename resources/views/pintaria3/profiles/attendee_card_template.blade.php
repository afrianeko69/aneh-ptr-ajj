<html>
<head>
    <title>Kartu Peserta</title>
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
            font-size:30px;
        }
        .background-image {
            position: absolute;
            width: 100%;
            height: auto;
        }
        .content-wrapper {
            position: relative;
            display: inline-block;
            width: 100%;
            left: 150px;
            top: 220px;
        }

        .content-wrapper p {
            margin: -10px;
        }

        .content-wrapper .key {
            display: inline-block;
            width: 240px;
        }

        .content-wrapper .value {
        }

        .break-before {
            display: block;
            page-break-before: always;
        }

        .clear {
            display: block;
            clear: both;
        }
    </style>
</head>
<body>
@foreach ($attendees as $attendee)
<div class="break-before">
    <img src="{{asset_cdn('pintaria/background/kartu_peserta_template.jpg')}}"class="background-image">
    <div class="content-wrapper">
        <p>
            <span class="key">ID Peserta</span>
            <span class="value">: {{ $attendee['attendee_card_id'] }}</span>
        </p>
        <p>
            <span class="key">Nama</span>
            <span class="value">: {{ $attendee['name'] }}</span>
        </p>
        <p>
            <span class="key">Pelatihan</span>
            <span class="value">: {{ $attendee['course'] }}</span>
        </p>
        <p>
            <span class="key">Hari/Tanggal</span>
            <span class="value">: {{ $attendee['date'] }}</span>
        </p>
        <p>
            <span class="key">Waktu</span>
            <span class="value">: {{ $attendee['time'] }}</span>
        </p>
    </div>
</div>
@endforeach
</body>
</html>
