@extends('layouts.pintaria3.tryout.master')

@section('title')
Kursus Online Data Science | Pintaria @endsection

@section('meta_description')
Kursus online atau kelas online Data Science di Pintaria bagi kamu yang tertarik belajar mengenai teknologi dalam bidang data seperti big data, python dan machine learning untuk menjadi Data Analyst, Data Engineer, atau Data Scientist. Dapatkan harga promo dari kami special hanya di minggu ini! @endsection

@push('additional.style')
<style type="text/css">
.top-banner {
  background: url("{{asset_cdn('pintaria/landing-pages/digitalmarketing/DM-main-desktop.jpg')}}") center center no-repeat;
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
  height: 640px;
  position: relative;
}
@media(max-width: 768px) {
    .top-banner {
        background: url("{{asset_cdn('pintaria/landing-pages/digitalmarketing/DM-main-mobile-clean.jpg')}}") center center no-repeat #0c0d12;
        height: 540px;
        background-size: cover;
    }
}
</style>
@endpush

@section('content')
<section class="top-banner dm">
    <h1 class="logo"><a href="/"><img src="{{ asset_cdn('pintaria/Logo-Pintaria-Putih.png') }}" alt="Pintaria" width="149" data-retina="true" alt="" class="blue_logo"></a></h1>
    <div class="banner-text">
        <p class="font-bold">
            Jadi master <br> Digital Marketing? <br> BISA!
        </p>
    </div>
</section>
<section>
    <div class="container">
        <h2 class="font25 center font-bold">Mengapa penting mengikuti program ini</h2>
        <div class="row">
            <div class="col-md-3">
                <div class="feature-part">
                    <img src="{{asset_cdn('pintaria/landing-pages/digitalmarketing/DM-3.png')}}">
                    <p class="font18">
                        Digital Marketing dibutuhkan oleh hampir semua perusahaan 
                    </p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="feature-part">
                    <img src="{{asset_cdn('pintaria/landing-pages/digitalmarketing/DM-4.png')}}">
                    <p class="font18">
                        Peran Digital Marketing sangat penting dalam proses marketing sebuah brand
                    </p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="feature-part">
                    <img src="{{asset_cdn('pintaria/landing-pages/digitalmarketing/DM-2.png')}}">
                    <p class="font18">
                        Ada banyak ilmu dalam Digital Marketing yang bisa kamu dapatkan dan praktekkan sesuai dengan kebutuhan 
                    </p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="feature-part">
                    <img src="{{asset_cdn('pintaria/landing-pages/digitalmarketing/DM-1.png')}}">
                    <p class="font18">
                        Tak hanya perusahaan, entrepreneur juga membutuhkan ilmu Digital Marketing
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="light-blue-bg dm">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h2 class="font25 font-bold">Sukses berkarir di dunia Digital Marketing</h2>
                <p class="font18">
                    Digital Marketing Practitioner adalah program online bagi siapa saja yang ingin
                    mempelajari mengenai Digital Marketing dan berbagai macam tips & triknya.
                    Dengan mengikuti program online ini, kamu akan mendapatkan pengetahuan dan keterampilan
                    yang bisa membantu kamu meniti karier sebagai Digital Marketing,
                    SEO Specialist atau Social Media Strategist. 
                </p>
            </div>
            <div class="col-md-4">
                <div class="box_detail center">
                    <img src="{{asset_cdn('pintaria/landing-pages/digitalmarketing/DM-main-desktop.jpg')}}" alt="" class="img-fluid">
                    <div class="name font14">
                        {{ $product->product_name }}
                    </div>
                    <div class="price center">
                        @if(is_null($product->price))

                        @elseif($product->is_discount)
                            <span class="original_price">
                                <em>{{ $product->formatted_price }}</em>
                            </span>
                            {{ $product->formatted_price_after_discount }}
                            <input type="hidden" id="taken-price" value="{{ $product->formatted_price_after_discount }}">
                        @else
                            {{ $product->formatted_price }}
                            <input type="hidden" id="taken-price" value="{{ $product->formatted_price }}">
                        @endif
                    </div>
                    <a href="#" class="btn_2 full-width btn-buy-now">Beli sekarang!</a>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="dm">
    <div class="container w-720">
        <h2 class="font25 center font-bold">Apa yang akan Kamu pelajari dari bidang ini?</h2>
        <div class="row">
            <div class="col-md-6">
                <ul class="mb-0">
                    <li>Guiding Digital Perspective</li>
                    <li>Content Marketing</li>
                    <li>Social Media Marketing</li>
                    <li>Email Marketing</li>
                    <li>Search Engine Optimization</li>
                </ul>
            </div>
            <div class="col-md-6">
                <ul>
                    <li>Pay Per Click (PPC) Ads</li>
                    <li>Display Ads</li>
                    <li>Mobile Marketing Principles</li>
                    <li>Web Analytics Principles</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<span class="dm"><hr /></span>

<section class="dm">
    <div class="container w-960">
        <h2 class="font25 center font-bold">Apa saja yang akan Kamu dapatkan setelah mengikuti program ini?</h2>
        <div class="row">
            <div class="col-md-6">
                <ul class="dm-feature mb-0">
                    <li>
                        <h4 class="font19 font-bold">Forum diskusi</h4>
                        Peserta dapat melakukan diskusi mengenai berbagai topik yang relevan
                        dengan instruktur/mentor dan peserta lainnya pada forum diskusi yang disediakan.
                    </li>
                    <li>
                        <h4 class="font19 font-bold">Live online session</h4>
                        Instruktur/mentor akan mengadakan live online session via 
                        video conference untuk melakukan diskusi dengan peserta.
                    </li>
                </ul>
            </div>
            <div class="col-md-6">
                <ul class="dm-feature">
                    <li>
                        <h4 class="font19 font-bold">Sertifikat penyelesaian</h4>
                        Peserta yang telah menyelesaikan semua kegiatan pembelajaran yang dipersyaratkan
                        dalam kursus online akan menerima Sertifikat Penyelesaian (Certificate of Completion).
                    </li>
                    <li>
                        <h4 class="font19 font-bold">Offline meet-up (gratis)</h4>
                        Instruktur/mentor akan menyelenggarakan offline meetup/pertemuan gratis 
                        untuk memberikan kesempatan melakukan praktek (lokasi hanya di Jabodetabek).
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section id="instructure" class="dm">
    <div class="container w-960">
        <h2 class="center font25 font-bold">Instruktur</h2>
        <div class="instructure-area instructure-d">
            <div class="row">
                <div class="col-md-6 instructure-box">
                    <div class="profile">
                        <img class="img-fluid" src="{{asset_cdn('pintaria/landing-pages/digitalmarketing/Rifqi-O-Edrus.png')}}">
                        <div class="name-area">
                            <span class="name">Rifqi O. Edrus</span>
                            <span class="info">Faculty Member Vanaya Digital</span>
                        </div>
                    </div>
                    <div class="profile-content">
                        Rifqi Edrus adalah seseorang yang tumbuh di lingkungan musik yang kreatif dan penuh inovasi.
                        Sampai saat ini, Rifqi telah bekerja di berbagai perusahaan besar seperti Hard Rock,
                        ThinkDigital Asia, dan Komli SEA. Sebagai seorang digital specialist,
                        Rifqi sudah memberikan digital coaching di berbagai perusahaan yang salah satunya adalah Bank Mandiri.
                        Di bidang digital marketing, Rifqi juga sudah mengantongi beberapa sertifikasi dari Google.
                    </div>
                </div>
                <div class="col-md-6 instructure-box">
                    <div class="profile">
                        <img class="img-fluid" src="{{asset_cdn('pintaria/landing-pages/digitalmarketing/Rade-Tampubolon.png')}}">
                        <div class="name-area">
                            <span class="name">Rade Tampubolon</span>
                            <span class="info">Faculty Member Vanaya Digital</span>
                        </div>
                    </div>
                    <div class="profile-content">
                        Rade Tampubolon adalah seorang spesialis di bidang Business & Leadership For Digital
                        and Content Marketing, Marketing Platform, dan Network. Memiliki latar belakang dan
                        passion di bidang Influencer Marketing Platform, Digital & Content Marketing Addict,
                        Digital Marketing Consultant, Ex-Beatmaker (Radikal Beats), Brand Management, Social Media,
                        dan Advertising. Rade saat ini memegang posisi sebagai CEO & Co-Founder of  SociaBuzz.com.
                    </div>
                </div>
            </div>
        </div>
        <div class="instructure-m instructure-area owl-carousel owl-theme carousels" style="display: none;">
            <div class="item">
                <div class="instructure-box text-left">
                    <div class="profile">
                        <img class="img-fluid" src="{{asset_cdn('pintaria/landing-pages/digitalmarketing/Rifqi-O-Edrus.png')}}">
                        <div class="name-area">
                            <span class="name">Rifqi O. Edrus</span>
                            <span class="info">Faculty Member Vanaya Digital</span>
                        </div>
                    </div>
                    <div class="profile-content font15">
                        Rifqi Edrus adalah seseorang yang tumbuh di lingkungan musik yang kreatif dan penuh inovasi.
                        Sampai saat ini, Rifqi telah bekerja di berbagai perusahaan besar seperti Hard Rock,
                        ThinkDigital Asia, dan Komli SEA. Sebagai seorang digital specialist,
                        Rifqi sudah memberikan digital coaching di berbagai perusahaan yang salah satunya adalah Bank Mandiri.
                        Di bidang digital marketing, Rifqi juga sudah mengantongi beberapa sertifikasi dari Google.
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="instructure-box text-left">
                    <div class="profile">
                        <img class="img-fluid" src="{{asset_cdn('pintaria/landing-pages/digitalmarketing/Rade-Tampubolon.png')}}">
                        <div class="name-area">
                            <span class="name">Rade Tampubolon</span>
                            <span class="info">Faculty Member Vanaya Digital</span>
                        </div>
                    </div>
                    <div class="profile-content font15">
                        Rade Tampubolon adalah seorang spesialis di bidang Business & Leadership For Digital
                        and Content Marketing, Marketing Platform, dan Network. Memiliki latar belakang dan
                        passion di bidang Influencer Marketing Platform, Digital & Content Marketing Addict,
                        Digital Marketing Consultant, Ex-Beatmaker (Radikal Beats), Brand Management, Social Media,
                        dan Advertising. Rade saat ini memegang posisi sebagai CEO & Co-Founder of  SociaBuzz.com.
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<footer class="dm">
    <img class="img-fluid logo" src="{{ asset_cdn('pintaria/Logo-Pintaria.png') }}">
    <p class="center font18">2018 &copy; Pintaria. Powered by HarukaEDU</p>
</footer>
@endsection

@push('additional.script')
@if(env('APP_DEBUG') == false)
<script src="https://app.midtrans.com/snap/snap.js" type="text/javascript" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
@else
<script src="https://app.sandbox.midtrans.com/snap/snap.js" type="text/javascript" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
@endif

@include('shared.pintaria3.payment_modal_js')

@endpush

