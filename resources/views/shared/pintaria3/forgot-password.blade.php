@extends('layouts.pintaria3.master')
@section('title')
Pintaria - Lupa Password
@endsection
@section('meta_description')Info Kuliah, Kursus Online, Kelas Karyawan, Kuliah Karyawan, Kuliah Blended dan Pendidikan di Indonesia, semuanya ada di Pintaria.com @endsection

@section('content')
    <section id="hero_in" class="forgot-password-banner">
        <div class="wrapper">
            <div class="container">
                <h1 class="fadeInUp"><span></span>Lupa Password</h1>
            </div>
        </div>
    </section>
    <!--/hero_in-->

    <div class="bg_color_1">
        <div class="container margin_120_95">
            <div class="row justify-content-between">
                <div class="col-lg-12 col-md-12 rich-text-editor">
                    <div class="col-md-6 col-md-offset-3">
                    <div class="panel panel-default c-panel">
                        <div class="panel-body c-panel-body">
                           <div class="c-content-title-1">
                                <h3 class="c-left"> Lupa password?</h3>
                                <div class="c-line-left c-theme-bg"></div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <p>
                                        Masukkan email yang Anda gunakan untuk mendaftar di kolom yang tersedia. Kami akan mengirimkan email dengan panduan untuk memperbarui password Anda.
                                    </p>
                                </div>
                            </div>
                            <div class="hide container-message-flash-danger-register">
                            </div>
                            <form class="c-form-forgot-password c-margin-t-20">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-md-12">
                                        <span class="input input--filled">
                                            <input type="text" class="input_field" name="email" value="{{ old('email') }}">
                                            <label class="input_label">
                                                <span class="input__label-content">Email</span>
                                            </label>
                                        </span>
                                        <span class="text-danger error error-email">
                                            <small>
                                                @foreach($errors->get('email') as $ref)
                                                    {{ $ref }}
                                                @endforeach
                                            </small>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div id="html_element" class="g-recaptcha"></div>
                                    <span class="text-danger error error-g-recaptcha-response">
                                        <small>
                                            @foreach($errors->get('g-recaptcha-response') as $ref)
                                                {{ $ref }}
                                            @endforeach
                                        </small>
                                    </span>
                                </div>
                                <div class="form-group c-margin-t-15">
                                    <button type="submit" class="btn btn-lg c-theme-btn c-btn-square c-btn-uppercase c-btn-bold btn-forgot-password btn_1 rounded blue btn-below-recaptcha">Ganti Password</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
                </div>
            </div>
            <!--/row-->
        </div>
        <!--/container-->
    </div>
    <!--/bg_color_1-->

@endsection
@section('additional.scripts')
<script type="text/javascript">
var onloadCallback = function() {
    grecaptcha.render('html_element', {
      'sitekey' : '{{env("RECAPTCHA_CLIENT_KEY")}}'
    });
};
var daftar = "{{ route('daftar') }}";
$(document).ready(function(){
    $(document).on('submit', '.c-form-forgot-password', function(e) {
        e.preventDefault();
        $('.error').children().html('');
        $('.c-form-forgot-password .btn-forgot-password').attr('disabled', true);
        $('.container-message-flash-danger-register').addClass('hide');

        var email = $('input[name=email]').val();
//        if(email == '') {
//            $('.c-form-forgot-password .error-email').children().html('Kolom email harus diisi.');
//            removeAndDisable('.c-form-forgot-password .btn-forgot-password');
//            return false;
//        }

        $.ajax({
            url: "{{ route('submit.lupa.password') }}",
            type: "POST",
            async: true,
            data: $(this).serialize(),
            success:function(response) {
                if(response.status == 200) {
                    location.href = "{{ route('lupa.password.cek.email') }}";
                } else if(response.status == 404) {
                    $('.c-form-forgot-password .error-email').children().html("Email yang Anda masukkan belum terdaftar. Belum memiliki akun Pintaria? <a href='"+ daftar +"'><strong>Silakan daftar</strong></a>");
                } else if(response.status == 422) {
                    $('.c-form-forgot-password .error-g-recaptcha-response').children().html(response.message);
                } else {
                    showErrorMessage('.container-message-flash-danger-register', response.message, true);
                    removeAlertDanger();
                }
                removeAndDisable('.c-form-forgot-password .btn-forgot-password');
            },
            error:function(response){
                if(response.status == 422) {
                    $.each(response.responseJSON, function(key, val) {
                        $('.c-form-forgot-password .error-'+key).children().html(val[0]);
                    });
                }
                removeAndDisable('.c-form-forgot-password .btn-forgot-password');
            }
        });
    });

    function removeAndDisable(container) {
        $(container).attr('disabled', false);
    }
});
</script>
@endsection
