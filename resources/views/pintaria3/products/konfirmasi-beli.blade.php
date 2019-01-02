@extends('layouts.pintaria3.tryout.master')

@section('title') {{ !empty($product->seo_title) ? $product->seo_title : 'Pintaria - Portal Edukasi Indonesia' }} @endsection

@section('meta_description') {{ !empty($product->meta_description) ? $product->meta_description : '' }} @endsection

@push('additional.style')
<style>
input[type=number] {
    -moz-appearance: textfield;
}
input[type=number]::-webkit-inner-spin-button, 
input[type=number]::-webkit-outer-spin-button { 
    -webkit-appearance: none; 
    margin: 0; 
}
</style>
@endpush

@section('content')
    <div class="payment">
        <header>
            <div class="container">
                <a href="{{ route('home') }}">
                    <img src="{{ asset_cdn('pintaria/Logo-Pintaria.png') }}" class="img-responsive img-200"/>
                </a>
            </div>
        </header>

        <div class="main-content">
            <div class="container">
                <div class="step row confirm center">
                    <div id="purchase-form-tab" class="active buying">
                        <a>Konfirmasi Pembelian</a>
                    </div>
                    <div class="separator"></div>
                    <div id="payment-form-tab" class="paying">
                        <a>Pembayaran</a>
                    </div>
                </div>
                <div id="purchase-form" class="item-container">
                    @if(!empty($bundle))
                        <h3>
                            {{ $bundle->name }}<br/>
                        </h3>
                        <div class="item">
                            <p class="price" data-price="{{$product->price}}">{{ empty($bundle) ? $product->formatted_price : $bundle->bundle_formatted_price }}</p>
                        </div>
                    @else
                        <div class="item">
                            <img src="{{ asset_cdn($product->image) }}">
                            <h3>
                                {{ $product->product_name }}<br/>
                                <span>{{ $product->learning_method_name }}</span>
                                <span>{{ $product->provider_list }}</span>
                            </h3>
                            <p class="price" data-price="{{$product->price}}">{{ $product->formatted_price }}</p>
                        </div>
                    @endif
                    @if($product->is_discount)
                        <p class="pay">
                            <span>Diskon Produk</span>{{ empty($bundle) && $product->is_discount ? $product->formatted_nominal_discount : 0 }}
                        </p>
                    @endif
                    <p class="pay referrer-code-wrapper d-none"><span>Diskon Kode Referral</span><span
                                class="nominal referral-code-discount-nominal">0</span></p>
                    <p class="pay promo-code-wrapper d-none"><span>Diskon Kode Promo</span><span
                                class="nominal promo-code-discount-nominal">0</span></p>
                    <p class="pay grand-total"><span>Total</span>
                        <span class="grand-total-price">
                            @if(empty($bundle))
                                {{ $product->is_discount ? $product->formatted_price_after_discount : $product->formatted_price }}
                            @else
                                {{ $bundle->bundle_formatted_price }}
                            @endif
                        </span>
                    </p>
                    <div class="user-data">
                        <form id="user-form">

                            <input type="hidden" class="input_field" value="{{ $user->id }}" name="user_id">
                            <input type="hidden" class="input_field" value="{{ $product->id }}" name="product_id">
                            <span class="input input--filled">
                                <input type="text" class="input_field user_name" value="{{ $user->name }}" readonly="">
                                <label class="input_label">
                                    <span class="input__label-content">Nama</span>
                                </label>
                            </span>
                            <span class="input input--filled">
                                <input type="text" class="input_field user_email" value="{{ $user->email }}" readonly="">
                                <label class="input_label">
                                    <span class="input__label-content">Email</span>
                                </label>
                            </span>
                            <span class="input" id="phone-confirm-field">
                                <input type="text" class="input_field user_phone" id="phone-confirm">
                                <label class="input_label">
                                    <span class="input__label-content">No. Ponsel</span>
                                </label>
                                <span class="text-danger error error-phone_number">
                                    <small></small>
                                </span>
                            </span>
                            
                            <span class="with-btn">
                                <span class="input w-50-m">
                                    <input type="text" class="input_field" name="promo_code" id="promo_code">
                                    <label class="input_label">
                                        <span class="input__label-content">Kode Promo</span>
                                    </label>
                                </span>
                                <button class="btn btn_1 btn-block btn-promo-code confirm-code-btn">
                                    <small>Gunakan Kode Promo</small>
                                </button>
                                <button class="btn btn_1 btn-block btn-promo-code confirm-code-btn-m">
                                    <small>Gunakan</small>
                                </button>
                            </span>
                            <span class="input text-danger error error-promo_code">
                                <small></small>
                            </span>
                            <span class="with-btn">
                                <span class="input w-50-m">
                                    <input type="text" class="input_field" name="referral_code" id="referral_code">
                                    <label class="input_label">
                                        <span class="input__label-content">Kode Referral</span>
                                    </label>
                                </span>
                                <button class="btn btn_1 btn-block btn-referral-code confirm-code-btn">
                                    <small>Gunakan Kode Referral</small>
                                </button>
                                <button class="btn btn_1 btn-block btn-referral-code confirm-code-btn-m">
                                    <small>Gunakan</small>
                                </button>
                            </span>
                            <span class="input text-danger error error-referral_code">
                                <small></small>
                            </span>
                            @if ($product->learning_method_id == 2)
                            <span class="input input--filled">
                                <input type="number" class="input_field quantity_participant" value="1" min="1" disabled>
                                <div class="float-right"  style="margin-top:35px;margin-left:-10px; width:59px;">
                                    <a href="#" class="quantity_decrement"><i class="fa fa-minus" aria-hidden="true"></i></a>
                                    <a href="#" class="quantity_increment"><i class="fa fa-plus" aria-hidden="true"></i></a>
                                </div>
                                <label class="input_label">
                                    <span class="input__label-content">Jumlah</span>
                                </label>
                            </span>

                            <div class="participant">
                                <div class="sub_participant">

                                    <span class="input input--filled">
                                        <input type="text" class="input_field participant-1" value="{{ $user->name }}" name="peserta[name][]">
                                        <label class="input_label">
                                            <span class="input__label-content">Nama Peserta 1</span>
                                        </label>
                                        <span class="text-danger error error-peserta">
                                            <small></small>
                                        </span>
                                    </span>
                                    <span class="input input--filled">
                                        <input type="text" class="input_field participant-1" value="{{ $user->email }}" name="peserta[email][]">
                                        <label class="input_label">
                                            <span class="input__label-content">Email Peserta 1</span>
                                        </label>
                                        <span class="text-danger error error-peserta">
                                            <small></small>
                                        </span>
                                    </span>
                                    <span class="input">
                                        <input type="text" class="input_field participant-1" value="" name="peserta[phone][]">
                                        <label class="input_label">
                                            <span class="input__label-content">No. Ponsel Peserta 1</span>
                                        </label>
                                        <span class="text-danger error error-peserta">
                                            <small></small>
                                        </span>
                                    </span>

                                    <span class="input input--filled">
                                        <input type="text" class="input_field participant-1" value="" name="peserta[company][]">
                                        <label class="input_label">
                                            <span class="input__label-content">Perusahaan Peserta 1 </span>
                                        </label>
                                        <span class="text-danger error error-peserta">
                                            <small></small>
                                        </span>
                                    </span>
                                </div>
                            </div>

                            @endif
                            <button id="payment_confirm" class="btn btn_1 btn-block btn-buy-now"
                                    data-bundle-id="{{ !empty($bundle) ? $bundle->id : 0 }}"
                                    data-bundle-clean-price="{{ !empty($bundle) ? $bundle->price : 0 }}">
                                Bayar
                            </button>
                            <p class="note text-center">
                                Dengan menekan tombol "Bayar", saya mengkonfirmasi telah menyetujui <a href="#" target="_blank"><strong>Perjanjian Pengguna</strong></a> Pintaria. Pembayaran akan ditujukan ke rekening PT Haruka Evolusi Digital Utama, badan hukum dari Pintaria.<br/>
                                <i class="fa fa-lock" aria-hidden="true"></i> Secure Connection
                            </p>
                        </form>
                    </div>
                    <a id="previous_page_buy_confirmation" href='{{ route("product.index", ['slug' => !empty($product) ? $product->slug : '' ]) }}' class="link font-14"><i class="fa fa-angle-left"></i>&nbsp;&nbsp;Kembali
                        ke Halaman Sebelumnya</a>
                </div>
                <div id="payment-form" class="item-container" style="display:none">
                    <h2>pilih metode pembayaran</h2>
                    <div class="user-data">
                        <ul class="payment-method">
                            <li>
                                <input type="radio" name="payment-method" id="midtrans" value="midtrans" checked>
                                <label for="midtrans">
                                    Transfer, Transfer Virtual Account, Kartu Visa / Mastercard, Mandiri Clickpay, CIMB
                                    Clicks
                                    <img src="{{ url('pintaria/img/shared/midTrans.jpg') }}">
                                </label>
                            </li>
                            <li>
                                <input type="radio" name="payment-method" id="akulaku" value="akulaku">
                                <label for="akulaku">
                                    Cicilan tanpa kartu kredit
                                    <img src="{{ url('pintaria/img/shared/akulaku.png') }}">
                                </label>
                                <span class="note">
                            Anda akan diarahkan ke Checkout Akulaku. Layanan Akulaku hanya berlaku bagi pemilik akun Akulaku yang sudah teraktivasi. Informasi lebih lanjut terkait Akulaku dapat menghubungi Call Center Akulaku di 1500621 (English and Bahasa)
                        </span>
                            </li>
                        </ul>
                        <span class="text-danger error error-testing">
                                <small></small>
                            </span>
                        <h3>Ringkasan Belanja</h3>
                        <p class="pay base-price"><span>{{  !empty($bundle) ?  $bundle->name : $product->product_name }}</span>
                            @if(empty($bundle))
                                {{ $product->formatted_price }}
                            @else
                                {{ $bundle->bundle_formatted_price }}
                            @endif
                        </p>
                        <p class="pay">
                            <span>Diskon</span>{{ empty($bundle) && $product->is_discount ? $product->formatted_nominal_discount : 0 }}
                        </p>

                        @if ($product->learning_method_id == 2)
                        <p class="pay quantity_pay">
                            
                        <p>
                        
                        @endif
                        <p class="pay promo-code-wrapper d-none"><span>Diskon Promo</span><span
                                    class="nominal promo-code-discount-nominal">0</span></p>
                        <p class="pay referrer-code-wrapper d-none"><span>Diskon Referral</span><span
                                    class="nominal referral-code-discount-nominal">0</span></p>
                        <p class="pay participant-discount-wrapper d-none"><span>Diskon Peserta</span><span
                                    class="nominal participant-discount-nominal">0</span></p>
                        <p class="pay total grand-total"><span>Total</span>
                            <span class="grand-total-price">
                                @if(empty($bundle))
                                    {{ $product->is_discount ? $product->formatted_price_after_discount : $product->formatted_price }}
                                @else
                                    {{ $bundle->bundle_formatted_price }}
                                @endif
                            </span>
                        </p>
                        <button id="payment_confirm" class="btn btn_1 btn-block btn-pay-now" data-bundle-id="0"
                                data-bundle-clean-price="0">
                            Bayar
                        </button>
                    </div>
                    <a id="back-buy-confirmation" href="" class="link font-14"><i class="fa fa-angle-left"></i>&nbsp;&nbsp;Kembali
                        ke Konfirmasi
                        Pembelian</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('additional.script')
    @if(env('APP_DEBUG') == false)
        <script src="https://app.midtrans.com/snap/snap.js" type="text/javascript"
                data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
    @else
        <script src="https://app.sandbox.midtrans.com/snap/snap.js" type="text/javascript"
                data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
    @endif

    <script type="text/javascript">
        $(document).ready(function () {
            var product_type = "{{ $product->type }}";
            var bundle = "{{ Request::get('paket') }}";
            var providers = "{{ $product->providers ? $product->provider_list : '' }}";
            var product_id = "{{ $product->id }}";
            var referral_reward_data = null;
            var promo_reward_data = null;
            var participant_discount_data = null;
            var productSlug = "{{ $product->slug }}";

            if ($('.quantity_participant').length) {
                updateForm();
            }

            function showKonfirmasiPembelian() {
                $('#purchase-form-tab').addClass('active');
                $('#payment-form-tab').removeClass('active');
                $('#payment-form').hide();
                $('#purchase-form').show();
            }

            function showKonfirmasiPembayaran() {
                $('#purchase-form-tab').removeClass('active');
                $('#payment-form-tab').addClass('active');
                $('#payment-form').show();
                $('#purchase-form').hide();
            }

            function updateUserParticipant(){
                $.ajax({
                    url: baseUrl + '/save-participant',
                    type: 'POST',
                    async: true,
                    data: $("#user-form input").serialize()
                });
                return true;
            }

            function checkParticipantDiscount() {
                $.ajax({
                    url: baseUrl + '/participant-discount',
                    type: 'POST',
                    async: true,
                    data: $('#user-form input').serialize(),
                    success: function (res) {
                        if (res.status == 200 && res.body) {
                            participant_discount_data = res.body;
                            appendParticipantDiscount();
                        } else {
                            resetParticipantDiscount();
                        }
                    }
                });
                return true;
            }


            $(document).on('click', '.btn-buy-now', function (e) {
                e.preventDefault();
                $('.error').children().html('');

                var phone = $('input#phone-confirm').val();
                var validation = /^\d+$/;

                $hasEmpty = false;
                $('input[name^="peserta"]').each(function(i, val) {
                    $attr_name = $(this).attr('name');
                    if (!$(this).val()) {
                        $hasEmpty = true;
                        $(this).parent().find('.error-peserta').children().html('Mohon diisi');
                    } else if(!new RegExp(validation).test($(this).val()) && ($attr_name == 'peserta[phone][]')) {
                        $(this).parent().find('.error-peserta').children().html('Format No. Ponsel tidak sesuai.');
                    } else if (!validateEmail($(this).val()) && ($attr_name == 'peserta[email][]')) {
                        $(this).parent().find('.error-peserta').children().html('Format Email tidak sesuai');
                    }
                });

                if (!phone) {
                    $('span.error-phone_number').children().html('Harap memasukkan No. Ponsel.');
                    return false;
                } else if(!new RegExp(validation).test(phone)) {
                    $('span.error-phone_number').children().html('Format No. Ponsel tidak sesuai.');
                    return false;
                }else if ($hasEmpty)
                    return false;
                else {
                    checkParticipantDiscount();
                    showKonfirmasiPembayaran();
                    updateUserParticipant();
                }
            });

            $(document).on('click', '#back-buy-confirmation', function (e) {
                e.preventDefault();
                showKonfirmasiPembelian();
            });

            $(document).on('click', '.quantity_increment', function(e){
                e.preventDefault();
                $quantity = parseInt($('.quantity_participant').val()) + 1;
                $('.quantity_participant').val($quantity);
                updateForm();
            });

            $(document).on('click', '.quantity_decrement', function(e){
                e.preventDefault();
                $quantity = ($quantity <= 1) ? 1 : parseInt($('.quantity_participant').val()) - 1;
                $('.quantity_participant').val($quantity);
                updateForm();
            });

            $(document).on('click', '.btn-pay-now', function (e) {
                e.preventDefault();
                $('.error').children().html('');

                tracker('product', product_id);

                if (product_type === 'free') {
                    buyNow({}, '.btn-buy-now');
                }
            });

            $(document).on('click', '#payment-form .btn-pay-now', function (e) {
                e.preventDefault();
                var data = {};
                data['phone_number'] = $('#phone-confirm-field #phone-confirm').val();
                buyNow(data, '#payment-form .btn-pay-now');
            });

            // Section Referral
            $(document).on('keyup', 'input#referral_code', function (e) {
                var self = $(this);
                $(this).val(self.val().toUpperCase());
            });

            $(document).on('click', 'button.btn.btn-referral-code', function (e) {
                e.preventDefault();
                $('.error').children().html('');

                var self = $(this);
                if (self.hasClass('btn_1')) {
                    var referral_code = $('input#referral_code').val();
                    if (!referral_code) {
                        $('span.error-referral_code').children().html('Harap memasukkan kode referral.');
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
                var btn_container = 'button.btn.btn-referral-code';
                $(btn_container).attr('disabled', true);

                $.ajax({
                    url: baseUrl + '/referral-codes/' + referral_code + '/' + id + '/' + type,
                    type: 'GET',
                    async: true,
                    success: function (response) {
                        if (response.status === 200 && response.body.is_valid === true) {
                            referral_reward_data = response.body;
                            appendReward();
                        } else {
                            $('span.error-referral_code').children().html(response.message);
                            resetReferralCode();
                        }
                        $(btn_container).attr('disabled', false);
                    },
                    error: function (response) {
                        $('span.error-referral_code').children().html('Kode Referral tidak ditemukan atau sudah tidak berlaku.');
                        resetReferralCode();
                        $(btn_container).attr('disabled', false);
                    }
                });
            }

            function resetReferralCode() {
                $('#referral_code').val('');
                $('#referral_code').attr('disabled', false);
                $('button.btn.btn-referral-code').addClass('btn_1');
                $('button.btn.btn-referral-code').removeClass('btn-danger');
                $('button.btn.btn-referral-code.confirm-code-btn').children().html('Gunakan Kode Referral');
                $('button.btn.btn-referral-code.confirm-code-btn-m').children().html('Gunakan');
                $('p.referrer-code-wrapper .referral-code-discount-nominal').html('');
                $('p.referrer-code-wrapper').addClass('d-none');
                appendReward();
            }

            function disableReferralCodeField() {
                $('#referral_code').attr('disabled', true);
                $('button.btn.btn-referral-code').addClass('btn-danger');
                $('button.btn.btn-referral-code').removeClass('btn_1');
                $('button.btn.btn-referral-code').children().html('Batalkan');
            }
            function validateEmail(email) {
                var re = /^[a-zA-Z0-9\-_]+(\.[a-zA-Z0-9\-_]+)*@[a-z0-9]+(\-[a-z0-9]+)*(\.[a-z0-9]+(\-[a-z0-9]+)*)*\.[a-z]{2,4}$/;
                return re.test(email);
            }

            // End Section Referral

            // Section Promo Code
            $(document).on('keyup', 'input#promo_code', function (e) {
                var self = $(this);
                $(this).val(self.val().toUpperCase());
            });

            $(document).on('click', '.btn-promo-code', function (e) {
                e.preventDefault();
                $('.error').children().html('');

                var self = $(this);
                if (self.hasClass('btn_1')) {
                    var promo_code = $('input#promo_code').val();
                    if (!promo_code) {
                        $('span.error-promo_code').children().html('Harap memasukkan kode promo.');
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

            $('.quantity_participant').on('keyup', function(e) {
                updateForm();
            });

            function updateForm(){
                $quantity = $('.quantity_participant').val() ? $('.quantity_participant').val() : 1;
                var packagePrice = getCurrentPrice();
                var reward = calculateReward(packagePrice.price);
                var $price = reward.grand_total;
                $('.price,.grand-total-price').text(calculateTotal($price, $quantity, true)).attr('data-price', calculateTotal($price, $quantity, false));
                var participant_form = "";
                for (i = 1; i <= $quantity; i++) { 
                    $template = $('#participate_template').html().replace(/loop_number/g,i);
                    if (i == 1) {
                        $name = $('.user_name').val();
                        $email = $('.user_email').val();
                        $phone = $('.user_phone').val();
                    } else {
                        $name = $('.participant .participant-' + i + '[name*=name]').val();
                        $email = $('.participant .participant-' + i + '[name*=email]').val();
                        $phone = $('.participant .participant-' + i + '[name*=phone]').val();
                    }
                    $company = $('.participant .participant-' + i + '[name*=company]').val();

                    $template = $template.replace('user_name_value', $name ? $name : '');
                    $template = $template.replace('user_email_value', $email ? $email : '');
                    $template = $template.replace('user_phone_value', $phone ? $phone : '');
                    $template = $template.replace('user_company_value', $company ? $company : '');
                    participant_form += $template;
                }
                $('.participant').html(participant_form);
                $('.quantity_pay').text("").html("<span>Jumlah</span>" + $quantity);
                $('#payment-form .pay.base-price').html(
                    "<span>{{  !empty($bundle) ?  $bundle->name : $product->product_name }}</span>" +
                    calculateTotal($price, $quantity, true)
                );
            }

            function calculateTotal($price, $quantity, $format = true){
                $total = $price * $quantity;
                if ($format) {
                    return 'Rp.'+formatMoney($total, "", ".",".");
                } else {
                    return $total;
                }
                
            }

            function formatMoney(n, c, d, t) {
                var c = isNaN(c = Math.abs(c)) ? 2 : c,
                    d = d == undefined ? "." : d,
                    t = t == undefined ? "," : t,
                    s = n < 0 ? "-" : "",
                    i = String(parseInt(n = Math.abs(Number(n) || 0).toFixed(c))),
                    j = (j = i.length) > 3 ? j % 3 : 0;

                return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
            };

            function checkPromoCode(promo_code, id, type) {
                var btn_container = 'button.btn.btn-promo-code';
                $(btn_container).attr('disabled', true);

                $.ajax({
                    url: baseUrl + '/promo-codes/' + promo_code + '/' + id + '/' + type,
                    type: 'GET',
                    async: true,
                    success: function (response) {
                        if (response.status === 200 && response.body.is_valid === true) {
                            promo_reward_data = response.body;
                            appendReward();
                        } else {
                            $('span.error-promo_code').children().html(response.message);
                            resetPromoCode();
                        }
                        $(btn_container).attr('disabled', false);
                    },
                    error: function (response) {
                        $('span.error-promo_code').children().html('Kode Promo tidak ditemukan atau sudah tidak berlaku');
                        resetPromoCode();
                        $(btn_container).attr('disabled', false);
                    }
                });
            }

            function resetPromoCode() {
                $('#promo_code').val('');
                $('#promo_code').attr('disabled', false);
                $('button.btn.btn-promo-code').addClass('btn_1');
                $('button.btn.btn-promo-code').removeClass('btn-danger');
                $('button.btn.btn-promo-code.confirm-code-btn').children().html('Gunakan Kode Promo');
                $('button.btn.btn-promo-code.confirm-code-btn-m').children().html('Gunakan');
                $('p.referrer-code-wrapper .promo-code-discount-nominal').html('');
                $('p.promo-code-wrapper').addClass('d-none');
                appendReward();
            }

            function disablePromoCodeField() {
                $('#promo_code').attr('disabled', true);
                $('button.btn.btn-promo-code').addClass('btn-danger');
                $('button.btn.btn-promo-code').removeClass('btn_1');
                $('button.btn.btn-promo-code').children().html('Batalkan');
            }

            // End Section Promo Code

            function appendParticipantDiscount() {
                $('p.participant-discount-wrapper').removeClass('d-none');
                $('p.participant-discount-wrapper .participant-discount-nominal').html(participant_discount_data.formatted_nominal_discount);
                $('.grand-total .grand-total-price').html(participant_discount_data.formatted_price_after_discount);
            }

            function resetParticipantDiscount() {
                $('p.participant-discount-wrapper').addClass('d-none');
                $('.grand-total .grand-total-price').html("{{ $product->is_discount ? $product->formatted_price_after_discount : $product->formatted_price }}");
                updateForm();
            }

            function appendReward() {
                var packagePrice = getCurrentPrice();
                var reward = calculateReward(packagePrice.price);

                if (reward.promo_reward !== 0) {
                    $('p.promo-code-wrapper').removeClass('d-none');
                    var formattedPromoReward = (reward.promo_reward).formatMoney(0, ',', '.');
                    $('p.promo-code-wrapper .promo-code-discount-nominal').html('- ' + formattedPromoReward);
                }

                if (reward.referral_reward !== 0) {
                    $('p.referrer-code-wrapper').removeClass('d-none');
                    var formattedReferralReward = (reward.referral_reward).formatMoney(0, ',', '.');
                    $('.referral-code-discount-nominal').html('- ' + formattedReferralReward);
                }

                var formatted_grand_total = (reward.grand_total).formatMoney(0, ',', '.');
                $('.grand-total .grand-total-price').html(formatted_grand_total);
            }

            function calculateReward(price) {
                var reward = {
                    'referral_reward': 0,
                    'promo_reward': 0,
                    'grand_total': parseInt(price)
                };

                if (promo_reward_data !== null) {
                    switch (promo_reward_data.type) {
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

                if (referral_reward_data !== null) {
                    switch (referral_reward_data.type) {
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
                    'id': $('button#payment_confirm.btn-buy-now').data('bundle-id'),
                    'type': 'bundle',
                    'price': $('button#payment_confirm.btn-buy-now').data('bundle-clean-price')
                };

                if (!pricePackage.id || pricePackage.id === 0 || pricePackage.id === '') {
                    pricePackage.type = 'product';
                    pricePackage.id = '{{ $product->id }}';
                    pricePackage.price = '{{ $product->is_discount ? $product->price_after_discount : $product->price }}';
                }
                return pricePackage;
            }

            function buyNow(data, btn_container) {
                $('.error').children().html('');
                $('button#payment_confirm.btn-pay-now').prop('disabled', true);

                data['_token'] = $("input[name=_token]").val();
                data['slug'] = productSlug;
                data['type'] = product_type;
                data['bundle_id'] = $('button#payment_confirm.btn-buy-now').data('bundle-id');
                data['referral_code'] = '';
                data['promo_code'] = '';
                data['payment_method'] = $('input[name="payment-method"]:checked').val();
                data['quantity'] = $('.quantity_participant').val();
                if ($('button.btn.btn-referral-code').hasClass('btn-danger')) {
                    data['referral_code'] = $('#referral_code').val();
                }

                if ($('button.btn.btn-promo-code').hasClass('btn-danger')) {
                    data['promo_code'] = $('#promo_code').val();
                }

                if (data['bundle_id'] !== 0) {
                    var object_id = data['bundle_id'];
                    var object_name = 'click_payment_bundle';
                } else {
                    var object_id = product_id;
                    var object_name = 'click_payment_product';
                }

                // Participant data
                data['participants'] = $('#user-form .participant input').serialize();

                tracker(object_name, object_id);
                $.ajax({
                    url: "{{ route('purchase.kelas') }}",
                    type: 'POST',
                    async: true,
                    data: data,
                    success: function (response) {
                        $('button#payment_confirm.btn-pay-now').prop('disabled', false);

                        if (response.status === 200) {
                            if (response.is_using_midtrans === false) {
                                location.href = "{{ route('kelas.saya') }}";
                            } else {
                                var order_number = response.data.order_number;
                                if (response.data.payment_method === "midtrans") {
                                    snap.pay(response.data.token, {
                                        onSuccess: function (result) {
                                            window.location.href = baseUrl + "/transaksi-pembayaran-berhasil/" + order_number;
                                        },
                                        onPending: function (result) {
                                            window.location.href = baseUrl + "/menunggu-transaksi-pembayaran/" + order_number;
                                        },
                                        onError: function (result) {
                                            window.location.href = baseUrl + '/transaksi-pembayaran-gagal/' + order_number + '?link_pembayaran=' + window.location.href;
                                        },
                                        onClose: function () {

                                        }
                                    });
                                } else {
                                    window.location.href = response.data.redirect_url;
                                }
                            }
                        } else if (response.status === 401) {
                            location.href = "{{ route('masuk') }}" + '?previous_url=' + window.location.href;
                        } else {
                            showErrorMessage(response.message);
                        }
                        $(btn_container).attr('disabled', false);
                    },
                    error: function (response) {
                        $('button#payment_confirm.btn-pay-now').prop('disabled', false);

                        if (response.status === 422) {
                            if (data.type === 'free') {
                                showErrorMessage('Maaf, saat ini kami sedang kesulitan memproses data anda.');
                            } else {
                                showKonfirmasiPembelian();
                                $.each(response.responseJSON, function (key, val) {
                                    $('span.error-' + key).children().html(val[0]);
                                });
                            }
                        } else {
                            showErrorMessage('Maaf, silakan mencoba beberapa saat lagi.');
                        }
                        $(btn_container).attr('disabled', false);
                    }
                });
            }
        });
    </script>

    <script id="participate_template" type="text/html">
        <div class="sub_participant">
            <span class="input input--filled">
                <input type="text" class="input_field participant-loop_number" name="peserta[name][]" value="user_name_value" >
                <label class="input_label">
                    <span class="input__label-content">Nama Peserta loop_number</span>
                </label>
                <span class="text-danger error error-peserta">
                    <small></small>
                </span>
            </span>
            <span class="input input--filled">
                <input type="text" class="input_field participant-loop_number" name="peserta[email][]" value="user_email_value" >
                <label class="input_label">
                    <span class="input__label-content">Email Peserta loop_number</span>
                </label>
                <span class="text-danger error error-peserta">
                    <small></small>
                </span>
            </span>
            <span class="input input--filled">
                <input type="text" class="input_field participant-loop_number" name="peserta[phone][]" value="user_phone_value" >
                <label class="input_label">
                    <span class="input__label-content">No. Ponsel Peserta loop_number</span>
                </label>
                <span class="text-danger error error-peserta">
                    <small></small>
                </span>
            </span>
            <span class="input input--filled">
                <input type="text" class="input_field participant-loop_number" name="peserta[company][]" value="user_company_value">
                <label class="input_label">
                    <span class="input__label-content">Perusahaan Peserta loop_number </span>
                </label>
                <span class="text-danger error error-peserta">
                    <small></small>
                </span>
            </span>
        </div>
    </script>
@endpush
