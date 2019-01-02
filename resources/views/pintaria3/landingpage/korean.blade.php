@extends('layouts.pintaria3.tryout.master')

@section('title')
Promo Kursus Online Bahasa Korea DISKON 50% | Pintaria @endsection

@section('meta_description')
@endsection

@push('additional.style')
<style type="text/css">
.top-banner {
  background: url("{{asset_cdn('pintaria/landing-pages/korean/Main-Image-Desktop.jpg')}}") center center no-repeat;
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
  height: 640px;
  position: relative;
}
.bottom-banner {
    background: url("{{asset_cdn('pintaria/landing-pages/korean/BG-grafis-pada-Section-CTA.png')}}") left no-repeat #efefef;
}
@media(max-width: 768px) {
    .top-banner {
        background: url("{{asset_cdn('pintaria/landing-pages/korean/Main-Image-Mobile.jpg')}}") center center no-repeat #0c0d12;
        height: 600px;
        background-size: cover;
    }
}
</style>
@endpush

@section('content')
<section class="top-banner korean">
    <h1 class="logo"><a href="/"><img src="{{ asset_cdn('pintaria/Logo-Pintaria.png') }}" alt="Pintaria" width="149" data-retina="true" alt="" class="blue_logo"></a></h1>
    <div class="banner-text">
        <p>
            Nonton drama Korea <br> tanpa subtitle lagi. <br> Mau?
        </p>
    </div>
</section>
<section class="korean">
    <div class="container w-960">
        <div class="row">
            <div class="col-md-12">
                <h2 class="center font25">Mengapa penting mengikuti program ini :</h2>
                <div class="feature-korean">
                    <figure class="feature-lady-m">
                        <img class="img-fluid" src="{{asset_cdn('pintaria/landing-pages/korean/korean-lady-2.png')}}">
                    </figure>
                    <div class="desc">
                        <div class="desc-box">
                            Korea terkenal dengan perkembangan industrinya. 
                            Kalau kamu ingin mencoba bekerja di salah satu perusahaan Korea,
                            ada baiknya kamu menguasai bahasa Korea
                        </div>
                        <div class="desc-box">
                            Tidak hanya belajar bahasanya, kamu juga akan belajar kebudayaan Korea
                        </div>
                        <div class="desc-box">
                            Pengajar asli dari Korea
                        </div>
                        <div class="desc-box">
                            Jadwal belajar fleksibel
                        </div>
                    </div>
                    <div class="col-md-5">
                        <figure class="feature-lady-d">
                            <img class="img-fluid" src="{{asset_cdn('pintaria/landing-pages/korean/korean-lady-2.png')}}">
                        </figure>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="korean">
    <div class="container w-720">
        <div class="row">
            <div class="col-md-12">
                <h2 class="center font25">Apa saja yang akan kamu pelajari pada program ini?</h2>
                <ul>
                    <li>Mendengarkan, berbicara, membaca, dan menulis bahasa Korea dasar</li>
                    <li>Mempelajari kebudayaan Korea yang paling umum</li>
                </ul>
            </div>
        </div>
    </div>
</section>
<section id="beli-sekarang" class="korean">
    <div class="container w-960">
        <div class="row">
            <div class="col-md-12 center">
                <h2 class="font25">KOREAN BASIC 1</h2>
                <div class="beli-box">
                    @if($product->is_discount)
                        <span class="harga-coret">{{ $product->formatted_price }}</span>
                        <span class="harga">{{ $product->formatted_price_after_discount }}</span>
                    @else
                        <span class="harga">{{ $product->formatted_price }}</span>
                    @endif
                    <a href="{{ route('product.konfirmasi.beli', ['slug' => $product->slug]) }}" class="beli-btn full-width add_top_30 add_bottom_30">Beli sekarang!</a>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="testimony" class="korean">
    <div class="container w-960">
        <h2 class="center font25">Testimony Student</h2>
        <div class="testimony-area">
            <div class="row">
                <div class="col-md-6 testimony-box">
                    <div class="reviewer">
                        <img class="img-fluid" src="{{asset_cdn('pintaria/landing-pages/korean/Testimoni-Zainal.png')}}">
                        <div class="name-area">
                            <span class="name">Zaenal</span>
                            <span class="info">Student Korean Basic 1</span>
                        </div>
                    </div>
                    <div class="review-content">
                        "Untuk sejauh ini  sangat senang mengikuti proses kursus. B. Korea. 
                        Sangat fun saat live call bersama pengajarnya yg humble dan paham b.indonesia juga. 
                        Recommended bgt lah pintaria buat yang ingin tambah ilmu.thanks Pintaria."
                    </div>
                </div>
                <div class="col-md-6 testimony-box">
                    <div class="reviewer">
                        <img class="img-fluid" src="{{asset_cdn('pintaria/landing-pages/korean/Testimoni-Lenny.png')}}">
                        <div class="name-area">
                            <span class="name">Lenny Hutajulu</span>
                            <span class="info">Student Korean Basic 1</span>
                        </div>
                    </div>
                    <div class="review-content">
                        "Buat pemula seperti saya senang deh belajar bahasa korea disini materinya bisa diulang2,
                        ada pembelajaran vidionya juga bisa diakses kapanpun dimanapun, apalagi bisa berinteraksi 
                        dengan pengajar dan teman2 yang lain di live sesion jadi semakin mengerti pembelajaran sebelumnya.
                        belajar bahasa korea online seru juga :)"
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--section id="seo" class="korean no-border">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <p class="center font16">
                    Pintaria adalah sebuah situs yang menawarkan produk-produk pendidikan dan pelatihan / kursus yang berkualitas dengan berbagai macam kategori yang ditujukan untuk masyarakat yang ingin meningkatkan pengetahuan dan keahlian.
                    <br/><br/>
                    Kursus online atau kelas online Bahasa Korea di Pintaria. Kamu akan belajar bahasa Korea, tulisan Korea, huruf Korea dan kebudayaan Korea. Cara belajar yang dengan efektif dan efisien untuk membantu kamu lebih mudah mengerti kosakata bahasa Korea. Dapatkan harga spesial di Pintaria selama promo.
                </p>
            </div>
        </div>
    </div>
</section-->
<footer class="korean">
    <img class="img-fluid logo" src="{{ asset_cdn('pintaria/Logo-Pintaria.png') }}">
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

        var current_url = window.location.pathname + '?beli=1';
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

});
</script>
@endpush
