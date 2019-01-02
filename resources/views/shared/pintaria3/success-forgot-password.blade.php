@extends('layouts.pintaria3.master')

@section('title')
Pintaria - Lupa Password
@endsection
@section('meta_description')Info Kuliah, Kursus Online, Kelas Karyawan, Kuliah Karyawan, Kuliah Blended dan Pendidikan di Indonesia, semuanya ada di Pintaria.com @endsection

@section('content')
    <section id="hero_in" class="forgot-password-banner">
        <div class="wrapper">
            <div class="container">
                <h1 class="fadeInUp"><span></span>Lupa Password</h1>
            </div>
        </div>
    </section>
    <!--/hero_in-->

    <div class="bg_color_1">
        <div class="container margin_120_95">
            <div class="row justify-content-between">
                <div class="col-lg-12 col-md-12">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="panel panel-default c-panel">
                            <div class="panel-body c-panel-body">
                                <div class="c-content-title-1">
                                    <h3 class="c-left">Password Anda Akan Diubah</h3>
                                    <div class="c-line-left c-theme-bg"></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <p>
                                            Panduan untuk mengubah password telah kami kirim ke email Anda. Silakan cek email Anda dan ikuti instruksi yang Anda terima.
                                        </p>
                                        <a href="{{ route('home') }}" class="btn_1 rounded blue">Kembali Ke Beranda</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/row-->
        </div>
        <!--/container-->
    </div>
    <!--/bg_color_1-->

@endsection
