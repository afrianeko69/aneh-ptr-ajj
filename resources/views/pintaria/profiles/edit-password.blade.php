@extends('layouts.pintaria.master')

@section('title') Pintaria -  Portal Edukasi Indonesia @endsection

@section('content')
<div class="container">
    <div class="col-lg-3 col-md-4">
        @include('layouts.pintaria.partials.profile.sidebar')
    </div>
    <div class="col-lg-9 col-md-8">
        <div class="c-layout-sidebar-content ">
            <div class="c-content-title-1">
                <h3 class="c-font-uppercase c-font-bold">Perbarui Password Saya</h3>
                <div class="c-line-left"></div>
            </div>
            <div class="hide container-message-flash-danger-register">
            </div>
            <form class="c-shop-form-1 c-form-update-profile">
                {{ csrf_field() }}
                <div class="">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="password" class="form-control c-square c-theme input-lg" placeholder="Masukkan Password Anda" value="" name="password" id="password"/>
                                <div class="password_error"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="password" class="form-control c-square c-theme input-lg" placeholder="Masukkan Password Baru Anda" value="" name="new_password" id="new_password"/>
                                <div class="password_error"></div>
                                <div class="row password-wrap hide">
                                    <div class="col-sm-12">
                                        <small>
                                            Kekuatan Password: <strong id="strength_status">Terlalu Pendek</strong>
                                        </small>
                                        <div class="progress">
                                            <div class="progress-bar" id='new_password_daftar_progress' role="progressbar" aria-valuemax="100" aria-valuemin="0" style="width:100%;background-color:#f5f5f5;"></div>
                                        </div>
                                        <span>
                                            <p>
                                                <small>
                                                    Password harus memiliki:
                                                    <ul>
                                                        <li>Minimal 8 karakter</li>
                                                        <li>Terdiri dari huruf besar</li>
                                                        <li>Huruf kecil, dan</li>
                                                        <li>Angka atau nonalfanumerik<br/>(contoh: !,@,&amp;)</li>
                                                    </ul>
                                                </small>
                                            </p>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="password" class="form-control c-square c-theme input-lg" placeholder="Masukkan Password Baru Anda Lagi" value="" name="confirm_password" id="confirm_password"/>
                                <div class="password_error"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row c-margin-t-20">
                        <div class="form-group col-md-12" role="group">
                            <button type="submit" class="btn btn-lg c-theme-btn c-btn-square c-btn-uppercase c-btn-bold btn-update">Simpan</button>
                        </div>
                    </div>
                </div>
            </form>         
        </div>
    </div>
</div>
@endsection

@section('additional.scripts')
<script type="text/javascript">
$(document).ready(function() {
    
    var password_strength = false;
    $(document).on('keyup', 'input#new_password', function (e) {
        var progress = $('div#new_password_daftar_progress');
        var status = $('strong#strength_status');
        password_strength = validatePassword($(this), progress, status);
    });

    $(document).on('focus', 'input#new_password', function() {
        $('.password-wrap').removeClass('hide');
    });

    $(document).on('blur', 'input#new_password', function () {
        $('.password-wrap').addClass('hide');
    });

    $(document).on('submit', '.c-form-update-profile', function(e) {
        e.preventDefault();

        // if provide password then check if it's the same as confirm password
        $password = $('#password').val();
        $new_password = $('#new_password').val();
        $confirm_password = $('#confirm_password').val();

        if ($password == '') {
            $('#password').parent().find('.password_error').html('Field wajib diisi').css('color', 'red');   
        }
        if ($new_password == ''){
            $('#new_password').parent().find('.password_error').html('Field wajib diisi').css('color', 'red');
        }
        if ($confirm_password == ''){
            $('#confirm_password').parent().find('.password_error').html('Field wajib diisi').css('color', 'red');
        }
        
        if ($password == '' || $new_password == '' || $confirm_password == '') {
            removeError();
            return false;
        }

        if ($new_password !== $confirm_password){
            $('#new_password').parent().find('.password_error').html('Password Harus Sama Dengan Konfirmasi Password').css('color', 'red');
            $('#confirm_password').parent().find('.password_error').html('Konfirmasi Password Harus Sama Dengan Password').css('color', 'red');
            removeError();
            return false;
        }

        $('.error').children().html('');
        var spin = caseShowLoadingSpin('.c-form-update-profile', '70');
        var btnContainer = '.c-form-update-profile .btn-update';
        $(btnContainer).attr('disabled', true);

        var formData = new FormData($(this)[0]);

        $.ajax({
            url: "{{ route('update.password.saya') }}",
            type: "POST",
            async:true,
            data: formData,
            cache:false,
            contentType:false,
            processData:false,
            headers: {
                'X-CSRF-TOKEN': $('input[name=_token]').val()
            },
            success:function(response) {
                removeSpinAndDisabled(spin, btnContainer);
                location.href = "{{ route('akun.saya') }}";
            },
            error:function(response) {
                if(response.status == 422) {
                    var first_key = '';
                    $.each(response.responseJSON, function(key, val) {
                        if(first_key == '') {
                            first_key = key;
                        }
                        $('.c-form-update-profile .error-' + key).children().html(val[0]);
                    });
                    scrollToElement('.c-form-update-profile .error-'+first_key);
                }

                showErrorMessage('.container-message-flash-danger-register', response.responseJSON.message, true);
                scrollToElement('.container-message-flash-danger-register');
                removeAlertDanger();
                removeSpinAndDisabled(spin, btnContainer);
            },
        });
    });

    function removeError(){
        setTimeout(function() {
            $('.password_error').text('');
        }, 3000);
    }
});
</script>
@endsection