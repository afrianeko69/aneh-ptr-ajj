@extends('layouts.pintaria.master-no-header-footer')

@section('title') Pintaria - Portal Edukasi Indonesia @endsection

@section('content')

<!-- BEGIN: PAGE CONTENT -->
<center>
    @if(Request::get('app_affiliate_logo'))
    <img class="img-responsive img-200" src="{{ Request::get('app_affiliate_logo') }}"/>
    @else
    <img src="{{ asset_cdn('Logo-Pintaria.png') }}" class="img-responsive logo" />
    @endif
</center>
<div class="c-content-box c-size-md c-bg-white">
    <div class="container">
        <div class="c-content-title-1">
            <h3 class="c-center c-font-dark c-font-uppercase"> <img src="{{ asset('pintaria/img/shared/close.png') }}"> {{$title}}</h3>
        </div>
        
        <div class="c-content-panel">
            <div class="c-body">
                <center>{!!$description!!}<br>
                    <a href="{{ $do_payment }}" class="btn c-btn btn-lg c-font-bold c-font-white c-theme-btn c-btn-square">Lakukan Pembayaran Kembali</a><br><br>
                    <a href="{{route('home')}}">Kembali ke Beranda</a>
                </center>
            </div>
        </div>

    </div>
</div>
<!-- END: PAGE CONTENT -->

@endsection