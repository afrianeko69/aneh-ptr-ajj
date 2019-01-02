@extends('layouts.pintaria3.master')

@section('title') Pintaria - Portal Edukasi Indonesia @endsection
@section('meta_description')Kuliah sambil kerja? Kenapa nggak! Yuk daftar kuliah sambil kerja di Pintaria sekarang juga. Gunakan kode referral {{ $user_referral_code->referral_code }} untuk mendapatkan kesempatan memenangkan hadiah voucher belanja senilai 1 JUTA Rupiah! Gunakan di sini @endsection

@section('additional.metas')
<meta property="og:title" content="Pintaria - Ajak Temanmu">
<meta property="og:site_name" content="Pintaria">
<meta property="og:description" content="Kuliah sambil kerja? Kenapa nggak! Yuk daftar kuliah sambil kerja di Pintaria sekarang juga. Gunakan kode referral {{ $user_referral_code->referral_code }} untuk mendapatkan kesempatan memenangkan hadiah voucher belanja senilai 1 JUTA Rupiah! Gunakan di sini">
<meta property="og:url" content="{{ route('landing.kuliah') . '?code=' . $user_referral_code->referral_code }}">
<meta property="og:image" content="{{asset_cdn('pintaria/landing-pages/Thumb-Referral.jpg')}}">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="Pintaria - Ajak Temanmu">
<meta name="twitter:description" content="Saya membagikan kode referral {{ $user_referral_code->referral_code }} untuk kalian yang ingin mendaftar kuliah kelas karyawan di Pintaria. Gunakan di sini:">
<meta name="twitter:image:src" content="{{asset_cdn('pintaria/landing-pages/Thumb-Referral.jpg')}}">
<meta itemprop="image" content="{{asset_cdn('pintaria/landing-pages/Thumb-Referral.jpg')}}">
<meta itemprop="name" content="Pintaria - Ajak Temanmu">
<meta itemprop="description" content="Kuliah sambil kerja? Kenapa nggak! Yuk daftar kuliah sambil kerja di Pintaria sekarang juga. Gunakan kode referral {{ $user_referral_code->referral_code }} untuk mendapatkan kesempatan memenangkan hadiah voucher belanja senilai 1 JUTA Rupiah! Gunakan di sini">
@endsection

@section('additional.styles')
<link type="text/css" rel="stylesheet" href="https://cdn.jsdelivr.net/jquery.jssocials/1.4.0/jssocials.css" />
<link type="text/css" rel="stylesheet" href="https://cdn.jsdelivr.net/jquery.jssocials/1.4.0/jssocials-theme-flat.css" />
@endsection

@section('content')
<section id="hero_in" class="referrals recommends">
    <div class="wrapper">
        <div class="container recommends-top">
            @if($user->profile_picture)
                <img src="{{ route('asset', [$user->profile_picture]) }}" class="img-fluid rounded-circle">
            @else
                <img src="{{ asset('pintaria/img/shared/default-profile-photo.jpg') }}" class="img-fluid rounded-circle"/>
            @endif
            <h1 class="fadeInUp">Rekomendasikan Temanmu!</h1>
            <p>
                Ajak temanmu bergabung bersama Pintaria! Untuk setiap 1 orang teman
                yang menggunakan kode referralmu, kamu akan mendapatkan 1 poin yang
                akan diundi untuk memenangkan hadiah voucher belanja senilai Rp 1 JUTA
                setiap bulannya.
            </p>
        </div>
    </div>
</section>

<div class="bg_color_1">
    <div class="container margin_60_35 recommends-master">
        <!-- Socmed box -->
        <div class="row">
            <div class="float-shares">
                <div class="shares-area text-center">
                    <div class="col text-center">
                        Salin kode referral kamu: &nbsp;<strong id="ref_code">{{ $user_referral_code->referral_code }}</strong>
                        <i class="fa fa-copy" id="copy-btn" data-toggle="popover" data-content="Tersalin"></i>
                    </div>
                    <div class="col text-center">
                        <span>atau</span>
                    </div>
                    <div class="row">
                        <div class="email-area form-group">
                            {{ csrf_field() }}
                            <input type="email" name="email" id="email_referral" class="form-control email-form email-newsletter" placeholder="Masukkan email temanmu">
                            <input type="submit" id="submit-referral" value="Kirim" class="submit-referral daftar-newsletter btn_submit">
                        </div>
                    </div>
                    <span class="text-danger error error-email"></span>
                    <div class="col text-center">
                        <span>atau</span>
                    </div>
                    <div class="row">
                        <div class="socmed">
                            <span class="bagikan">Bagikan:</span><div id="shareNative" class="jssocials"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <section class="col-md-12">
                <h2>Saat ini kamu memiliki {{ $user_referral_code->studentLeads()->count() }} poin.</h2>
                <table class="table table-responsive table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Email Address</th>
                            <th scope="col">Program</th>
                            <th scope="col">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($user_referral_code->studentLeads as $no => $lead)
                            <tr>
                                <th scope="row">{{ $no+1 }}</th>
                                <td>{{ $lead->name }}</td>
                                <td>{{ $lead->email }}</td>
                                <td>{{ $lead->product ?: $lead->departement }}</td>
                                <td>{{ date('d F Y H:i',strtotime($lead->created_at)) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </section>
        </div>
    </div>
</div>
@endsection

@section ('additional.scripts')
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery.jssocials/1.4.0/jssocials.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $("#shareNative").jsSocials({
            showCount: false,
            showLabel: true,
            url: "{{ route('landing.kuliah') }}?code={{ $user_referral_code->referral_code }}",
            text: "Mau raih gelar sarjana meskipun sibuk bekerja? Kenapa nggak! Yuk daftar kuliah blended learning Pintaria sekarang juga. Pilih kampus yang kamu mau, cicilan mulai dari Rp 700 ribuan/bulan! Gunakan kode referral saya untuk mendapatkan kesempatan memenangkan hadiah voucher belanja senilai Rp 500 ribu! Gunakan di sini:",
            shares: [
                { share: "whatsapp", label: "Share", shareUrl: "https://wa.me?text={text} {url}", shareIn: "blank" },
                { share: "facebook", label: "Share" },
                { share: "twitter", label: "Tweet", text: "Raih gelar sarjana sambil kerja? Di Pintaria, bisa! Gunakan kode referral dari saya dan dapatkan hadiah senilai 500 ribu. Gunakan di sini:" }, 
                { share: "googleplus", label: "Share" },
                "linkedin",
            ],
            on: {
                click: function (e) {
                    showSuccessSocmedReferralMessage();
                }
            }
        });

        $('#copy-btn').popover();
        $(document).on('click', '#copy-btn', function (e) {
            copyToClipboard('#ref_code');
            $(this).popover();
        });

        $(document).on('click', '#submit-referral', function(e) {
            e.preventDefault();
            $.ajax({
                url: "{{ route('akun.saya.rekomendasi.email') }}",
                type: "POST",
                async:true,
                data: JSON.stringify({
                    email: $('input[name=email]').val(),
                    name: '{{ Auth::user()->name }}',
                    redirect_to: '{{ route("landing.kuliah") }}' + '?code=' + '{{ $user_referral_code->referral_code }}'
                }), 
                dataType: 'json',
                contentType:'application/json',
                headers: {
                'X-CSRF-TOKEN': $('input[name=_token]').val()
                },
                success:function(response) {
                    showSuccessMessage('Selamat! Kamu baru saja membagikan kode referralmu. Kumpulkan poinnya dan menangkan hadiahnya!');
                    $('.shares-area span.text-danger.error.error-email').text('');
                },
                error:function(response) {
                    if(response.status == 422) {
                        var first_key = '';
                        $.each(response.responseJSON, function(key, val) {
                            if(first_key == '') {
                                first_key = key;
                            }
                            $('.shares-area span.text-danger.error.error-' + key).text(val[0]);
                        });
                        scrollToElement('.error-'+first_key);
                    } else {
                        var message = response.responseJSON.message;
                        if(message) {
                            showErrorMessage(message);
                        } else {
                            showErrorMessage('Maaf, silakan mencoba beberapa saat lagi.');
                        }
                    }
                },
            });
        });
    });
function showSuccessSocmedReferralMessage() {
    swal('Selamat! Kamu baru saja membagikan kode referralmu. Kumpulkan poinnya dan menangkan hadiahnya!', {
        button: false,
        icon: 'success'
    });
}

function copyToClipboard(element) {
    var temp = $("<input>");
    $("body").append(temp);
    temp.val($(element).text()).select();
    document.execCommand("copy");
    temp.remove();
}
</script>
@endsection
