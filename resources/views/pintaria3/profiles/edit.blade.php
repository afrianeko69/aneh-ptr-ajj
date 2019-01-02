@extends('layouts.pintaria3.master')

@section('title') Pintaria -  Portal Edukasi Indonesia @endsection
@section('meta_description')Info Kuliah, Kursus Online, Kelas Karyawan, Kuliah Karyawan, Kuliah Blended dan Pendidikan di Indonesia, semuanya ada di Pintaria.com @endsection

@section('content')
<section id="hero_in" class="courses">
    <div class="wrapper">
        <div class="container">
            <h1 class="fadeInUp"><span></span>Perbarui Akun Saya</h1>
        </div>
    </div>
</section>

<div class="bg_color_1">
    @include('layouts.pintaria3.partials.profiles.sidebar')
    <div class="container margin_60_35">
        <div class="hide container-message-flash-danger-register">
        </div>
        <form class="form-update-profile">
            {{ csrf_field() }}
            <div class="row">
                <aside class="col-lg-4 col-md-4 col-sm-5" id="sidebar">
                    <div class="box_detail">
                        @if($user->profile_picture)
                            <img class="img-fluid mb-2" src="{{ route('asset', [$user->profile_picture]) }}"/>
                        @else
                            <img class="img-fluid mb-2" src="{{ asset('pintaria/img/shared/default-profile-photo.jpg') }}" />
                        @endif
                        <input type="file" name="profile_picture">
                        <p><small>Ukuran file foto tidak lebih dari 2MB</small></p>
                        <span class="text-danger error error-profile_picture">
                            <small>
                                @foreach($errors->get('profile_picture') as $ref)
                                    {{ $ref }}
                                @endforeach
                            </small>
                        </span>
                    </div>
                </aside>
                <div class="col-lg-8 col-md-8 col-sm-7">
                    <section>
                        <div class="step">
                            <div class="row">
                                <div class="col-md-12">
                                    <span class="input">
                                        <input type="text" class="input_field" value="{{ $user->name }}" name="name">
                                        <label class="input_label">
                                            <span class="input__label-content">Nama</span>
                                        </label>
                                        <span class="text-danger error error-name">
                                            <small>
                                                @foreach($errors->get('name') as $ref)
                                                    {{ $ref }}
                                                @endforeach
                                            </small>
                                        </span>
                                    </span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <span class="input">
                                        <input type="text" class="input_field" value="{{ $user->email }}" name="email" readonly>
                                        <label class="input_label">
                                            <span class="input__label-content">Email</span>
                                        </label>
                                    </span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <span class="input">
                                        <input type="text" class="input_field" value="{{ $user->home_number }}" name="home_number">
                                        <label class="input_label">
                                            <span class="input__label-content">Nomor Telepon Rumah</span>
                                        </label>
                                    </span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <span class="input">
                                        <input type="text" class="input_field" value="{{ $user->phone_number }}" name="phone_number">
                                        <label class="input_label">
                                            <span class="input__label-content">Nomor Ponsel</span>
                                        </label>
                                    </span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <span class="input">
                                        <input type="text" class="input_field" value="{{ $user->address }}" name="address">
                                        <label class="input_label">
                                            <span class="input__label-content">Alamat</span>
                                        </label>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
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
    $(document).on('submit', '.form-update-profile', function(e) {
        e.preventDefault();

        $('.error').children().html('');
        var btnContainer = '.form-update-profile .btn-update';
        $(btnContainer).attr('disabled', true);

        var formData = new FormData($(this)[0]);

        $.ajax({
            url: "{{ route('update.akun.saya') }}",
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
                showSuccessMessage('Akun Anda telah berhasil diperbarui.');
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
                        $('.form-update-profile .error-' + key).children().html(val[0]);
                    });
                    scrollToElement('.form-update-profile .error-'+first_key);
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
});
</script>
@endsection