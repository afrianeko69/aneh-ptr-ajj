<!-- BEGIN: CONTENT/USER/FORGET-PASSWORD-FORM -->
<div class="modal fade c-content-login-form" id="forget-password-form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content c-square">
            <div class="modal-header c-no-border">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <h3 class="c-font-24 c-font-sbold">Password Recovery</h3>
                <p>To recover your password please fill in your email address</p>
                <form>
                    <div class="form-group">
                        <label for="forget-email" class="hide">Email</label>
                        <input type="email" class="form-control input-lg c-square" id="forget-email" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn c-theme-btn btn-md c-btn-uppercase c-btn-bold c-btn-square c-btn-login">Submit</button>
                        <a href="javascript:;" class="c-btn-forgot" data-toggle="modal" data-target="#login-form" data-dismiss="modal">Back To Login</a>
                    </div>
                </form>
            </div>
            <div class="modal-footer c-no-border">                
                <span class="c-text-account">Don't Have An Account Yet ?</span>
                <a href="javascript:;" data-toggle="modal" data-target="#signup-form" data-dismiss="modal" class="btn c-btn-dark-1 btn c-btn-uppercase c-btn-bold c-btn-slim c-btn-border-2x c-btn-square c-btn-signup">Signup!</a>
            </div>
        </div>
    </div>
</div>
<!-- END: CONTENT/USER/FORGET-PASSWORD-FORM -->

<!-- BEGIN: CONTENT/USER/SIGNUP-FORM -->
<div class="modal fade c-content-login-form" id="signup-form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content c-square">
            <div class="modal-header c-no-border">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <h3 class="c-font-24 c-font-sbold">Create An Account</h3>
                <p>Please fill in below form to create an account with us</p>
                <form>
                    <div class="form-group">
                        <label for="signup-email" class="hide">Email</label>
                        <input type="email" class="form-control input-lg c-square" id="signup-email" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <label for="signup-username" class="hide">Username</label>
                        <input type="email" class="form-control input-lg c-square" id="signup-username" placeholder="Username">
                    </div>
                    <div class="form-group">
                        <label for="signup-fullname" class="hide">Fullname</label>
                        <input type="email" class="form-control input-lg c-square" id="signup-fullname" placeholder="Fullname">
                    </div>
                    <div class="form-group">
                        <label for="signup-country" class="hide">Country</label>
                        <select class="form-control input-lg c-square" id="signup-country">
                            <option value="1">Country</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn c-theme-btn btn-md c-btn-uppercase c-btn-bold c-btn-square c-btn-login">Signup</button>
                        <a href="javascript:;" class="c-btn-forgot" data-toggle="modal" data-target="#login-form" data-dismiss="modal">Back To Login</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- END: CONTENT/USER/SIGNUP-FORM -->

<!-- BEGIN: CONTENT/USER/LOGIN-FORM -->
<div class="modal fade c-content-login-form" id="login-form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content c-square">
            <div class="modal-header c-no-border">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <h3 class="c-font-24 c-font-sbold">Good Afternoon!</h3>
                <p>Let's make today a great day!</p>
                <form>
                    <div class="form-group">
                        <label for="login-email" class="hide">Email</label>
                        <input type="email" class="form-control input-lg c-square" id="login-email" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <label for="login-password" class="hide">Password</label>
                        <input type="password" class="form-control input-lg c-square" id="login-password" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <div class="c-checkbox">
                            <input type="checkbox" id="login-rememberme" class="c-check">
                            <label for="login-rememberme" class="c-font-thin c-font-17">
                                <span></span>
                                <span class="check"></span>
                                <span class="box"></span>
                                Remember Me
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn c-theme-btn btn-md c-btn-uppercase c-btn-bold c-btn-square c-btn-login">Login</button>
                        <a href="javascript:;" data-toggle="modal" data-target="#forget-password-form" data-dismiss="modal" class="c-btn-forgot">Forgot Your Password ?</a>
                    </div>
                    <div class="clearfix">
                        <div class="c-content-divider c-divider-sm c-icon-bg c-bg-grey c-margin-b-20">
                            <span>or signup with</span>
                        </div>
                        <ul class="c-content-list-adjusted">
                            <li>
                                <a class="btn btn-block c-btn-square btn-social btn-twitter">
                                  <i class="fa fa-twitter"></i>
                                  Twitter
                                </a>
                            </li>
                            <li>
                                <a class="btn btn-block c-btn-square btn-social btn-facebook">
                                  <i class="fa fa-facebook"></i>
                                  Facebook
                                </a>
                            </li>
                            <li>
                                <a class="btn btn-block c-btn-square btn-social btn-google">
                                  <i class="fa fa-google"></i>
                                  Google
                                </a>
                            </li>
                        </ul>
                    </div>
                </form>
            </div>
            <div class="modal-footer c-no-border">                
                <span class="c-text-account">Don't Have An Account Yet ?</span>
                <a href="javascript:;" data-toggle="modal" data-target="#signup-form" data-dismiss="modal" class="btn c-btn-dark-1 btn c-btn-uppercase c-btn-bold c-btn-slim c-btn-border-2x c-btn-square c-btn-signup">Signup!</a>
            </div>
        </div>
    </div>
</div><!-- END: CONTENT/USER/LOGIN-FORM -->

<!-- Modal Structure -->
<div id="payment-popup-modal" class="modal">
    <div class="modal-dialog">
        <div class="modal-content c-square">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <center><h4 class="modal-title" id="myModalLabel">Konfirmasi Pembayaran</h4></center>
            </div>
            <div class="modal-body">
                <br clear="both">
                <table class="table">
                    <tbody>
                        <tr class="courses_confirm border_bottom grey lighten-3">
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
                @php
                    $user_data = Auth::user();
                    $user_name = $user_email = $user_phone = '';
                    if($user_data) {
                        $user_name = $user_data->name;
                        $user_email = $user_data->email;
                        $user_phone = $user_data->phone_number;
                    }
                @endphp
                <div class="form-group"  id="name-confirm-field">
                    <input id="name-confirm" type="text" value="{{ $user_name }}" readonly class="form-control c-square c-theme input-lg" placeholder="Nama">
                </div>

                <div class="form-group" id="email-confirm-field">
                    <input id="email-confirm" type="email" value="{{ $user_email }}" readonly class="form-control c-square c-theme input-lg" placeholder="Email">
                </div>

                <div class="form-group" id="phone-confirm-field">
                    <input id="phone-confirm" type="text" value="{{ $user_phone }}" class="form-control c-square c-theme input-lg" placeholder="No. Ponsel">
                    <span class="text-danger error error-phone_number">
                        <small>
                            @foreach($errors->get('phone_number') as $ref)
                                {{ $ref }}
                            @endforeach
                        </small>
                    </span>
                </div>
                <div class="row">
                    <div class="promo-code">
                        <div class="col-md-7 col-sm-7 col-xs-12">
                            <input class="form-control c-square c-theme input-lg" name="promo_code" id="promo_code" placeholder="Kode Promo" />
                            <span class="text-danger error error-promo_code">
                                <small></small>
                            </span>
                        </div>
                        <div class="col-md-5 col-sm-5 col-xs-12">
                            <button class="btn btn-lg btn-primary btn-promo-code"><strong>Gunakan Kode Promo</strong></button>
                        </div>
                    </div>
                    <div class="referral-code">
                        <div class="col-md-7 col-sm-7 col-xs-12">
                            <input class="form-control c-square c-theme input-lg" name="referral_code" id="referral_code" placeholder="Kode Referral" />
                            <span class="text-danger error error-referral_code">
                                <small></small>
                            </span>
                        </div>
                        <div class="col-md-5 col-sm-5 col-xs-12">
                            <button class="btn btn-lg btn-primary btn-referral-code"><strong>Gunakan Kode Referral</strong></button>
                        </div>
                    </div>
                </div>
                <button id="payment_confirm" class="btn btn-primary btn-block btn-lg btn-pay-now" data-bundle-id="0" data-bundle-clean-price="0"><b>Bayar</b></button>
                <div class="terms">
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
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>