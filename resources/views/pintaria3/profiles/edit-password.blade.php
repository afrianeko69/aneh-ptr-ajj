@extends('layouts.pintaria3.master')

@section('title') Pintaria -  Portal Edukasi Indonesia @endsection
@section('meta_description')Info Kuliah, Kursus Online, Kelas Karyawan, Kuliah Karyawan, Kuliah Blended dan Pendidikan di Indonesia, semuanya ada di Pintaria.com @endsection
@section('content')
<section id="hero_in" class="courses">
    <div class="wrapper">
        <div class="container">
            <h1 class="fadeInUp"><span></span>Perbarui Password Saya</h1>
        </div>
    </div>
</section>

<div class="bg_color_1">
    @include('layouts.pintaria3.partials.profiles.sidebar')
    <div class="container margin_60_35">
        <div class="hide container-message-flash-danger-register">
        </div>
        <form class="c-form-update-profile">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-12">
                    <section>
                        <div class="step">
                            <div class="row">
                                <div class="col-md-12">
                                    <span class="input">
                                        <input type="password" class="input_field" name="password" id="password">
                                        <label class="input_label">
                                            <span class="input__label-content">Password</span>
                                        </label>
                                    </span>
                                    <span class="text-danger error error-password password_error">
                                        <small>
                                            @foreach($errors->get('password') as $ref)
                                                {{ $ref }}
                                            @endforeach
                                        </small>
                                    </span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <span class="input">
                                        <input type="password" class="input_field" name="new_password" id="new_password">
                                        <label class="input_label">
                                            <span class="input__label-content">Password Baru</span>
                                        </label>
                                    </span>
                                    <span class="text-danger error error-new_password password_error">
                                        <small>
                                            @foreach($errors->get('new_password') as $ref)
                                                {{ $ref }}
                                            @endforeach
                                        </small>
                                    </span>
                                    <div class="row password-wrap d-none">
                                        <div class="col-6">
                                            <small>
                                                Kekuatan Password: <strong id="strength_status">Terlalu Pendek</strong>
                                            </small>
                                            <div class="progress">
                                                <div class="progress-bar" id='new_password_daftar_progress' role="progressbar" aria-valuemax="100" aria-valuemin="0" style="width:100%;background-color:#f5f5f5;"></div>
                                            </div>
                                            <span>
                                                <small>
                                                    Password harus memiliki:
                                                    <ul class="bullets">
                                                        <li>Minimal 8 karakter</li>
                                                        <li>Terdiri dari huruf besar</li>
                                                        <li>Huruf kecil, dan</li>
                                                        <li>Angka atau nonalfanumerik<br/>(contoh: !,@,&amp;)</li>
                                                    </ul>
                                                </small>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <span class="input">
                                        <input type="password" class="input_field" name="confirm_password" id="confirm_password">
                                        <label class="input_label">
                                            <span class="input__label-content">Konfirmasi Password Baru</span>
                                        </label>
                                    </span>
                                    <span class="text-danger error error-confirm_password password_error">
                                        <small>
                                            @foreach($errors->get('confirm_password') as $ref)
                                                {{ $ref }}
                                            @endforeach
                                        </small>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="row add_top_20">
                            <div class="form-group col-md-12" role="group">
                                <button type="submit" class="btn_1 rounded btn-update">Simpan</button>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </form>
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
        $('.password-wrap').removeClass('d-none');
    });

    $(document).on('blur', 'input#new_password', function () {
        $('.password-wrap').addClass('d-none');
    });

    $(document).on('submit', '.c-form-update-profile', function(e) {
        e.preventDefault();

        // if provide password then check if it's the same as confirm password
        $password = $('#password').val();
        $new_password = $('#new_password').val();
        $confirm_password = $('#confirm_password').val();

        if ($password == '') {
            $('.error-password.password_error').children().append('Field wajib diisi').css('color', 'red');
        }
        if ($new_password == ''){
            $('.error-new_password.password_error').children().append('Field wajib diisi').css('color', 'red');
        }
        if ($confirm_password == ''){
            $('.error-confirm_password.password_error').children().append('Field wajib diisi').css('color', 'red');
        }
        
        if ($password == '' || $new_password == '' || $confirm_password == '') {
            removeError();
            return false;
        }

        if ($new_password !== $confirm_password){
            $('.error-new_password.password_error').children().append('Password Harus Sama Dengan Konfirmasi Password').css('color', 'red');
            $('.error-confirm_password.password_error').children().append('Password Harus Sama Dengan Konfirmasi Password').css('color', 'red');
            removeError();
            return false;
        }

        $('.error').children().html('');
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
                showSuccessMessage('Password Anda telah berhasil diperbarui.');
                setTimeout(function() {
                    location.href = "{{ route('akun.saya') }}";
                }, 3000);
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
                } else {
                    var message = response.responseJSON.message;
                    if(message) {
                        showErrorMessage(message);
                    } else {
                        showErrorMessage('Maaf, silakan mencoba beberapa saat lagi.');
                    }
                }

                $(btnContainer).attr('disabled', false);
            },
        });
    });

    function removeError(){
        setTimeout(function() {
            $('.password_error').children().text('');
        }, 3000);
    }
});
</script>
@endsection

@push('scripts')
<script type="text/javascript">
    $(document).ready(function(){
        $('.scroll-tab').scrollLeft(250);
    })
</script>
@endpush
