@extends('layouts.pintaria3.master')

@section('title') Pintaria - Portal Edukasi Indonesia  @endsection
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
            <h1>Terima kasih</h1>
        </div>
            @php
                $affiliate_name = Request::get('app_affiliate_name');
            @endphp
            @if(!$affiliate_name)
                @php
                    $affiliate_name = 'Pintaria';
                @endphp
            @endif
            <center>
                <p>
                    Kami senang Anda telah bergabung bersama {{ $affiliate_name }}.
                    Untuk mengikuti semua kelas di {{ $affiliate_name }}, Anda diharuskan untuk melakukan verifikasi email.
                </p>
            </center>
        <!--/row-->
    </div>
    <!-- /container -->
</main>
@endsection