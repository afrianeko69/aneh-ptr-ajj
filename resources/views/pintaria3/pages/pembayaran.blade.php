@extends('layouts.pintaria3.tryout.master')

@section('title') Pembayaran @endsection

<div class="payment">
    <header>
        <div class="container">
            <a href="{{ route('home') }}">
                <img src="{{ asset_cdn('pintaria/Logo-Pintaria.png') }}" class="img-responsive img-200" />
            </a>
        </div>
    </header>
    <div class="main-content">
        <div class="container">
            <ul class="step">
                <li>
                    <span>Konfirmasi Pembelian</span>
                </li>
                <li class="active">
                    <span>Pembayaran</span>
                </li>
            </ul>
            <h2>pilih metode pembayaran</h2>
            <div class="user-data">
                <ul class="payment-method">
                    <li>
                        <input type="radio" name="payment-method" id="midtrans">
                        <label for="midtrans">
                            Transfer, Transfer Virtual Account, Kartu Visa / Mastercard, Mandiri Clickpay, CIMB Clicks
                            <img src="{{ url('pintaria/img/shared/midTrans.jpg') }}">
                        </label>
                    </li>
                    <li>
                        <input type="radio" name="payment-method" id="akulaku">
                        <label for="akulaku">
                            Cicilan tanpa kartu kredit
                            <img src="{{ url('pintaria/img/shared/akulaku.png') }}">
                        </label>
                        <span class="note">
                            Anda akan diarahkan ke Checkout Akulaku. Layanan Akulaku hanya berlaku bagi pemilik akun Akulaku yang sudah teraktivasi. Informasi lebih lanjut terkait Akulaku dapat menghubungi Call Center Akulaku di 1500621 (English and Bahasa)
                        </span>
                    </li>
                </ul>
                <h3>Ringkasan Belanja</h3>
                <p class="pay"><span>Analitik Data untuk bisnis dengan excel</span>Rp1.500.000</p>
                <p class="pay"><span>Diskon</span>-Rp250.000</p>
                <p class="pay total"><span>Total</span>Rp1.250.000</p>
                <button id="payment_confirm" class="btn btn_1 btn-block btn-pay-now" data-bundle-id="0" data-bundle-clean-price="0">
                    Bayar
                </button>
            </div>
            <a href="#" class="link font-14"><i class="fa fa-angle-left"></i>&nbsp;&nbsp;Kembali ke Konfirmasi Pembelian</a>
        </div>
    </div>
</div>