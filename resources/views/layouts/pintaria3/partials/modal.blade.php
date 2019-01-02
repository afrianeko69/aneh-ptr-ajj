<div id="payment-popup-modal" class="modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Konfirmasi Pembayaran</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row px-2 pt-3">
                    <table class="table">
                        <tbody>
                            <tr class="grey lighten-3">
                                <td>
                                    <span class="title">Mencari Kerja</span><br>
                                    <span class="confirm_partner">
                                        <span class="learning-method">E-learning</span>
                                        <span><img class="bullet-sub-title" src="{{url('pintaria/img/shared/bullet.png')}}"> <span class="provider">HarukaEDU</span></span>
                                    </span>
                                </td>
                                <td class="blue-text price text-info product-price text-right">-</td>
                            </tr>
                            <tr class="promo-code-wrapper">
                                <td>
                                    <span class="promo-code-discount-title">Diskon Promo</span>
                                </td>
                                <td class="blue-text text-info text-right">
                                    <span class="promo-code-discount-nominal">-</span>
                                </td>
                            </tr>
                            <tr class="referrer-code-wrapper">
                                <td>
                                    <span class="referral-code-discount-title">Diskon Referral</span>
                                </td>
                                <td class="blue-text text-info text-right">
                                    <span class="referral-code-discount-nominal">-</span>
                                </td>
                            </tr>
                            <tr>
                                <td><b>TOTAL</b></td>
                                <td class="blue-text price text-info grand-total text-right">
                                    <strong>-</strong>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                @php
                    $user_data = Auth::user();
                    $user_name = $user_email = $user_phone = '';
                    if($user_data) {
                        $user_name = $user_data->name;
                        $user_email = $user_data->email;
                        $user_phone = $user_data->phone_number;
                    }
                @endphp
                <div class="form-group">
                    <span class="input">
                        <input type="text" class="input_field" value = "{{ $user_name }}" readonly />
                        <label class="input_label">
                            <span class="input__label-content">Nama</span>
                        </label>
                    </span>
                    <span class="input">
                        <input type="text" class="input_field" value = "{{ $user_email }}" readonly />
                        <label class="input_label">
                            <span class="input__label-content">Email</span>
                        </label>
                    </span>
                    <span class="input" id="phone-confirm-field">
                        <input type="text" class="input_field" value = "{{ $user_phone }}" id="phone-confirm" />
                        <label class="input_label">
                            <span class="input__label-content">No. Ponsel</span>
                        </label>
                        <span class="text-danger error error-phone_number">
                            <small>
                                @isset($errors)
                                @foreach($errors->get('phone_number') as $ref)
                                    {{ $ref }}
                                @endforeach
                                @endisset
                            </small>
                        </span>
                    </span>
                </div>

                <div class="form-group">
                    <div class="row align-items-center promo-code-field-wrapper">
                        <div class="col-12 col-sm-6">
                            <span class="input">
                                <input type="text" class="input_field" name="promo_code" id="promo_code"  />
                                <label class="input_label">
                                    <span class="input__label-content">Kode Promo</span>
                                </label>
                            </span>
                            <span class="text-danger error error-promo_code">
                                <small></small>
                            </span>
                        </div>
                        <div class="col-12 col-sm-6">
                            <button class="btn btn_1 btn-block btn-promo-code">
                                <small>
                                    <strong>
                                        Gunakan Kode Promo
                                    </strong>
                                </small>
                            </button>
                        </div>
                    </div>
                    <div class="row align-items-center referral-code-field-wrapper">
                        <div class="col-12 col-sm-6">
                            <span class="input">
                                <input type="text" class="input_field" name="referral_code" id="referral_code"  />
                                <label class="input_label">
                                    <span class="input__label-content">Kode Referral</span>
                                </label>
                            </span>
                            <span class="text-danger error error-referral_code">
                                <small></small>
                            </span>
                        </div>
                        <div class="col-12 col-sm-6">
                            <button class="btn btn_1 btn-block btn-referral-code">
                                <small>
                                    <strong>
                                        Gunakan Kode Referral
                                    </strong>
                                </small>
                            </button>
                        </div>
                    </div>
                </div>

                <button id="payment_confirm"
                    class="btn btn_1 btn-block btn-pay-now"
                    data-bundle-id="0"
                    data-bundle-clean-price="0">
                    Bayar
                </button>
                <div class="mt-3">
                    <center>
                        <small>
                            Dengan menekan tombol "Bayar", saya mengkonfirmasi telah menyetujui <a href="{{url('perjanjian-pengguna')}}" target="_blank"><strong>Perjanjian Pengguna</strong></a> Pintaria. Pembayaran akan ditujukan ke rekening PT Haruka Evolusi Digital Utama, badan hukum dari Pintaria.<br>
                            <i class="fa fa-lock" aria-hidden="true"></i> Secure Connection<br/>
                            <span class="midtrans">
                                Pembayaran diproses oleh <img src="{{url('pintaria/img/shared/midTrans.jpg')}}">
                            </span>
                        </small>
                    </center>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Testimony Modal -->
<div id="testimony_modal">
    <span class="close">&times;</span>
    <div class="container">
        <div class="row modal_content">
            <div class="modal_video embed-responsive embed-responsive-16by9">
                <iframe class="embed-responsive-item" src="" height="480" frameborder="0" allowfullscreen></iframe>
            </div>
        </div>
    </div>
</div>

