@extends('layouts.pintaria3.master')
@section('title') Pintaria - Portal Edukasi Indonesia  @endsection
@section('meta_description')Info Kuliah, Kursus Online, Kelas Karyawan, Kuliah Karyawan, Kuliah Blended dan Pendidikan di Indonesia, semuanya ada di Pintaria.com @endsection
@section('content')
<main>
    <div class="container margin_120_95 add_top_60">
        <center>
            @if(Request::get('app_affiliate_logo'))
            <img class="img-responsive img-200" src="{{ Request::get('app_affiliate_logo') }}"/>
            @else
            <img src="{{ asset_cdn('pintaria/Logo-Pintaria.png') }}" class="img-responsive logo" />
            @endif
        </center>
        <div class="main_title_2 add_top_30">
            <h3>{{$title}}</h3>
        </div>
        <center>{!!$description!!}<br>
            <a href="{{route('home')}}" class="btn btn-lg btn-primary">Kembali ke Beranda</a><br><br>
        </center>
        <!--/row-->
    </div>
    <!-- /container -->
</main>
@endsection