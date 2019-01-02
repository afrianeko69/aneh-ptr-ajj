@extends('layouts.pintaria3.master')

@section('title') Pintaria - Portal Edukasi Indonesia @endsection
@section('meta_description')Info Kuliah, Kursus Online, Kelas Karyawan, Kuliah Karyawan, Kuliah Blended dan Pendidikan di Indonesia, semuanya ada di Pintaria.com @endsection

@section('content')
<section id="hero_in" class="courses">
    <div class="wrapper">
        <div class="container">
            <h1 class="fadeInUp"><span></span>Akun Saya</h1>
        </div>
    </div>
</section>

<div class="bg_color_1">
    @include('layouts.pintaria3.partials.profiles.sidebar')
    <div class="container margin_60_35">
        <div class="row">
            <aside class="col-lg-4 col-md-4 col-sm-5" id="sidebar">
                <div class="box_detail text-center">
                    @if($user->profile_picture)
                        <img src="{{ route('asset', [$user->profile_picture]) }}" class="img-fluid rounded-circle">
                    @else
                        <img src="{{ asset('pintaria/img/shared/default-profile-photo.jpg') }}" class="img-fluid rounded-circle"/>
                    @endif
                    @if($user_referral_code)
                        <div class="row mt-4">
                            <div class="col">
                                Kode referral saya &nbsp;<strong>{{ $user_referral_code->referral_code }}</strong>
                                <a href="{{ route('akun.saya.rekomendasi') }}" class="btn-sm btn-orange rounded">
                                    <i class="fa fa-gift gift-profile"></i>
                                    BAGIKAN KODE REFERRAL
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </aside>
            <div class="col-lg-8 col-md-8 col-sm-7">
                <section>
                    <h2>Hi, {{ $user->name }}</h2>
                    <div class="row">
                        <div class="col-md-6 col-xs-12">
                            <label>Nama</label>
                        </div>
                        <div class="col-md-6 col-xs-12">
                            <p>{{ $user->name }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-xs-12">
                            <label>Email</label>
                        </div>
                        <div class="col-md-6 col-xs-12">
                            <p>{{ $user->email }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-xs-12">
                            <label>Nomor Telepon Rumah</label>
                        </div>
                        <div class="col-md-6 col-xs-12">
                            <p>{{ ($user->home_number ?: '(Tidak Tersedia)') }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-xs-12">
                            <label>Nomor Ponsel</label>
                        </div>
                        <div class="col-md-6 col-xs-12">
                            <p>{{ ($user->phone_number ?: '(Tidak Tersedia)') }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-xs-12">
                            <label>Alamat</label>
                        </div>
                        <div class="col-md-6 col-xs-12">
                            <p>{{ ($user->address ?: '(Tidak Tersedia)') }}</p>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>
@endsection
