@extends('layouts.pintaria3.tryout.master')

@section('title') Konfirmasi Beli @endsection

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
                <li class="active">
                    <span>Konfirmasi Pembelian</span>
                </li>
                <li>
                    <span>Pembayaran</span>
                </li>
            </ul>
            <div class="item-container">
                <div class="item">
                    <img src="{{ asset_cdn('pintaria/products/April2018/2-visualisasi-r-180402084412.jpg') }}">
                    <h3>
                        Analitik Data untuk bisnis dengan excel<br/>
                        <span>e-learning</span>
                        <span>Dattabot</span>
                    </h3>
                    <p class="price">Rp1.500.000</p>
                </div>
                <p class="pay"><span>Diskon</span>- Rp250.000</p>
                <p class="pay"><span>Total</span>Rp1.250.000</p>
                <div class="user-data">
                    <form>
                        <span class="input input--filled">
                            <input type="text" class="input_field" value="Rifa mukhlisa" readonly="">
                            <label class="input_label">
                                <span class="input__label-content">Nama</span>
                            </label>
                        </span>
                        <span class="input input--filled">
                            <input type="text" class="input_field" value="rifa.mukhlisa@gmail.com" readonly="">
                            <label class="input_label">
                                <span class="input__label-content">Email</span>
                            </label>
                        </span>
                        <span class="input" id="phone-confirm-field">
                            <input type="text" class="input_field" value="" id="phone-confirm">
                            <label class="input_label">
                                <span class="input__label-content">No. Ponsel</span>
                            </label>
                            <span class="text-danger error error-phone_number">
                                <small></small>
                            </span>
                        </span>
                        <span class="with-btn">
                            <span class="input">
                                <input type="text" class="input_field" name="promo_code" id="promo_code">
                                <label class="input_label">
                                    <span class="input__label-content">Kode Promo</span>
                                </label>
                            </span>
                            <button class="btn btn_1 btn-block btn-promo-code">
                                <small>Gunakan Kode Promo</small>
                            </button>
                        </span>
                        <span class="with-btn">
                            <span class="input">
                                <input type="text" class="input_field" name="referral_code" id="referral_code">
                                <label class="input_label">
                                    <span class="input__label-content">Kode Referral</span>
                                </label>
                            </span>
                            <button class="btn btn_1 btn-block btn-referral-code">
                                <small>Gunakan Kode Referral</small>
                            </button>
                        </span>
                        <button id="payment_confirm" class="btn btn_1 btn-block btn-pay-now" data-bundle-id="0" data-bundle-clean-price="0">
                            Bayar
                        </button>
                        <p class="note">
                            Dengan menekan tombol "Bayar", saya mengkonfirmasi telah menyetujui <a href="#" target="_blank"><strong>Perjanjian Pengguna</strong></a> Pintaria. Pembayaran akan ditujukan ke rekening PT Haruka Evolusi Digital Utama, badan hukum dari Pintaria.<br/>
                            <i class="fa fa-lock" aria-hidden="true"></i> Secure Connection
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>