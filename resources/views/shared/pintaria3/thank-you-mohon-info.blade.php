@extends('layouts.pintaria3.master')

@section('title')Pintaria - Portal Edukasi Indonesia @endsection
@section('meta_description')Info Kuliah, Kursus Online, Kelas Karyawan, Kuliah Karyawan, Kuliah Blended dan Pendidikan di Indonesia, semuanya ada di Pintaria.com @endsection
@section('content')
<main>
    <div class="container margin_120_95 add_top_60">
        <center>
            <a href="{{ route('home') }}">
                @if(Request::get('app_affiliate_logo'))
                    <img class="img-responsive img-200" src="{{ Request::get('app_affiliate_logo') }}"/>
                @else
                    <img class="img-responsive img-200" src="{{ asset_cdn('pintaria/Logo-Pintaria.png') }}"/>
                @endif
            </a>
        </center>
        <div class="main_title_2 add_top_30">
            <h1>Terima kasih telah mengisi form Mohon Info</h1>
            <p>Anda akan kami hubungi melalui email/telepon<br>dalam waktu 1x24 jam</p>
        </div>

        <br clear="both" />
        <center>
            <a href="{{ URL::previous() }}" class="btn btn-lg btn-primary">KEMBALI KE HALAMAN SEBELUMNYA</a>
        </center>
        <br clear="both" />
        <!--/row-->
    </div>
    <!-- /container -->
</main>
@endsection