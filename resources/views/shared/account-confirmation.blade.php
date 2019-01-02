@extends('layouts.pintaria.master-no-header-footer')

@section('title') Pintaria - Portal Edukasi Indonesia @endsection
@section('meta_description')Info Kuliah, Kursus Online, Kelas Karyawan, Kuliah Karyawan, Kuliah Blended dan Pendidikan di Indonesia, semuanya ada di Pintaria.com @endsection
@section('content')

<style type="text/css">
    .content h1 {
        margin-top: 4rem;
        font-size:33px;
    }
    .content p {
        margin-top: 4rem;
    }
    .content .img-checklist-wrapper {
        padding-top: 1rem;
    }
    footer {
        margin-top: 4rem;
    }
    footer div {
        padding-bottom: 1rem;
    }
    .c-layout-header-fixed .c-layout-page{
        margin-top:0;
    }
    @media(max-width: 767px) {
        .content h1 {
            margin-top: 4rem;
        }
        .content p {
            margin-top: 2rem;
        }
        footer {
            margin-top: 3rem;
        }
    }
</style>

<div class="c-content-box c-size-md c-bg-white">
    <div class="container">
        <header>
            <div class="col-md-12">
                <div class="row">
                    <center>
                        <a href="{{ route('home') }}">
                            <img src="{{ asset_cdn('pintaria/Logo-Pintaria.png') }}" class="img-responsive img-200" />
                        </a>
                    </center>
                </div>
            </div>
        </header>
        <div class="row text-center content">
            <div class="col-md-12">
                <div class="row">
                    <h1>Konfirmasi Akun</h1>
                </div>
                <div class="row img-checklist-wrapper">
                    <div class="col-md-2 col-md-offset-5 col-sm-2 col-sm-offset-5 col-xs-4 col-xs-offset-4">
                        <img class="img-responsive" src="{{ asset('pintaria/img/shared/checklist.png') }}"/>
                    </div>
                </div>
                <p class="">
                    Terima kasih. Verifikasi email Anda berhasil!<br/>
                    Akun Anda sudah aktif. Gunakan email dan password yang Anda daftarkan untuk <a href="{{ route('masuk') }}"><strong>Masuk</strong></a> Pintaria.
                </p>
            </div>
        </div>
        <footer>
            <div class="col-md-6 col-md-offset-3 col-xs-12">
                @include('shared.social-media')
            </div>
        </footer>
        </div>
</div>
@endsection