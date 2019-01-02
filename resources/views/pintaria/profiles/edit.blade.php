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
                <h3 class="c-font-uppercase c-font-bold">Perbarui Akun Saya</h3>
                <div class="c-line-left"></div>
            </div>
            <div class="hide container-message-flash-danger-register">
            </div>
            <form class="c-shop-form-1 c-form-update-profile">
                {{ csrf_field() }}
                <div class="">
                    <div class="row">
                        <div class="form-group col-lg-3 col-md-4 col-sm-4">
                            @if($user->profile_picture)
                                <img class="img-responsive mb-2" src="{{ route('asset', [$user->profile_picture]) }}"/>
                            @else
                                <img class="img-responsive mb-2" src="{{ asset('pintaria/img/shared/default-profile-photo.jpg') }}" />
                            @endif
                            <input type="file" name="profile_picture">
                            <p><small>Ukuran file foto tidak lebih dari 2MB</small></p>
                        </div>
                        <div class="col-md-12">
                            <span class="text-danger error error-profile_picture">
                                <small>
                                    @foreach($errors->get('profile_picture') as $ref)
                                        {{ $ref }}
                                    @endforeach
                                </small>
                            </span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" class="form-control c-square c-theme input-lg" placeholder="Nama" value="{{ $user->name }}" name="name">
                                <span class="text-danger error error-name">
                                    <small>
                                        @foreach($errors->get('name') as $ref)
                                            {{ $ref }}
                                        @endforeach
                                    </small>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" class="form-control c-square c-theme input-lg" placeholder="Email" name="email" value="{{ $user->email }}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" class="form-control c-square c-theme input-lg" placeholder="Nomor Telepon Rumah" value="{{ $user->home_number }}" name="home_number">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" class="form-control c-square c-theme input-lg" placeholder="Nomor Ponsel" value="{{ $user->phone_number }}" name="phone_number">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input class="form-control c-square c-theme input-lg" placeholder="Alamat" value="{{ $user->address }}" name="address"/>
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
    $(document).on('submit', '.c-form-update-profile', function(e) {
        e.preventDefault();

        $('.error').children().html('');
        var spin = caseShowLoadingSpin('.c-form-update-profile', '70');
        var btnContainer = '.c-form-update-profile .btn-update';
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
});
</script>
@endsection