@extends('layouts.pintaria3.tryout.master')

@section('title')
Promo Kursus Online Data Science Smart Package | April Makin Terampil | Pintaria @endsection

@section('meta_description')
Kursus online atau kelas online Data Science di Pintaria bagi kamu yang tertarik belajar mengenai teknologi dalam bidang data seperti big data, phyton dan machine learning untuk menjadi Data Analyst, Data Engineer, atau Data Scientist. Dapatkan harga promo dari kami special hanya di minggu ini! @endsection

@push('additional.style')
<style type="text/css">
.top-banner {
  background: url("{{asset_cdn('pintaria/landing-pages/Slider-Desktop-LP-Data-Science.jpg')}}") center center no-repeat;
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
  height: 450px;
  position: relative;
}
@media(max-width: 768px) {
    .top-banner {
        background-image: url("{{asset_cdn('pintaria/landing-pages/Slider-Desktop-LP-Data-Science1.jpg')}}");
        background-position: center bottom;
        background-repeat: no-repeat;
        background-color: rgb(106,152,238);
        height: 500px;
        background-size: cover;
    }
}
</style>
@endpush

@section('content')
<section class="top-banner ds-package">
    <h1 class="logo"><a href="/"><img src="{{ asset_cdn('pintaria/Logo-Pintaria.png') }}" alt="Pintaria" width="149" data-retina="true" alt="" class="blue_logo"></a></h1>
    <div class="banner-text ml-100">
        <p class="pacifico center">
            April<br/>Makin Terampil<br>
        </p>
        <p class="font30 font-bold">Data Science Smart Package</p>
        <p class="font-normal font20">
            <span class="line-through">Rp900,000 </span>
            <span class="font-bold"> Rp750,000</span>
            for 3 classes! <br/> April 2018
        </p>
    </div>
</section>
<section>
    <div class="container">
        <h2 class="capitalize font25 center font-bold">mengapa penting untuk mengikuti program ini?</h2>
        <div class="row">
            <div class="col-md-3">
                <div class="feature-part">
                    <img src="{{asset_cdn('pintaria/landing-pages/sexiest-job.png')}}">
                    <p class="font18">
                        Data Scientist disebut sebagai <strong>"the sexiest job of the 21st century"</strong>
                    </p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="feature-part">
                    <img src="{{asset_cdn('pintaria/landing-pages/keputusan.png')}}">
                    <p class="font18">
                        Peran Data Scientist begitu strategis untuk menunjang <strong>pengambilan keputusan bisnis</strong>
                    </p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="feature-part">
                    <img src="{{asset_cdn('pintaria/landing-pages/perusahaan.png')}}">
                    <p class="font18">
                        Perusahaan dan organisasi di Indonesia sudah mulai <strong>menggunakan big data</strong>
                    </p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="feature-part">
                    <img src="{{asset_cdn('pintaria/landing-pages/pencarian.png')}}">
                    <p class="font18">
                        Data Science dapat membantu perusahaan <strong>menggali bermacam informasi</strong>
                    </p>
                </div>
            </div>
        </div>
        <span class="line-separator"></span>
    </div>
</section>
<section class="dark-blue-bg mt-100">
    <div class="container">
        <div class="row">
            <div class="col-md-12" style="text-align:center; margin-top: -250px">
                <h2 class="font25 font-bold">Data Science Smart Package</h2>
            </div>

            @if($bundles)
                @foreach($bundles as $bundle_detail)
                    <div class="col-md-4 mt-min-150">
                        @php
                            $b_detail = $bundle_detail['bundle'];
                        @endphp
                        <div class="card landing-card">
                            <center>
                                @if (strtolower($bundle_detail['bundle']->name) == 'smart package a')
                                    <img src="{{ asset_cdn('pintaria/landing-pages/paket-a.png') }}">
                                @elseif (strtolower($bundle_detail['bundle']->name) == 'smart package b')
                                    <img src="{{ asset_cdn('pintaria/landing-pages/paket-b.png') }}">
                                @elseif (strtolower($bundle_detail['bundle']->name) == 'smart package c')
                                    <img src="{{ asset_cdn('pintaria/landing-pages/paket-c-2.png') }}">
                                @endif
                            </center>
                            <h5 class="pt-2 font-bold" style="text-align:center">
                                {{ $b_detail->name }}
                            </h5>
                            <br clear="both" />
                            <ul class="package-list">
                            @foreach($bundle_detail['products'] as $b_product)
                                <li>{{ $b_product->name }}</li>
                            @endforeach
                            </ul>
                            <center>
                            <div class="price">
                                <span class="original-price">Rp900.000</span><br>
                                {{ $b_detail->formatted_price }}
                            </div>

                            @if($b_detail->is_purchased)
                                <button class="btn_1 full-width btn-yellow-disabled outline ">Telah Dibeli</button>
                            @else
                                <a href="{{ route('product.konfirmasi.beli', [$product->slug, 'paket' => $b_detail->id]) }}" style="line-height: 50px!important"
                                   class="btn_2 btn-package-purchase"
                                   data-bundle-id="{{ $b_detail->id }}"
                                   data-bundle-name="{{ $b_detail->name }}"
                                   data-bundle-price="{{ $b_detail->formatted_price }}"
                                   data-bundle-clean-price="{{ $b_detail->price }}">Beli Sekarang</a>
                            @endif
                            </center>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</section>
<section>
    <div class="container">
        <h2 class="capitalize font25 center">Testimonial</h2>
        <div class="row">
            <div class="col-md-6">
                <div class="testy">
                    <span class="pic-wrap"><img src="{{url('pintaria3/img/Benedictus-Aryo-Kumoro.jpg')}}"></span>
                    <p class="font18 center">
                        "Konsep pembelajaran sangat baik, konten video yang diberikan cukup baik. Materi yang diberikan sangat mudah dipahami
                        bagi orang awam."
                        <br/><br/>
                        <strong>Banedictus Aryo Kumoro</strong>
                    </p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="testy">
                    <span class="pic-wrap"><img src="{{url('pintaria3/img/Achmad_Yudha_Utomo.jpg')}}"></span>
                    <p class="font18 center">
                        "Sangat bagus dan kemprehensif, terutama untuk bagian Deskriptif Analytics-nya, karena mencakup beberapa
                        fitur core yang akan digunakan di dunia nyata (fungsi-fungsi excel yang umum digunakan, summarize data dengan Pivot, visualizasi dengan berbagai macam chart, serta bagaimana men-deliver insights melalui dashboard yang
                        interaktif dan informatif)."
                        <br/><br/>
                        <strong>Achmad Yudha Utomo</strong>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="light-blue-bg no-border">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <p class="center font16">
                    Pintaria adalah sebuah situs yang menawarkan produk-produk pendidikan dan pelatihan / kursus yang berkualitas dengan berbagai macam kategori yang ditujukan untuk masyarakat yang ingin meningkatkan pengetahuan dan keahlian.
                    <br/><br/>
                    Produk kelas Data Science yang kami tawarkan akan membantu Anda mempelajari teknologi di bidang data seperti big data, machine learning dan phyton. Dengan mengikuti kelas online ini, Anda akan mendapatkan pengetahuan dan keterampilan yang dapat membantu Anda meniti karir sebagai Data Analyst, Data Engineer, atau Data Scientist.
                </p>
            </div>
        </div>
    </div>
</section>
<footer class="dark-blue-bg">
    <p class="center font18">2018 &copy; Pintaria. Powered by HarukaEDU</p>
</footer>
@endsection

@push('additional.script')
@if(env('APP_DEBUG') == false)
<script src="https://app.midtrans.com/snap/snap.js" type="text/javascript" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
@else
<script src="https://app.sandbox.midtrans.com/snap/snap.js" type="text/javascript" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
@endif

<script type="text/javascript">
var product_type = "{{ $product->type }}";
var is_purchase_process = "{{ Request::get('beli') }}";
var bundle = "{{ Request::get('paket') }}";
var learning_method = "{{ $product->learning_method_name ? $product->learning_method_name : '' }}";
var providers = "{{ $product->providers ? $product->provider_list : '' }}";
var product_id = "{{ $product->id }}";
var product_price = "{{ $product->is_discount ? $product->price_after_discount : $product->price }}";
var referral_reward_data = null;
var promo_reward_data = null;
var productSlug = "{{ $product->slug }}";
var productName = "{{ $product->product_name }}";
var login_url = "{{ route('daftar') }}";
var is_login = "{{ (\Auth::check()) ? true : false }}";
var currentPageRatingReview = 1;


$(document).ready(function() {

    $('a[href^="#"]').click(function(e) {
        e.preventDefault();
        var target = this.hash, $target = $(target);
        if ($(window).width() < 960) {
            $('html, body').animate({
                scrollTop: $target.offset().top - 120
            }, 300);
        }
    });

    if(is_purchase_process == true) {
        if(is_login != true) {
            window.location.href = login_url + '?previous_url=' + window.location.href;
        } else {
            if(product_type == 'paid') {
                initModalPurchase(productName, $('#taken-price').val(), learning_method, providers);
            }else{
                buyNow({}, '.btn-buy-now');
            }
        }
    } else if(bundle) {
        if(is_login != true) {
            window.location.href = login_url + '?previous_url=' + window.location.href;
        } else {
            //check if bundle is valid or not
            var is_valid_bundle = false;
            var selected_bundle = {};
            $('button.btn-package-purchase').each(function() {
                if($(this).data('bundle-id') == bundle && is_valid_bundle == false) {
                    is_valid_bundle = true;
                    selected_bundle = {
                        id: $(this).data('bundle-id'),
                        name: $(this).data('bundle-name'),
                        price: $(this).data('bundle-price'),
                        clean_price: $(this).data('bundle-clean-price')
                    };
                }
            });

            if(is_valid_bundle) {
                $('#payment-popup-modal .modal-body button#payment_confirm.btn-pay-now').data('bundle-id', selected_bundle.id);
                $('#payment-popup-modal .modal-body button#payment_confirm.btn-pay-now').data('bundle-clean-price', selected_bundle.clean_price);
                initModalPurchase(selected_bundle.name, selected_bundle.price, '', '');
            } else {
                history.replaceState('', document.title, window.location.pathname, window.location.search);
            }
        }
    }

    $(document).on('click', '.btn-buy-now', function(e) {
        e.preventDefault();
        $('.error').children().html('');

        var current_url = window.location.pathname + '/konfirmasi-beli';
        history.replaceState('', document.title, current_url, window.location.search);
        if(is_login != true) {
            window.location.href=login_url + '?previous_url=' + window.location.href;
            return false;
        }

        if(product_type == 'free') {
            buyNow({}, '.btn-buy-now');
        } else if(product_type == 'paid') {
            initModalPurchase(productName, $('#taken-price').val(), learning_method, providers);
        }
    });

    $(document).on('click', 'button.btn-package-purchase', function(e) {
        e.preventDefault();
        var bundle_id = $(this).data('bundle-id');
        var current_url = window.location.pathname + '?paket=' + bundle_id;
        history.replaceState('', document.title, current_url, window.location.search);
        if(is_login != true) {
            window.location.href = login_url + '?previous_url=' + window.location.href;
            return false;
        }

        $('#payment-popup-modal .modal-body button#payment_confirm.btn-pay-now').data('bundle-id', bundle_id);
        $('#payment-popup-modal .modal-body button#payment_confirm.btn-pay-now').data('bundle-clean-price', $(this).data('bundle-clean-price'));
        initModalPurchase($(this).data('bundle-name'), $(this).data('bundle-price'), '', '');
    });

    $(document).on('click', '#payment-popup-modal #payment_confirm.btn-pay-now', function(e) {
        e.preventDefault();
        var data = {};
        data['phone_number'] = $('#payment-popup-modal #phone-confirm-field #phone-confirm').val();
        buyNow(data, '#payment-popup-modal #payment_confirm.btn-pay-now');
    });

    $(document).on('hidden.bs.modal', '#payment-popup-modal', function() {
        history.replaceState('', document.title, window.location.pathname, window.location.search);
    });

    // Section Referral
    $(document).on('keyup', '#payment-popup-modal div.referral-code-field-wrapper input#referral_code', function(e) {
        var self = $(this);
        $(this).val(self.val().toUpperCase());
    });

    $(document).on('click', '#payment-popup-modal button.btn.btn-referral-code', function (e) {
        e.preventDefault();
        $('#payment-popup-modal .error').children().html('');

        var self = $(this);
        if(self.hasClass('btn_1')) {
            var referral_code = $('#payment-popup-modal div.referral-code-field-wrapper input#referral_code').val();
            if(!referral_code) {
                $('#payment-popup-modal div.referral-code-field-wrapper span.error-referral_code').children().html('Harap memasukkan kode referral.');
                return false;
            }

            disableReferralCodeField();
            var packagePrice = getCurrentPrice();
            checkReferralCode(referral_code, packagePrice.id, packagePrice.type);
        } else {
            referral_reward_data = null;
            resetReferralCode();
        }
    });

    function checkReferralCode(referral_code, id, type) {
        var btn_container = '#payment-popup-modal button.btn.btn-referral-code';
        $(btn_container).attr('disabled', true);

        $.ajax({
            url: baseUrl + '/referral-codes/' + referral_code + '/' + id + '/' + type,
            type: 'GET',
            async: true,
            success:function(response) {
                if(response.status == 200 && response.body.is_valid == true) {
                    referral_reward_data = response.body;
                    appendReward();
                } else {
                    $('#payment-popup-modal div.referral-code-field-wrapper span.error-referral_code').children().html(response.message);
                    resetReferralCode();
                }
                $(btn_container).attr('disabled', false);
            },
            error: function(response) {
                $('#payment-popup-modal div.referral-code-field-wrapper span.error-referral_code').children().html('Kode Referral tidak ditemukan atau sudah tidak berlaku.');
                resetReferralCode();
                $(btn_container).attr('disabled', false);
            }
        });
    }

    function resetReferralCode() {
        $('#payment-popup-modal .modal-body div.referral-code-field-wrapper #referral_code').val('');
        $('#payment-popup-modal .modal-body div.referral-code-field-wrapper #referral_code').attr('disabled', false);
        $('#payment-popup-modal .modal-body div.referral-code-field-wrapper button.btn.btn-referral-code').addClass('btn_1');
        $('#payment-popup-modal .modal-body div.referral-code-field-wrapper button.btn.btn-referral-code').removeClass('btn-danger');
        $('#payment-popup-modal .modal-body div.referral-code-field-wrapper button.btn.btn-referral-code').children().html('Gunakan Kode Referral');
        $('#payment-popup-modal .modal-body .table tr.referrer-code-wrapper .referral-code-discount-nominal').html('');
        $('#payment-popup-modal .modal-body .table tr.referrer-code-wrapper').addClass('d-none');
        appendReward();
    }

    function disableReferralCodeField() {
        $('#payment-popup-modal .modal-body div.referral-code-field-wrapper #referral_code').attr('disabled', true);
        $('#payment-popup-modal .modal-body div.referral-code-field-wrapper button.btn.btn-referral-code').addClass('btn-danger');
        $('#payment-popup-modal .modal-body div.referral-code-field-wrapper button.btn.btn-referral-code').removeClass('btn_1');
        $('#payment-popup-modal .modal-body div.referral-code-field-wrapper button.btn.btn-referral-code').children().html('Batalkan');
    }
    // End Section Referral

    // Section Promo Code
    $(document).on('keyup', '#payment-popup-modal div.promo-code-field-wrapper input#promo_code', function(e) {
        var self = $(this);
        $(this).val(self.val().toUpperCase());
    });

    $(document).on('click', '#payment-popup-modal button.btn.btn-promo-code', function (e) {
        e.preventDefault();
        $('#payment-popup-modal .error').children().html('');

        var self = $(this);
        if(self.hasClass('btn_1')) {
            var promo_code = $('#payment-popup-modal div.promo-code-field-wrapper input#promo_code').val();
            if(!promo_code) {
                $('#payment-popup-modal div.promo-code-field-wrapper span.error-promo_code').children().html('Harap memasukkan kode promo.');
                return false;
            }

            disablePromoCodeField();
            var packagePrice = getCurrentPrice();
            checkPromoCode(promo_code, packagePrice.id, packagePrice.type);
        } else {
            promo_reward_data = null;
            resetPromoCode();
        }
    });

    function checkPromoCode(promo_code, id, type) {
        var btn_container = '#payment-popup-modal button.btn.btn-promo-code';
        $(btn_container).attr('disabled', true);

        $.ajax({
            url: baseUrl + '/promo-codes/' + promo_code + '/' + id + '/' + type,
            type: 'GET',
            async: true,
            success:function(response) {
                if(response.status == 200 && response.body.is_valid == true) {
                    promo_reward_data = response.body;
                    appendReward();
                } else {
                    $('#payment-popup-modal div.promo-code-field-wrapper span.error-promo_code').children().html(response.message);
                    resetPromoCode();
                }
                $(btn_container).attr('disabled', false);
            },
            error: function(response) {
                $('#payment-popup-modal div.promo-code-field-wrapper span.error-promo_code').children().html('Kode Promo tidak ditemukan atau sudah tidak berlaku');
                resetPromoCode();
                $(btn_container).attr('disabled', false);
            }
        });
    }

    function resetPromoCode() {
        $('#payment-popup-modal .modal-body div.promo-code-field-wrapper #promo_code').val('');
        $('#payment-popup-modal .modal-body div.promo-code-field-wrapper #promo_code').attr('disabled', false);
        $('#payment-popup-modal .modal-body div.promo-code-field-wrapper button.btn.btn-promo-code').addClass('btn_1');
        $('#payment-popup-modal .modal-body div.promo-code-field-wrapper button.btn.btn-promo-code').removeClass('btn-danger');
        $('#payment-popup-modal .modal-body div.promo-code-field-wrapper button.btn.btn-promo-code').children().html('Gunakan Kode Promo');
        $('#payment-popup-modal .modal-body .table tr.promo-code-wrapper .promo-code-discount-nominal').html('');
        $('#payment-popup-modal .modal-body .table tr.promo-code-wrapper').addClass('d-none');
        appendReward();
    }

    function disablePromoCodeField() {
        $('#payment-popup-modal .modal-body div.promo-code-field-wrapper #promo_code').attr('disabled', true);
        $('#payment-popup-modal .modal-body div.promo-code-field-wrapper button.btn.btn-promo-code').addClass('btn-danger');
        $('#payment-popup-modal .modal-body div.promo-code-field-wrapper button.btn.btn-promo-code').removeClass('btn_1');
        $('#payment-popup-modal .modal-body div.promo-code-field-wrapper button.btn.btn-promo-code').children().html('Batalkan');
    }
    // End Section Promo Code


    function appendReward() {
        var packagePrice = getCurrentPrice();
        var reward = calculateReward(packagePrice.price);
        if(reward.referral_reward != 0) {
            $('#payment-popup-modal .modal-body .table tr.referrer-code-wrapper').removeClass('d-none');
            var formattedReferralReward = (reward.referral_reward).formatMoney(0, ',', '.');
            $('#payment-popup-modal .modal-body .table tr.referrer-code-wrapper .referral-code-discount-nominal').html('- ' + formattedReferralReward);
        }

        if(reward.promo_reward != 0) {
            $('#payment-popup-modal .modal-body .table tr.promo-code-wrapper').removeClass('d-none');
            var formattedPromoReward = (reward.promo_reward).formatMoney(0, ',', '.');
            $('#payment-popup-modal .modal-body .table tr.promo-code-wrapper .promo-code-discount-nominal').html('- ' + formattedPromoReward);
        }
        var formatted_grand_total = (reward.grand_total).formatMoney(0, ',', '.');
        $('#payment-popup-modal .modal-body .price.blue-text.grand-total strong').html(formatted_grand_total);
    }

    function calculateReward(price) {
        var reward = {
            'referral_reward': 0,
            'promo_reward': 0,
            'grand_total': parseInt(price)
        };

        if(promo_reward_data != null) {
            switch(promo_reward_data.type) {
                case 'Percentage':
                    var value = parseFloat(promo_reward_data.value);
                    reward.promo_reward = ((value / 100.0) * reward.grand_total);
                    reward.grand_total -= reward.promo_reward;
                    break;
                case 'Amount':
                    reward.promo_reward = parseFloat(promo_reward_data.value);
                    reward.grand_total -= reward.promo_reward;
                    break;
            }
        }

        if(referral_reward_data != null) {
            switch(referral_reward_data.type) {
                case 'Percentage':
                    var value = parseFloat(referral_reward_data.value);
                    reward.referral_reward = ((value / 100.0) * reward.grand_total);
                    reward.grand_total -= reward.referral_reward;
                    break;
                case 'Amount':
                    reward.referral_reward = parseFloat(referral_reward_data.value);
                    reward.grand_total -= reward.referral_reward;
                    break;
            }
        }

        return reward;
    }

    function getCurrentPrice() {
        var pricePackage = {
            'id': $('#payment-popup-modal .modal-body button#payment_confirm.btn-pay-now').data('bundle-id'),
            'type': 'bundle',
            'price': $('#payment-popup-modal .modal-body button#payment_confirm.btn-pay-now').data('bundle-clean-price')
        };

        if(!pricePackage.id || pricePackage.id == 0 || pricePackage.id == '') {
            pricePackage.type = 'product';
            pricePackage.id = product_id;
            pricePackage.price = product_price;
        }
        return pricePackage;
    }

    function buyNow(data, btn_container) {
        $(btn_container).attr('disabled', true);
        $('.error').children().html('');

        data['_token'] = formToken;
        data['slug'] = productSlug;
        data['type'] = product_type;
        data['bundle_id'] = $('#payment-popup-modal .modal-body button#payment_confirm.btn-pay-now').data('bundle-id');
        data['referral_code'] = '';
        data['promo_code'] = '';

        if($('#payment-popup-modal button.btn.btn-referral-code').hasClass('btn-danger')) {
            data['referral_code'] = $('#payment-popup-modal div.referral-code-field-wrapper #referral_code').val();
        }

        if($('#payment-popup-modal button.btn.btn-promo-code').hasClass('btn-danger')) {
            data['promo_code'] = $('#payment-popup-modal div.promo-code-field-wrapper #promo_code').val();
        }

        $.ajax({
            url: "{{ route('purchase.kelas') }}",
            type: 'POST',
            async:true,
            data: data,
            success:function(response) {
                if(response.status == 200) {
                    if(response.is_using_midtrans == false) {
                        location.href = "{{ route('kelas.saya') }}";
                    }else{
                        var order_number = response.data.order_number;
                        snap.pay(response.data.token, {
                            onSuccess: function(result) {
                                window.location.href = baseUrl + "/transaksi-pembayaran-berhasil/" + order_number;
                            },
                            onPending:function(result) {
                                window.location.href = baseUrl + "/menunggu-transaksi-pembayaran/" + order_number;
                            },
                            onError:function(result) {
                                window.location.href = baseUrl + '/transaksi-pembayaran-gagal/' + order_number + '?link_pembayaran=' + window.location.href;
                            },
                            onClose:function() {

                            }
                        });
                    }
                } else if(response.status == 401) {
                    location.href="{{ route('masuk') }}" + '?previous_url=' + window.location.href;
                } else {
                    showErrorMessage(response.message);
                }
                $('#payment-popup-modal').modal('hide');
                $(btn_container).attr('disabled', false);
            },
            error:function(response) {
                if(response.status == 422) {
                    if(data.type == 'free') {
                        showErrorMessage('Maaf, saat ini kami sedang kesulitan memproses data anda.');
                    } else {
                        $.each(response.responseJSON, function(key, val) {
                            $('#payment-popup-modal .error.error-'+key).children().html(val[0]);
                        });
                    }
                } else {
                    showErrorMessage('Maaf, silakan mencoba beberapa saat lagi.');
                }
                $(btn_container).attr('disabled', false);
            }
        });
    }

    function initModalPurchase(productTitle, price, learningMethod, modalProviders) {
        $('#payment-popup-modal .error').children().html('');
        referral_reward_data = promo_reward_data = null;
        if (learningMethod == '' && modalProviders == '') {
            $('#payment-popup-modal .modal-body .table span.confirm_partner span img.bullet-sub-title').addClass('d-none');
        }else {
            $('#payment-popup-modal .modal-body button#payment_confirm.btn-pay-now').data('bundle-id', '0');
            $('#payment-popup-modal .modal-body button#payment_confirm.btn-pay-now').data('bundle-clean-price', '0');
            $('#payment-popup-modal .modal-body .table span.confirm_partner span img.bullet-sub-title').removeClass('d-none');
        }

        resetReferralCode();
        resetPromoCode();
        $('#payment-popup-modal .modal-body .title').html(productTitle);
        $('#payment-popup-modal .modal-body .price.blue-text.product-price').html(price);
        $('#payment-popup-modal .modal-body .price.blue-text.grand-total strong').html(price);
        $('#payment-popup-modal .modal-body .confirm_partner .learning-method').html(learningMethod);
        $('#payment-popup-modal .modal-body .confirm_partner span.provider').html(modalProviders);
        $('#payment-popup-modal').modal('show');
    }


    // Carousel
    $('.bundle-package-wrapper').owlCarousel({
        items: 2,
        margin: 0,
        responsive: {
            0: {
                items: 1
            },
            767: {
                items: 2
            },
            1000: {
                items: 3
            },
            1400: {
                items: 4
            }
        }
    });
    // End Carousel
});
</script>
@endpush